<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {

	protected $table = 'Schedule';

	public function weekday()
    {
        return $this->hasOne('App\Weekday','idweekday','weekday_idweekday');
    }
}
