<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ThirdParty extends Model {

	protected $table = 'ThirdParty';

	protected $primaryKey = 'idThirdParty';

	public function thirdpartyIDs(){
    	
    	return $this->hasMany('App\ThirdPartyID','ThirdParty_idThirdParty','idThirdParty');
    }
}
