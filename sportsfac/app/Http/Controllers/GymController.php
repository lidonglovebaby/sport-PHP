<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PageGym;
use App\Gym;
//use Illuminate\Http\Request;
use Laracasts\Utilities\JavaScript\JavascriptServiceProvider\JavaScript; 
use Illuminate\Database\Connection;
use DB;
use Request;
use Input;
use Log;

class GymController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$page = new PageGym();
		$page->title = 'Home Page';
		$page->class = "map-fullscreen page-homepage";
		
		return view('gymsHome',$page);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$page = new PageGym();
		$page->title = 'Gym Detail';
		//DB::connection()->enableQueryLog();	
		$gym = Gym::findOrFail($id);
		$savePath = public_path()."/json/timetables/";
		$timetables = $gym->timetables($savePath);
		if (isset($timetables) && !empty($timetables) ) {
			$timetablesDates = $timetables['__dates'];
		}
		
		Log::info($timetables);
		
		// if (isset($gym)) {
		// 	$gym->toJsonCustom();
		// }
		//$json = 
		//$hours = Gym::findOrFail($id)->openingHours; //$gym->openingHours();
		//$queries = DB::getQueryLog();

		//var_dump($queries);

		return view('layouts.gym.show',compact('page','gym','hours','timetables','timetablesDates'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function json(){
		Gym::createJson(public_path());
	}

	public function search() {

	    $q = Input::get('myInputField');

	    $searchTerms = explode(' ', $q);

	    $query = DB::table('products');

	    foreach($searchTerms as $term)
	    {
	        $query->where('name', 'LIKE', '%'. $term .'%');
	    }

	    $results = $query->get();

	}

	public function infobox(){

		if(Request::ajax())
        {
        	$id = Input::get('id');
        	if (isset($id)) {
        		$gym = Gym::findOrFail($id);
        		return response()->view('layouts.gym.infobox',['gym'=>$gym])->header('Content-Type', 'html');
        	}	
        }
		
	}

	public function refreshTimetable($id){
		$gym = Gym::findOrFail($id);
		$savePath = public_path()."/json/timetables/";
		$gym->refreshTimetable($savePath);
	}



}
