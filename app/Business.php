<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function category(){
    return $this->belongsTo('App\Category','category_id');
  }
  public function location(){
    return $this->belongsTo('App\Location','location_id');
  }

  public function business_feature(){
    return $this->hasMany('App\BusinessFeature','business_id');
  }
  public function business_gallery(){
    return $this->hasMany('App\BusinessGallery','business_id');
  }
  public function business_hour(){
    return $this->hasMany('App\BusinessHour','business_id');
  }
  public function shortlist(){
    return $this->hasMany('App\Shortlist','business_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'category_id', 'location_id', 'name', 'tagline', 'description', 'email', 'mobile', 'phone', 'whatsapp', 'website_url', 'facebook_url',
     'instagram_url', 'linkedIn_url', 'twitter_url', 'youtube_channel_url', 'address', 'geo_latitude', 'geo_longitude', 'business_logo', 'business_status'
 ];
}
