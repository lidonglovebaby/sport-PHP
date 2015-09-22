<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GymActivity extends Model 
{

	// Define the table association 
	protected $table = 'GymActivity';


    public function gyms(){
        return $this->belongsToMany('App\Gym', 'Gym_has_GymActivity', 'GymActivity_idactivity', 'idactivity');
    }

}