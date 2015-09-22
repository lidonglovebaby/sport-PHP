<?php 
//get facebook page detial by id


//require_once 'facebook-sdk/autoload.php';
require_once 'parsecsv.lib.php';

session_start();
require_once 'facebook-sdk/src/Facebook/FacebookSession.php';
require_once 'facebook-sdk/src/Facebook/FacebookRedirectLoginHelper.php';
require_once 'facebook-sdk/src/Facebook/FacebookRequest.php';
require_once 'facebook-sdk/src/Facebook/FacebookResponse.php';
require_once 'facebook-sdk/src/Facebook/FacebookSDKException.php';
require_once 'facebook-sdk/src/Facebook/FacebookRequestException.php';
require_once 'facebook-sdk/src/Facebook/FacebookAuthorizationException.php';
require_once 'facebook-sdk/src/Facebook/FacebookOtherException.php';
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
use Facebook\FacebookOtherException;
use Facebook\GraphObject;
use Facebook\GraphLocation;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;

FacebookSession::setDefaultApplication('822118707827265', '29cc915f5c6130197327eb026c123ddc');

// $facebook = new Facebook(array(
//       'appId'  => '822118707827265',
//       'secret' => '29cc915f5c6130197327eb026c123ddc',
//     ));
// $access_token = $facebook->getAccessToken();
$offset = 0;
$inpage = 0;
$limit = 5000;  

$session = FacebookSession::newAppSession();


$csv = new parseCSV('CONSOLIDADO_FB.csv');

