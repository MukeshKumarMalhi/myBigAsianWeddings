<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionBusinessCategory extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function category(){
    return $this->belongsTo('App\Category','category_id');
  }
  public function data_section(){
    return $this->belongsTo('App\DataSection','data_section_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'data_section_id', 'category_id'
 ];
}
