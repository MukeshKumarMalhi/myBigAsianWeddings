<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessListingAttribute extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function business_listing(){
    return $this->belongsTo('App\BusinessListing','business_listing_id');
  }
  public function data_question(){
    return $this->belongsTo('App\DataQuestion','data_question_id');
  }
  public function data_answer(){
    return $this->belongsTo('App\DataAnswer','data_answer_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'business_listing_id', 'data_question_id', 'data_answer_id', 'data_answer_text'
 ];
}
