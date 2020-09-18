<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessFeature extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function business(){
    return $this->belongsTo('App\Business','business_id');
  }
  public function feature(){
    return $this->belongsTo('App\Feature','feature_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'business_id', 'feature_id',
 ];
}
