<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function business_feature(){
    return $this->hasMany('App\BusinessFeature','feature_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'parent_feature_id', 'feature_name', 'feature_icon', 'category_icon'
 ];
}
