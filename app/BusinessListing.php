<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessListing extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function category(){
    return $this->belongsTo('App\Category','category_id');
  }

  public function business_listing_attribute(){
    return $this->hasMany('App\BusinessListingAttribute','business_listing_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'category_id', 'location_id', 'name', 'email', 'password'
 ];
}
