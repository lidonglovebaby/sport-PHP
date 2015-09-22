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

$offset = 0;
$inpage = 0;
$limit = 5000;  

// Initialise the current session.
$session = FacebookSession::newAppSession();

// Load the file containing the gym IDS.
$csv = new parseCSV('NEWCONSOLIDADO_FB.csv');

// Create a file parser object to write the contents of the file on.
$csvOut = new parseCSV();
ini_set('max_execution_time', 5000);
// Array used to store the 
foreach ($csv->data  as $row) 
{
	// This is the id being used
	echo 'The current id is=> '.$row["ID"]; 
	$id = $row["ID"];//'196104637098376'; //
	$allFields = array();
	$fieldsCounter = 0;
	try
	{
		if ( isset( $session ) )
		{
			$request = new FacebookRequest($session, 'GET', '/'.$id, 
				array(
					'id' => $id,
					'fields' => 'id,photos'
					) 
			);
		   	$response = $request->execute();
			
			//echo "The Following are the contents of the response". $response->getResponse()->getGraphObject()->asArray();
			echo "the following are the contents of the response =>".sizeof($response->getGraphObject()->asArray()); 

			$loc = $response->getGraphObject()->asArray();
							
			//echo '<pre>' . print_r( $loc, 1 ) . '</pre>';
			
			if( isset($loc['photos']))
			{			
				//print "Photos found";
				foreach ($loc['photos'] as $element) 
				{					
					echo 'this is element';
					echo "<pre>";
					print_r($element);
					echo "</pre>";
					//echo '<pre>' . print_r( $element, 1 ) . '</pre>';
					foreach($element as $images)
					{
						if(isset($images->images)) 
						{
							// iterate through the images found 
							foreach ( $images->images as $photo )
							{
									// for the different image sizes
								if(isset($photo->source))
								{
									echo $photo->source;
									echo $photo->height;
									echo $photo->width;
									
									/*if ( ( $photo->height > 300  &&
									    	$photo->height < 600 ) &&
										( $photo->width > 300  &&
										$photo->width < 600 ) )
									{*/
										echo "-------------<br />";
										echo $photo->source;
										echo '<br />'.'<br />'.$id.'<br />';
										$allFields[$fieldsCounter] = $photo->source;
										$fieldsCounter ++;
										//Just take the first size image which is the biggest.
										break;
									//}															
								}
							}							
						}
					}
					echo "<br /><br /><br /><br /><br /><br />";
					echo "============================";
					"<pre>" . print_r($allFields) . "</pre>";
					echo "the size of allfields is". sizeof($allFields); 
					$text = '';
					if( sizeof($allFields) > 0 )
					{
						$counter = 0;
						foreach($allFields as  $link )
						{
							echo "the content of text is===============". $text;
							echo "the content of link is===============".  $link;
							$text =	$text + $link.'\n';
							copy($link,'.//images//'.$id.'('.$counter++.')'.".jpg" );
						}							
					}					
					$request = null; 
					
				}		 
				//////////
				// print data
				echo '<pre>' . print_r( $loc, 1 ) . '</pre>';
			}
		}
		else
		{
			// show login url
			echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
		}		
	}
	catch(Exception $ex)
	{
		echo $ex;
		echo 'ERROR'.$id;
	}
	sleep(5);	
}
?>