<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataSection extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function data_question(){
    return $this->hasMany('App\DataQuestion','data_section_id');
  }

  public function section_business_category(){
    return $this->hasMany('App\SectionBusinessCategory','data_section_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'section_name', 'section_sub_heading', 'section_status', 'section_order', 'section_basic_search', 'section_advance_search', 'section_is_common'
 ];
}
