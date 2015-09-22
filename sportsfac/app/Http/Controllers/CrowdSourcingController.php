<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PageGym;
use App\Gym;
use App\GymTemp;
use App\GymActivity;
use App\GymServices;
//use Illuminate\Http\Request;
use Laracasts\Utilities\JavaScript\JavascriptServiceProvider\JavaScript; 
use Illuminate\Database\Connection;
use DB;
use Request;
use Input;
use Log;
use Carbon\Carbon;

class CrowdSourcingController extends Controller {
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

		/*$page = new PageGym();
		$page->title = 'Home Page';
		$page->class = "map-fullscreen page-homepage";		
		return view('layouts.crowdsource.show',$page);*/
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		echo 'We are in the create';
		return view('layouts.crowdsource.show');
	}

	/**
	 * Receive all the data sent from the Contribute form
	 *
	 * @return Response
	 */
	public function store()
	{
		$contributedInfo = Request::all();
			
		GymTemp::create($contributedInfo);
		
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
		$page->title = 'Home Page';
		$page->class = "page-subpage page-submit navigation-off-canvas";
		
		$gym_activities = GymActivity::all();	
		$gym_services = GymServices::all();

		return view('layouts.crowdsource.show', compact('page', 'gym_activities', 'gym_services' ));
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
}