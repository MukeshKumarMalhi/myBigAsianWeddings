<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHour extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function business(){
    return $this->belongsTo('App\Business','business_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'business_id', 'business_hours_json', 'from_monday', 'to_monday', 'from_tuesday', 'to_tuesday', 'from_wednesday', 'to_wednesday', 'from_thursday', 'to_thursday', 'from_friday', 'to_friday',
     'from_saturday', 'to_saturday', 'from_sunday', 'to_sunday'
 ];
}
