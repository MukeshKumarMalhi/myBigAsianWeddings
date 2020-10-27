<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessListingDetail extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function business_listing(){
    return $this->belongsTo('App\BusinessListing','business_listing_id');
  }
  public function user1(){
    return $this->belongsTo('App\User','created_user_id');
  }
  public function user2(){
    return $this->belongsTo('App\User','updated_user_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'business_listing_id', 'created_user_id', 'updated_user_id', 'created_by_user', 'updated_by_user'
 ];
}
