<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessListingAttribute extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'business_listing_id', 'data_question_id', 'data_answer_id', 'data_answer_text'
 ];
}