$csvOut = new parseCSV();
$allFields = array();
$fieldsCounter = 0;
foreach ($csv->data  as $row) {
	$id = $row["id"]; //'196104637098376';//
	// $latitude = $row["lat"];
	// $longitude = $row["lon"];
	// $name = $row['name'];
	// $neigh = $row['neighborhood'];
	// $type = $row['type'];
	try{
		if ( isset( $session ) ) {
			$request = new FacebookRequest($session, 'GET', '/search', 
				array(
					'id' => $id,
					'type' => 'page',
					//'center'=>$latitude.','.$longitude,
			    	//'distance'=>'500'
			    	'fields' => 'id,name,category,location,about,business,company_overview,description,emails,features,general_info,hours,parking,phone,price_range,website,bio,talking_about_count,picture'
					) 
			);
		    // q=gym&
		    // type=place&
		    // center=19.44920825%2C-99.11926496&
		    // distance=500');

			$response = $request->execute();

			$loc = $response->getGraphObject()->asArray();
			//$elementNew["origin_id"] = $id;
			//$elementNew["origin_name"] = $name;
			// $elementNew["origin_latitude"] = $latitude;
			// $elementNew["origin_longitude"] = $longitude;
			// // $elementNew["origin_type"] = $type;
			// $elementNew["origin_n"] = $neigh;

			// while(in_array("paging", $loc) && array_key_exists("next", $loc->paging)) {
			//  	if($inpage > 0)
			//  	{
			//  		//$data = $GLOBALS["facebook"]->api("/$user_id/photos?limit=$limit&offset=$offset&fields=$fields",'GET');
			//  		//$photos_data = array_merge($photos_data, $data["data"]);

			//  		$url = $loc->paging->next;
			// 		$ch = curl_init($url);
					 
			// 		curl_setopt($ch, CURLOPT_POST, 1);
			// 		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
			// 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					 
			// 		$loc = curl_exec($ch);
			// 		curl_close($ch);

			// 		print_r( $loc, 1 );
			// 		//return;
			//  	}
			//     $inpage++;
			// 	//$header = array('id','name','latitude','longitude','street','city','state','country','category','category_list');
			// 	//$allFields = array();
				
				echo '<pre>' . print_r( $loc, 1 ) . '</pre>';
				$element = $loc['data'][0];
				//foreach ($loc['data'] as $element) {
					//echo '<pre>' . print_r( $element, 1 ) . '</pre>';

					if(isset($element->location)) {
						$elementNew["id"] = $element->id;
						$elementNew["name"] = $element->name;

						$elementNew["latitude"] = $element->location->latitude;
			            $elementNew["longitude"] = $element->location->longitude;

						$elementNew["street"] = $element->location->street;
			            $elementNew["city"] = $element->location->city;
			            $elementNew["state"] = $element->location->state;
			            $elementNew["country"] = $element->location->country;

			            $elementNew["category"] = $element->category;
			            //$elementNew["ip"] = $element->location->ip; 
			           
			           
					}

					//about,business,category,company_overview,description,emails,features,general_info,hours,parking,phone,price_range,website,bio,talking_about_count
					if(property_exists($element,"category")){
						$elementNew["category"] = $element->category;
					}else{
						$elementNew["category"] = "";
					}

					if(property_exists($element,"about")){
						$elementNew["about"] = $element->about;
					}else{
						$elementNew["about"] = "";
					}

					if(property_exists($element,"business")){
						$elementNew["business"] = $element->business;
					}else{
						$elementNew["business"] = "";
					}

					if(property_exists($element,"company_overview")){
						$elementNew["company_overview"] = $element->company_overview;
					}else{
						$elementNew["company_overview"] = "";
					}

					if(property_exists($element,"description")){
						$elementNew["description"] = $element->description;
					}else{
						$elementNew["description"] = "";
					}

					if(property_exists($element,"emails")){
						$elementNew["emails"] = $element->emails;
					}else{
						$elementNew["emails"] = "";
					}

					if(property_exists($element,"features")){
						$elementNew["features"] = $element->features;
					}else{
						$elementNew["features"] = "";
					}

					if(property_exists($element,"general_info")){
						$elementNew["general_info"] = $element->general_info;
					}else{
						$elementNew["general_info"] = "";
					}

					if(property_exists($element,"hours")){
						$elementNew["hours"] = json_encode($element->hours, JSON_FORCE_OBJECT );
					}else{
						$elementNew["hours"] = "";
					}

					if(property_exists($element,"parking")){
						$elementNew["parking"] = json_encode($element->parking, JSON_FORCE_OBJECT );
					}else{
						$elementNew["parking"] = "";
					}

					if(property_exists($element,"phone")){
						$elementNew["phone"] = $element->phone;
					}else{
						$elementNew["phone"] = "";
					}

					if(property_exists($element,"price_range")){
						$elementNew["price_range"] = $element->price_range;
					}else{
						$elementNew["price_range"] = "";
					}

					if(property_exists($element,"website")){
						$elementNew["website"] = $element->website;
					}else{
						$elementNew["website"] = "";
					}

					if(property_exists($element,"bio")){
						$elementNew["bio"] = $element->bio;
					}else{
						$elementNew["bio"] = "";
					}

					if(property_exists($element,"talking_about_count")){
						$elementNew["talking_about_count"] = $element->talking_about_count;
					}else{
						$elementNew["talking_about_count"] = "";
					}

					if(property_exists($element,"picture")){
						$elementNew["picture"] = json_encode($element->picture, JSON_FORCE_OBJECT ); 
					}else{
						$elementNew["picture"] = "";
					}

					// if(property_exists($element,"photos")){
					// 	$elementNew["photos"] = json_encode($element->photos);
					// }else{
					// 	$elementNew["photos"] = "";
					// }

					if($fieldsCounter%1000 == 0){
				        $csvOut->save('dataOut-pages-detail-'.$fieldsCounter.'.csv', $allFields, true);
				        $allFields  = array();
				    }
				    $allFields[] = array_values($elementNew);
				    echo '<pre>' . print_r( $elementNew, 1 ) . '</pre>';

			        $fieldsCounter ++;	
				//}
			 
			// }
			//////////
			// print data
		    //echo '<pre>' . print_r( $loc, 1 ) . '</pre>';
		} else {
		  	// show login url
		  	echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
		}

	}catch(Exception $ex){
		echo 'ERROR'.$id;
	}
	sleep(1);
}

$csvOut->save('dataOut-pages-detail-'.$fieldsCounter.'.csv', $allFields, true);

?>