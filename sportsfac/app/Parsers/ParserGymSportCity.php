<?php namespace App\Parsers;
//require 'vendor/autoload.php';
use App\Parsers\ParserGym;
use Log;
use Carbon\Carbon;
use App\Schedule;
use File;
include 'simple_html_dom.php';



	// <option value="43">Acoxpa</option>
	// <option value="41">Aragón</option>
	// <option value="10">Boulevares Qro.</option>
	// <option value="49">Carso</option>
	// <option value="32">Coacalco</option>
	// <option value="45">Coatzacoalcos</option>
	// <option value="24">Coyoacán</option>
	// <option value="20">Cuautitlán</option>
	// <option value="23">Cuernavaca</option>
	// <option value="28">Ecatepec</option>
	// <option value="1" selected="">Eureka</option>
	// <option value="21">Galerías Gdl.</option>
	// <option value="15">Galerías Mty.</option>
	// <option value="22">Gran Sur</option>
	// <option value="54">Insurgentes</option>
	// <option value="14">Interlomas</option>
	// <option value="44">Ixtapaluca</option>
	// <option value="18">León</option>
	// <option value="26">Lindavista</option>
	// <option value="29">Lomas Plaza</option>
	// <option value="25">Lomas Verdes</option>
	// <option value="2">Loreto</option>
	// <option value="42">Metepec</option>
	// <option value="12">Minerva Gdl.</option>
	// <option value="5">Mundo E</option>
	// <option value="56">Nuevo Sur</option>
	// <option value="51">Oaxaca</option>
	// <option value="36">Pachuca</option>
	// <option value="38">Parques Polanco</option>
	// <option value="7">Polanco</option>
	// <option value="16">Puebla</option>
	// <option value="31">Saltillo</option>
	// <option value="50">Samara</option>
	// <option value="6">Santa Fe</option>
	// <option value="37">Tecnoparque</option>
	// <option value="57">Toreo</option>
	// <option value="13">Universidad</option>
	// <option value="9">Valle Mty.</option>
	// <option value="40">Villahermosa</option>
	// <option value="3">Women´s Studio</option> 

class ParserGymSportCity extends ParserGym{

	public static $uri = "http://www.sportcity.com.mx/horario.asp";
	//protected static $headers = array("weekday","start","finish","trainer","activity","localidGym","thirdpartyid");
	
	public $classDurationHours = 1;

	public function getAll(){
		$html = file_get_html(self::$uri.'?clubid=1');
		//$headers =array();
		$a=0;
		foreach($html->find('table[id=tablaH]') as $table) {
			// foreach($table->find('th') as $th)
			// {
			// 	$headers[$a]=(string)$th->plaintext;
			// 	$a=$a+1;
			// }
			// $headers = array("","","","","","");
			$clubid = array();
			$a=0;
			foreach($html->find('select[id=ClubHor]') as $select){

				//find the branches ids
				foreach($select->find('option') as $option)
				{
					$clubid[$a]= $option->value;
					$a=$a+1;
				}


				//iterate over the branches
				foreach($clubid as $value) { 
				// 	$link = self::$uri."?clubid=" . "$value" ;

				// 	$html = file_get_html($link);

				// 	if( $html) 
				// 	{	
				// 		$content = array();
				// 		$i = 0;


				// 		foreach($html->find('table[id=tablaH]') as $table) {
				// 			foreach($table->find('tr') as $tr)
				// 			{	
				// 				$j =0;
				// 				foreach($tr -> find('td') as $td)
				// 				{   
				// 					//if the column has equivalence
				// 					if(array_key_exists($i,self::$equivalenciesColumnHeaders)){
				// 						$td->plaintext = mb_ereg_replace('&nbsp;', '', $td->plaintext);
				// 						$content[$i][self::$equivalenciesColumnHeaders[$i]] =trim($td->plaintext);
				// 					}
									
				// 					//$j=$j+1;
				// 				};
				// 				$startTime = DateTime::createFromFormat('H:i:s', $content[$i]["start"]);
				// 				$finishTimeAdd = new DateInterval('P1H');
				// 				$content[$i]["weekday"] = date("w");
				// 				$content[$i]["finish"] = $startTime.add($finishTimeAdd);
				// 				//$content[$i]["localidGym"] = ;
				// 				$content[$i]["thirdpartyid"] = $value;
				// 				$i=$i+1;		
				// 			}

				// 			print_r(json_encode($content));
				// 			//$name = 'sportcity_' . "$value";
				// 			//file_put_contents("data/$name.json", json_encode($content));
				// 			$this->generateJson();
				// 		}

				// 	}
					$this->getOne($value);
				}
			}
		}

	}

