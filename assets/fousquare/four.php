<?php 
	require_once("php-foursquare-master/src/FoursquareAPI.class.php");
	require_once 'parsecsv.lib.php';
	// Set your client key and secret
	$client_key = "OS3H2OLC4NFEFVBMID5FLOBUQKPSMZ0FPVLCSIT3DT0VTB5T";
	$client_secret = "CTQ4050QWWDBIWQ3HXLVYGA4CEV11B0WEG1VFLYBESVTTVPA";
	// Load the Foursquare API library

	$csv = new parseCSV('Gyms-large.csv');
	$csvOut = new parseCSV();

	if($client_key=="" or $client_secret=="")
	{
        echo 'Load client key and client secret from <a href="https://developer.foursquare.com/">foursquare</a>';
        exit;
	}

	$foursquare = new FoursquareAPI($client_key,$client_secret);
	$location = array_key_exists("location",$_GET) ? $_GET['location'] : "Montreal, QC";

	foreach ($csv->data  as $row) {
	
		$latitude = $row["lat"];
		$longitude = $row["lon"];
		$name = $row['name'];
		$neigh = $row['neighborhood'];
		$type = $row['type'];	
		// Generate a latitude/longitude pair using Google Maps API
		//list($lat,$lng) = $foursquare->GeoLocate($location);
		// Prepare parameters
		$params = array("ll"=>"$latitude,$longitude","query"=>"Gimnasio");
		
		// Perform a request to a public resource
		$response = $foursquare->GetPublic("venues/search",$params);
		//var_dump($response);
		$venues = json_decode($response);

		$elementNew["origin_name"] = $name;
		$elementNew["origin_latitude"] = $latitude;
		$elementNew["origin_longitude"] = $longitude;
		$elementNew["origin_type"] = $type;
		$elementNew["origin_n"] = $neigh;
?>
	
		<?php foreach($venues->response->venues as $venue): ?>
			<!-- <div class="venue"> -->
				<?php 
					echo '<pre>' . print_r( $venue, 1 ) . '</pre>';	
					$elementNew["id"] = $venue->id;
					$elementNew["name"] = $venue->name;

							// [postalCode] => 15270
				     //        [cc] => MX
				     //        [city] => Venustiano Carranza
				     //        [state] => Federal District
				     //        [country] => Mexico
				     //        [formattedAddress] => Array
				     //            (
				     //                [0] => F.C. de Cintura 125 Col. Morelos (Hortelanos)
				     //                [1] => 15270 Venustiano Carranza, Federal District
				     //                [2] => Mexico
				     //            )

				     //    )

					if(isset($venue->location)) {
						$elementNew["latitude"] = $venue->location->lat;
			            $elementNew["longitude"] = $venue->location->lng;

			            $elementNew["postalCode"] = $venue->location->postalCode;
						$elementNew["cc"] = $venue->location->cc;
			            $elementNew["city"] = $venue->location->city;
			            $elementNew["state"] = $venue->location->state;
			            $elementNew["country"] = $venue->location->country;
			            //$elementNew["ip"] = $element->location->ip; 
			            if(property_exists($venue->location,"formattedAddress")){
			            	$string = '';
			            	$count = count($venue->location->formattedAddress);
			            	$aux_count = 1;
			            	foreach ($venue->location->formattedAddress as $element) {
			            		$string.= $element;
			            		if($aux_count < $count){
			            			$string.= '_';
			            		}
			            		$aux_count++;
			            	}
			            	$elementNew["formattedAddress"] = $string;
			            }
					}

					if(isset($venue->categories['0']))
                    {
						if(property_exists($venue->categories['0'],"name"))
						{
							$elementNew["category"] = $venue->categories['0']->name;
						}
					}
					$elementNew["usersCount"] = $venue->stats->usersCount;
					$elementNew["checkinsCount"] = $venue->stats->checkinsCount;
					
					// if(isset($element->category_list) && is_array($element->category_list)){
					// 	$count = count($element->category_list);
					// 	$counterAux = 1;
					// 	foreach ($element->category_list as $category) {
					// 		$list.= $category->name;
					// 		if ($counterAux < $count) {
					// 			$list.='-';
					// 		}
					// 		$counterAux++;
					// 	}
					// 	$elementNew["category_list"] = $list;
					// }
					echo '<pre>' . print_r( $elementNew, 1 ) . '</pre>';

			        $allFields[] = array_values($elementNew);
			        if($fieldsCounter%1000 == 0){
			        	$csvOut->save('datafqOut'.$fieldsCounter.'-Gimnasio.csv', $allFields, true);
			        	$allFields  = array();
			        }
			        $fieldsCounter ++;
					// if(isset($venue->categories['0']))
					// {
					// 	echo '<image class="icon" src="'.$venue->categories['0']->icon->prefix.'88.png"/>';
					// }
					// else
					// 	echo '<image class="icon" src="https://foursquare.com/img/categories/building/default_88.png"/>';
					// echo '<a href="https://foursquare.com/v/'.$venue->id.'" target="_blank"/><b>';
					// echo $venue->name;
					// echo "</b></a><br/>";
					
					
						
                    
					
					// if(property_exists($venue->hereNow,"count"))
					// {
					// 		echo ''.$venue->hereNow->count ." people currently here <br/> ";
					// }

     //                echo '<b><i>History</i></b> :'.$venue->stats->usersCount." visitors , ".$venue->stats->checkinsCount." visits ";
					
				?>
			
			<!--</div> -->
			
		<?php 
		sleep(1);
		endforeach; 
	}
	$csvOut->save('datafqOut'.$fieldsCounter.'-Gimnasio.csv', $allFields, true);
	?>
<!-- </body>
</html> -->