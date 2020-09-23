<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataAnswer extends Model
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
     'id', 'data_question_id', 'answer_name', 'answer_value'
 ];
}
