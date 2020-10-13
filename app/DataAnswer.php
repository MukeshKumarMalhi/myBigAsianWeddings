<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataAnswer extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function data_question(){
    return $this->belongsTo('App\DataQuestion','data_question_id');
  }

  public function business_listing_attribute(){
    return $this->hasMany('App\BusinessListingAttribute','data_answer_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'data_question_id', 'answer_name', 'answer_value'
 ];
}
