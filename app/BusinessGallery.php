<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessGallery extends Model
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
     'id', 'business_id', 'gallery_url', 'gallery_name', 'gallery_type', 'gallery_size'
 ];
}
