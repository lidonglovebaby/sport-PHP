<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Schedule;
use DB;

use App\Parsers\ParseGym;
use App\Parsers\ParserGymSportCity;
use Log;

class Gym extends Model {

	protected $table = 'Gym';

	protected $primaryKey = 'idgym';

	private static $jsonPath = "places.json";

	//private static $timetablePath = "places.json";

	protected static $jsonTemplate = 

				array(	'id'=> 1,
			            "category"=> "",
			            "title"=> "",
			            "location"=> "",
			            "lat"=> 51.541599,
			            "lon"=> -0.112588,
			            "url"=> "",
			            "type"=> "",
			            "type_icon"=> "",
			            "rating"=> 0,
			            "gallery"=>
			                array(),
			            "features"=>
			                 array(),
			            "date_created"=> "2014-11-03",
			            "price"=> "",
			            "featured"=> 0,
			            "color"=> "",
			            "person_id"=> 1,
			            "year"=> 1980,
			            "special_offer"=> 0,
			            "item_specific"=>
			                array(),
			            "description"=> "",
			            "last_review"=> "",
			            "last_review_rating"=> 5);

	

	protected $fillable = [
		'name',
		'street',
		'exterior',
		'interior',
		'neighborhood',
		'postalCode',
		'state',
		'country',
		'latitude',
		'longitude',
		'phone',
		'website',
		'twitter',
		'facebook',
		'youtube',
		'featured',
		'rating',
		'averagePrice',
		'GymChain_idGymChain'
	];

	public function schedule(){
		
	}

	public function classes(){
		
	}

    public function services(){
        return $this->belongsToMany('Service', 'Gym_has_Service', 'Gym_idgym', 'idgym');
        //return $this->belongsToMany('App\Service', 'Gym_has_Service', 'idgym' , 'Gym_idgym');
    }

    public function activities(){
        return $this->belongsToMany('App\GymActivity', 'Gym_has_GymActivity', 'Gym_idgym', 'idgym');
    }

	public function facebookLink()
    {
    	$link = "";
    	if (isset($this->facebook)) {
    		$link = "https://www.facebook.com/".$this->facebook;
    	}
        return $link;
    }

    public function fullAddress()
    {
    	$address = "";
    	$address =  $this->street . "\xA" . 
    	 			$this->exterior . ' ' . $this->interior . "\xA" .
    				$this->state . ' ' . $this->country . ' ' . $this->postalCode;
        return $address;
    }

    public function openingHours(){
    	
    	return $this->hasMany('App\Schedule','gym_idgym','idgym')->orderBy('weekday_idweekday');
    }

    public function description(){
    	 return $this->hasOne('GymDescription','Gym_idgym','idgym');
    }

    public function reviews(){
    	
    	return $this->hasMany('App\Review','gym_idgym','idgym');
    }

    public function toJsonCustom($embeded = false){
    	$localarray = array(
    		"id" => $this->idgym,
    		"title" => $this->name,
    		"lat" => $this->latitude,
    		"lon" => $this->longitude,
    		"type_icon" => (public_path())."/icons/sports/relaxing-sports/weights.png" );
    	if($embeded){
    		$data = array_merge(Gym::$jsonTemplate,$localarray);
    	}else{
    		$data = array("data" => array(array_merge(Gym::$jsonTemplate,$localarray)) );
    	}
    	$tojson = json_encode($data);
    	return $tojson;
    }

    public static function toJsonCustomAll(){
    	$gyms = Gym::all();
    	$jsonFile = array("data" => array());

    	foreach ($gyms as $gym) {
    		$jsonFile["data"][] = $gym->toJsonCustom(true);
    	}
    	$tojson = json_encode($jsonFile);
    	return $tojson;
    }

    public static function createJson($path){
    	$file = $path . "/" . Gym::$jsonPath;
    	var_dump($file);
    	$contents = Gym::toJsonCustomAll();
    	$contents = str_replace("\"{","{",$contents);
    	$contents = str_replace("}\"","}",$contents);
    	$contents = str_replace("\\\"", "\"", $contents);

    	var_dump($contents);
    	$bytes_written = \File::put($file, \HTML::decode($contents));

    	if ($bytes_written === false)
		{
		    die("Error writing to file");
		}
    }

    public function price(){
    	return $this->averagePrice;
    }

    public function refreshTimetable($savePath){
    	$chain = $this->chain;
    	
    	if(isset($chain)){
    		//$parser = new \App\Parsers\ParserGym();
    		//get third party ID
    		$thirdparty = $this->chain->thirdParty;
    		var_dump($thirdparty->idThirdParty);
    		$idThirPartyGymId = $this->thirdPartyIds()->where('ThirdParty_idThirdParty', '=', $thirdparty->idThirdParty)->get();
    		$idPartyGymId = $idThirPartyGymId->first()->idWithinThirPartyApp;
    		$savePath.= $this->chain->idGymChain.'/'.$this->idgym.'/';
			//var_dump($savePath);
    		switch ($chain->parserName) {
    			case 'Sportcity':
    				var_dump($chain->parserName);
    				$parser = new \App\Parsers\ParserGymSportCity($idPartyGymId,$savePath);
    				break;
    			
    			default:
    				# code...
    				break;
    		}

    		if(isset($thirdparty) && isset($parser)){
    			$t = time();
    			//$savePath .= '/'.$thirdparty->idThirdParty.'/'.$this->idGym.'_'.date("Y_m_d",$t).'.json';
    			
    			$parser->getOne($idPartyGymId);
    		}  		
    	}
    }

    public function chain(){
    	 return $this->hasOne('App\GymChain','idGymChain','GymChain_idGymChain');
    }

    public function thirdPartyIds(){
    	 return $this->hasMany('App\ThirdPartyID','Gym_idgym','idgym');
    }


    public function timetables($savePath){
    	$chain = $this->chain;
    	$timetables = array();
    	
    	if(isset($chain)){
    		//get third party ID
    		$thirdparty = $this->chain->thirdParty;
    		if(isset($thirdparty))
    		{
	    		$idThirPartyGymId = $this->thirdPartyIds()->where('ThirdParty_idThirdParty', '=', $thirdparty->idThirdParty)->get();
                if (isset($idThirPartyGymId) && count($idThirPartyGymId) > 0) {
                    
    	    		$idPartyGymId = $idThirPartyGymId->first()->idWithinThirPartyApp;
    	    		$savePath.= $this->chain->idGymChain.'/'.$this->idgym.'/';
    				//var_dump($savePath);
    	    		switch ($chain->parserName) {
    	    			case 'Sportcity':
    	    				Log::info($chain->parserName);
    	    				$parser = new \App\Parsers\ParserGymSportCity($idPartyGymId,$savePath);
    	    				break;
    	    			
    	    			default:
    	    				# code...
    	    				break;
    	    		}

    	    		if(isset($parser)){
    	    			// //$t = time();
    	    			// $jsonPathTimetable .= '/'.$thirdparty->idThirdParty.'/'.$this->idGym.'/';
    	    			$timetables = $parser->jsonToArrayOfSchedule();
    	    			//$dates = $timetablesTemp['__dates'];
    	    			//var_dump($timetablesTemp);
    	    			//$parser->getOne($idPartyGymId);


    	    		}  	
                }
	    	}	
    	}
    	return $timetables;
    }

    private function deletePreviousTimetables()
	{

	}	

    public function pictures()
    {
        return $this->hasMany('App\GymPicture','Gym_idgym','idgym');
    }   
}
