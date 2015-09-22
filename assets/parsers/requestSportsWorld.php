<?php 
include 'parser/simple_html_dom.php';

// $url = 'https://quiosco.sportsworld.com.mx/horarios/jsonObtenSalones';
// $data = array('idClub' => '37', 'fechaOrigen' => '2015-04-11');


// $options = array(
//     'http' => array(
//         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//         'method'  => 'POST',
//         'content' => http_build_query($data),
//     ),
// );
// $context  = stream_context_create($options);
// $result = file_get_contents($url, false, $context);
// $gymRoomsjson = json_decode($result);

// //array to store the gym rooms
// $gymRooms = array();
// $roomCounter = 0;

// foreach ($gymRoomsjson as $room => $detail) {
// 	$gymRooms[$roomCounter]['idRoom'] = $detail->idSalon;
// 	$gymRooms[$roomCounter]['nameRoom'] = $detail->salon;
// 	$roomCounter++;
// }

// var_dump($gymRooms);




//code to get the gym schedule using gym info. Note that the club field is not required

$url = 'https://quiosco.sportsworld.com.mx/horarios/obtenHorarios';
$data = array('idClub' => '37', 'idSalon' => '1','idClase' => '0','salon' => 'Fitness','club' => '','fechaOrigen' => '2015-04-11','div' => 'ccc');


$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

var_dump($result);

$html = str_get_html($result);
$table = $html->find('table', 1);
var_dump($table);
$rows = $table[0]->find('tr');

$classesContainer = array();

foreach ($rows as $row) {

	//find the cell that contains the time
	$hour = $row->find('td.tablahoras');
	$hourtext = '';
	if($hour){
		$hourtext = $hour->plaintext;
	}
	var_dump($hourtext );
	$newClass = array();

	//get the cells with the clasess
	$class = $row->find('td.nclase');
	$classCounter = 0;
	//traverse the cells
	foreach ($class  as $c) {
		$tempClass = array();
		$classInnerTable = $c->find('table');

		//if the cell has a class parse the class
		if ($classInnerTable) {

			$parentSpan = $classInnerTable[0]->find('span[id^=span]');

			if ($parentSpan) {
				$wholeText = $parentSpan->plaintext;
				$tempClass['trainer'] = $parentSpan[0]->find('span')[0];
				$time = $parentSpan[0]->find('small')[0];
				// $tempClass['start'] = 
			    // $tempClass['finish'] = 
				// $tempClass['activity'] = substring($wholeText )
			}
		}

		$newClass[$classCounter] = 
		$classCounter ++;
	}

	$classesContainer[$hourtext] = $newClass;

}

//	SCHEMA OF THE TABLE THAT WILL CONTAIN THE CLASSES INFORMATION AND DETAIL

//   `idClass` INT NOT NULL,
//   `Weekday_idweekday` INT NOT NULL,       0 (for Sunday) through 6 (for Saturday)
//   `start` TIME NULL,
//   `finish` TIME NULL,
//   `trainer` VARCHAR(45) NULL,
//   `activity` VARCHAR(45) NULL,
//   `Gym_idgym` INT NOT NULL,

?>