<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function business(){
    return $this->hasMany('App\Business','category_id');
  }
  public function shortlist(){
    return $this->hasMany('App\Shortlist','category_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'parent_category_id', 'category_name', 'category_icon'
 ];
}
