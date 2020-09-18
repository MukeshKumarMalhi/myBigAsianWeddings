<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shortlist extends Model
{
  public function user(){
    return $this->belongsTo('App\User','user_id');
  }
  public function business(){
    return $this->belongsTo('App\Business','business_id');
  }
  public function category(){
    return $this->belongsTo('App\Category','category_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'user_id', 'business_id', 'category_id'
 ];
}