	public function getOne($idGymInThirdPartie){
		Log::info("getONE");
		if(!isset($idThirdPartie)){
			$idThirdPartie = $this->idExternal;
		}

		//dia=22&mes=4&anio=2015
		$today = Carbon::today();
		$tomorrow = Carbon::tomorrow();
		$dates = array($today,$tomorrow);
		foreach ($dates as $d) {
			
			$link = self::$uri."?clubid=" . $idThirdPartie . "&dia=".$d->__get('day')."&mes=".$d->__get('month')."&anio=".$d->__get('year');

			$html = file_get_html($link);
			var_dump($link);
			if( $html) 
			{	
				$content = array();
				$i = 0;
				// foreach($html->find('table[id=tablaH]') as $table) {
				// 	foreach($table->find('tr') as $tr)
				// 	{	
				// 		$j =0;
				// 		foreach($tr -> find('td') as $td)
				// 		{    
				// 			$td->plaintext = mb_ereg_replace('&nbsp;', '', $td->plaintext);
				// 			$content[$i][ParserGymSportCity::$headers[$j]] =trim($td->plaintext);
				// 			$j=$j+1;
				// 		};
				// 		$i=$i+1;		
				// 	}
				// 	$this->$outputName = $idThirdPartie.'_'.'sportcity_';
				// 	//print_r(json_encode($content));
				// 	//$name = 'sportcity_' . "$value";
				// 	//file_put_contents("data/$name.json", json_encode($content));
				// 	$this->formated_class_array = $content;
				// 	$this->generateJson();
				// }

				foreach($html->find('table[id=tablaH]') as $table) {
					
					foreach($table->find('tr') as $tr)
					{
						//var_dump( $tr->plaintext);
						$j =0;
						foreach($tr->find('td') as $td)
						{   
							
							//if the column has equivalence
							if(array_key_exists($j,$this->equivalenciesColumnHeaders)){
								$td->plaintext = mb_ereg_replace('&nbsp;', '', $td->plaintext);
								$content[$i][$this->equivalenciesColumnHeaders[$j]] =trim($td->plaintext);
							}
							
							$j=$j+1;
						}
						if(isset($content[$i])){
							$content[$i]["Weekday_idweekday"] = $d->__get('dayOfWeek');
							$content[$i]["thirdpartyid"] = $this->idExternal;
							$startTime = Carbon::createFromFormat('H:i:s', $content[$i]["start"]);
							if (isset($startTime)) {
								$finishTime = $startTime->addHours($this->classDurationHours);//new DateInterval('P'.(string)$this->$classDurationHours.'H');
								$content[$i]["finish"] = $finishTime->toTimeString();//$startTime->add($finishTime)->format('H:i:s');
							}else{
								$content[$i]["finish"] = "";
							}
							
							//$content[$i]["localidGym"] = ;
							
							//var_dump($content[$i]);
						}
						$i=$i+1;		
					}

					//print_r(json_encode($content));
					$this->formated_class_array = $content;
					$this->outputName = $d->__get('day')."_".$d->__get('month')."_".$d->__get('year').'.json';
					// $this->outputName = $d->__get('day')."_".$d->__get('month')."_".$d->__get('year').'_'.$idThirdPartie.'_'.'sportcity'.'.json';
					//file_put_contents("data/$name.json", json_encode($content));
					$this->generateJson();
				}

			}
		}
	}

	public function initHeaders(){
		$this->equivalenciesColumnHeaders = array(
			0 => parent::$headers[1],
			2 => parent::$headers[4],
			4 => parent::$headers[3]
		);
	}

	// CREATE TABLE IF NOT EXISTS `sportsfac`.`Class` (
	//   `idClass` INT NOT NULL,
	//   `Weekday_idweekday` INT NOT NULL,
	//   `start` TIME NULL,
	//   `finish` TIME NULL,
	//   `trainer` VARCHAR(45) NULL,
	//   `activity` VARCHAR(45) NULL,
	//   `Gym_idgym` INT NOT NULL,
	//   PRIMARY KEY (`idClass`, `Weekday_idweekday`, `Gym_idgym`),
	//   INDEX `fk_Class_Weekday1_idx` (`Weekday_idweekday` ASC),
	//   INDEX `fk_Class_Gym1_idx` (`Gym_idgym` ASC),
	//   CONSTRAINT `fk_Class_Weekday1`
	//     FOREIGN KEY (`Weekday_idweekday`)
	//     REFERENCES `sportsfac`.`Weekday` (`idweekday`)
	//     ON DELETE NO ACTION
	//     ON UPDATE NO ACTION,
	//   CONSTRAINT `fk_Class_Gym1`
	//     FOREIGN KEY (`Gym_idgym`)
	//     REFERENCES `sportsfac`.`Gym` (`idgym`)
	//     ON DELETE NO ACTION
	//     ON UPDATE NO ACTION)
	// ENGINE = InnoDB
	//parse a json and convert it to an array of object of type Schedule
	public function jsonToArrayOfSchedule(){
		$timetables =  array();
		$today = Carbon::today();
		$tomorrow = Carbon::tomorrow();
		$dates = array($today,$tomorrow);

		foreach ($dates as $d){
			$this->outputName = $d->__get('day')."_".$d->__get('month')."_".$d->__get('year').'.json';
			try
			{
			    $contents = File::get($this->savePath.$this->outputName);
			    $arrayClass = json_decode($contents);
			    $counter = 0;
			    $dateString = $d->toDateString();

			    foreach ($arrayClass as $element) {
			    	//$object = $this->arrayElementToObject($element);
			    	$timetables[$dateString][] = $element; //$object;
			    }

			    
			    //var_dump($timetables[$dateString]);
			}
			catch (Illuminate\Filesystem\FileNotFoundException $exception)
			{
				$this->getOne($this->idExternal);
			    //die("The file ".$this->outputName." doesn't exist");
			}
		}
		usort($timetables[$dateString], array($this, 'compareWeekday'));
		usort($timetables[$dateString], array($this, 'compareStart'));
		$timetables['__dates'] = $dates;
		return $timetables;
	}

	

	
}
