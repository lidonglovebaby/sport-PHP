<?php 
// $html = file_get_html('Sport City.html');
//require_once 'facebook-sdk/autoload.php';
require_once 'parsecsv.lib.php';
// //find club drop down 

// $html->find(ClubHor
// // Find all images 
// foreach($html->find('img') as $element) 
//        echo $element->src . '<br>';

// // Find all links 
// foreach($html->find('a') as $element) 
//        echo $element->href . '<br>';
session_start();
require_once 'facebook-sdk/src/Facebook/FacebookSession.php';
require_once 'facebook-sdk/src/Facebook/FacebookRedirectLoginHelper.php';
require_once 'facebook-sdk/src/Facebook/FacebookRequest.php';
require_once 'facebook-sdk/src/Facebook/FacebookResponse.php';
require_once 'facebook-sdk/src/Facebook/FacebookSDKException.php';
require_once 'facebook-sdk/src/Facebook/FacebookRequestException.php';
require_once 'facebook-sdk/src/Facebook/FacebookRequestException.php';
require_once 'facebook-sdk/src/Facebook/FacebookAuthorizationException.php';
require_once 'facebook-sdk/src/Facebook/Entities/AccessToken.php';
require_once 'facebook-sdk/src/Facebook/HttpClients/FacebookHttpable.php';
require_once 'facebook-sdk/src/Facebook/HttpClients/FacebookCurlHttpClient.php';
require_once 'facebook-sdk/src/Facebook/HttpClients/FacebookCurl.php';
require_once 'facebook-sdk/src/Facebook/GraphObject.php';
require_once 'facebook-sdk/src/Facebook/GraphLocation.php';

// require __DIR__ . '/facebook-sdautoload.php';


use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphLocation;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;

FacebookSession::setDefaultApplication('822118707827265', '29cc915f5c6130197327eb026c123ddc');

// If you already have a valid access token:
//$session = new FacebookSession('CAALrtm2LEkEBAPh7XbFpAtTKTETgAVdlZBLEfkTzeSjmEwlmB0RI4ZCajtrILWPQnhiNNgAhfZCSVNsaarM2REzbHD3Ru5wizjBpT8h98pvdCTKunhenl6q91M3hGB2mCeVGZCyU8tsLc1FoZBCRADgVvyi5bWPTvLvQKvM0P2Mcj9wGO3S1ujKE6BZCDXZAKTjTU631H5lXwZDZD'); //822118707827265|crkB4E8sLUxkYvXcytFU3kXv_IE');

// If you're making app-level requests:
$session = FacebookSession::newAppSession();

//$helper = new FacebookRedirectLoginHelper( 'http://www.mymusclefactory.com/' );
// try {
//   $session = $helper->getSessionFromRedirect();
// } catch( FacebookRequestException $ex ) {
//   // When Facebook returns an error
// } catch( Exception $ex ) {
//   // When validation fails or other local issues
// }

//READ THE FILE
$csv = new parseCSV('Gyms-large.csv');
$csvOut = new parseCSV();
$allFields = array();
foreach ($csv->data  as $row) {
	
	$latitude = $row["lat"];
	$longitude = $row["lon"];
	$name = $row['name'];
	$neigh = $row['neighborhood'];
	$type = $row['type'];
	print_r($row);

	if ( isset( $session ) ) {
		$request = new FacebookRequest($session, 'GET', '/search', 
			array(
				'q' => 'gimnasio',
				'type' => 'place',
				'center'=>$latitude.','.$longitude,
		    	'distance'=>'500'
		    	//'fields' => 'id'
				) 
		);
	    // q=gym&
	    // type=place&
	    // center=19.44920825%2C-99.11926496&
	    // distance=500');
		$response = $request->execute();
		//$graphObject = $response->getGraphObject();

		$loc = $response->getGraphObject()->asArray();

		// foreach($FB_User_Interests_Movies['data'] as $key) {
		//     echo $key->name.'<br />';
		// }
		// while(in_array("paging", $loc) && array_key_exists("next", $data["paging"])) {
	 //        $offset += $limit;
	 //        $data = $GLOBALS["facebook"]->api("/$user_id/photos?limit=$limit&offset=$offset&fields=$fields",'GET');
	 //        $photos_data = array_merge($photos_data, $data["data"]);
	    
		//$header = array('id','name','latitude','longitude','street','city','state','country','category','category_list');
		//$allFields = array();
		$fieldsCounter = 0;
		$elementNew["origin_name"] = $name;
		$elementNew["origin_latitude"] = $latitude;
		$elementNew["origin_longitude"] = $longitude;
		$elementNew["origin_type"] = $type;
		$elementNew["origin_n"] = $neigh;
		//echo '<pre>' . print_r( $loc, 1 ) . '</pre>';
		foreach ($loc['data'] as $element) {
			//echo '<pre>' . print_r( $element, 1 ) . '</pre>';
			$list = '';

			$elementNew["id"] = $element->id;
			$elementNew["name"] = $element->name;

			if(isset($element->location)) {
				$elementNew["latitude"] = $element->location->latitude;
	            $elementNew["longitude"] = $element->location->longitude;

				$elementNew["street"] = $element->location->street;
	            $elementNew["city"] = $element->location->city;
	            $elementNew["state"] = $element->location->state;
	            $elementNew["country"] = $element->location->country;
	            //$elementNew["ip"] = $element->location->ip; 
			}

			$elementNew["category"] = $element->category;
			if(isset($element->category_list) && is_array($element->category_list)){
				$count = count($element->category_list);
				$counterAux = 1;
				foreach ($element->category_list as $category) {
					$list.= $category->name;
					if ($counterAux < $count) {
						$list.='-';
					}
					$counterAux++;
				}
				$elementNew["category_list"] = $list;
			}
			echo '<pre>' . print_r( $elementNew, 1 ) . '</pre>';

	        $allFields[] = array_values($elementNew);
	        $fieldsCounter ++;
		}
			//}
		//////////
		// print data
	    //echo '<pre>' . print_r( $loc, 1 ) . '</pre>';
	} else {
	  	// show login url
	  	echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
	}
	sleep ( 2 );
}
$csvOut->save('dataOut.csv', $allFields, true);

// $facebook = FacebookSession::setDefaultApplication('822118707827265', '29cc915f5c6130197327eb026c123ddc');
// $helper = new FacebookCanvasLoginHelper();
// try {
// 	$session = $helper->getSession();
// } catch (FacebookRequestException $ex) {
// 	echo $ex->getMessage();
// } catch (\Exception $ex) {
// 	echo $ex->getMessage();
// }
// if (isset($session)) {
// 	try {
// 		// get basic info about logged in user
// 		$request1 = new FacebookRequest($session, 'GET', '/me');
// 		$response1 = $request1->execute();
// 		$me = $response1->getGraphObject();
// 		$id = $me->getProperty('name');
// 		echo $id;
// 	} catch(FacebookRequestException $e) {
// 		echo $e->getMessage();
// 	}
// } else {
// 	$helper = new FacebookRedirectLoginHelper('https://apps.facebook.com/mmftools/');
// 	$auth_url = $helper->getLoginUrl();
// 	echo "<script>window.top.location.href='".$auth_url."'</script>";
// }
?>