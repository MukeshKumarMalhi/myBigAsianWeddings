<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataQuestion extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function data_type(){
    return $this->belongsTo('App\DataType','data_type_id');
  }
  public function data_section(){
    return $this->belongsTo('App\DataSection','data_section_id');
  }

  public function data_answer(){
    return $this->hasMany('App\DataAnswer','data_question_id');
  }

  public function business_listing_attribute(){
    return $this->hasMany('App\BusinessListingAttribute','data_question_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'data_type_id', 'data_section_id', 'question_name', 'question_label', 'question_placeholder', 'question_mandatory', 'question_status', 'question_order', 'question_basic_search', 'question_advance_search', 'question_is_common'
 ];
}
