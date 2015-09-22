<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GymServices extends Model {

	//
	protected $table = 'service';

	public function gyms(){
        return $this->belongsToMany('App\Gym', 'Gym_has_Service', 'Service_idservice', 'idservice');
    }
}
