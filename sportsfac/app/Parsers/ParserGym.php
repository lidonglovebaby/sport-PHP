<?php namespace App\Parsers;

use File;
use App\Schedule;
use Carbon\Carbon;
abstract class ParserGym {

	protected static $weekday = array(0 => "Sunday", 1 => "Monday",2 => "Tuesday",3 => "Wednesday",4 => "Thusday",5 => "Friday",0 => "Saturday" );

	protected static $headers = array("Weekday_idweekday","start","finish","trainer","activity","Gym_idgym","thirdpartyid");

	//class Duration
	protected $classDurationHours;

	//array that will be converted to json and sved
	protected $formated_class_array;
	
	//third party id
	protected $idExternal;

	//ouput name
	protected $outputName;

	protected $savePath;

	protected  $equivalenciesColumnHeaders;
	
	abstract protected function getAll();

	abstract protected function getOne($idGymInThirdPartie);

	abstract protected function initHeaders();

	//converts a json to an array of schedules
	abstract protected function jsonToArrayOfSchedule();

	public function __construct($idThirdParty,$savePath) {
       $this->idExternal = $idThirdParty;
       $this->savePath = $savePath;
       $this->initHeaders();
       $this->formated_class_array = array();

        if(!File::exists($savePath)) {
			File::makeDirectory($savePath, $mode = 0775, true);
	    }
   	}

	protected function generateJson(){
		//$content = "";
		var_dump($this->savePath.$this->outputName);
		//var_dump($this->formated_class_array);
		// foreach ($this->$formated_class_array as $key => $class) {
			
		// }
		file_put_contents($this->savePath.$this->outputName, json_encode($this->formated_class_array));
	}

	protected function arrayElementToObject($element){
		$object = new Schedule();
		var_dump($element);
		if (isset($element)) {
		
	    	if (isset($element["idClass"])) {
	    		$object->idClass = $element["idClass"];
	    	}else{
	    		$object->idClass = 1;
	    	}

	    	if (isset($element["start"])) {
	    		$object->start = $element["start"];
	    	}else{
	    		$object->start = "";
	    	}

	    	if (isset($element["finish"])) {
	    		$object->finish = $element["finish"];
	    	}else{
	    		$object->finish = "";
	    	}

	    	if (isset($element["trainer"])) {
	    		$object->trainer = $element["trainer"];
	    	}else{
	    		$object->trainer = "";
	    	}

	    	if (isset($element["activity"])) {
	    		$object->activity = $element["activity"];
	    	}else{
	    		$object->activity = "";
	    	}

	    	if (isset($element["Gym_idgym"])) {
	    		$object->idClass = $element["Gym_idgym"];
	    	}else{
	    		$object->idClass = $this->idExternal;
	    	}
		}

    	return $object;
	}

	protected function compareWeekday($a, $b)
	{
	    return strcmp($a->Weekday_idweekday, $b->Weekday_idweekday);
	}

	//returns < 0 if a is earlier than b; > 0 if a is greater than b y 0 if are equal.
	protected function compareStart($a, $b)
	{
		$returnValue = 0;
		
		$aTime = Carbon::createFromFormat('H:i:s', $a->start);
		$bTime = Carbon::createFromFormat('H:i:s', $b->start);

		if($aTime->eq($bTime)){
			$returnValue = 0;
		}elseif($aTime->gt($bTime)){
			$returnValue = 1;
		}elseif($aTime->lt($bTime)){
			$returnValue = -1;
		}

	    return strcmp($a->start, $b->start);
	}




// //	SCHEMA OF THE TABLE THAT WILL CONTAIN THE CLASSES INFORMATION AND DETAIL

// //   `idClass` INT NOT NULL,
// //   `Weekday_idweekday` INT NOT NULL,       0 (for Sunday) through 6 (for Saturday)
// //   `start` TIME NULL,
// //   `finish` TIME NULL,
// //   `trainer` VARCHAR(45) NULL,
// //   `activity` VARCHAR(45) NULL,
// //   `Gym_idgym` INT NOT NULL,

	
}
