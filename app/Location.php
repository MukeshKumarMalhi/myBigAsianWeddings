<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function country(){
    return $this->belongsTo('App\Country','country_id');
  }

  public function business(){
    return $this->hasMany('App\Business','location_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'country_id', 'location_name', 'location_icon'
 ];
}
