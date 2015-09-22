<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GymChain extends Model {

	
	protected $table = 'GymChain';

	protected $primaryKey = 'idGymChain';

	public function thirdParty(){
    	 return $this->belongsto('App\ThirdParty','ThirdParty_idThirdParty','idThirdParty');
    }

}
