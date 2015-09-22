<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GymTemp extends Model {

	protected $table = 'GymTemp';

	protected $primaryKey = 'idgymtemp';

	public $timestamps = false;

	protected $fillable = [
		'name',// name
		'street',//
		'exterior',//
		'interior',//
		'neighborhood', //in
		'postalCode', //
		'state', //state
		'country', //in
		'latitude',//in
		'longitude', //in
		'phone',//in
		'website', //in
		'twitter',
		'facebook',
		'youtube',
		'featured',
		'rating',
		'averagePrice',
		'GymChain_idGymChain',
		'User_iduser',//
		'CrowdSourceStatus_idCrowdSourceStatus',//
		'Gym_idgym'	//

	];
	

}
