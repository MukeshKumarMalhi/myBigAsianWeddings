<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataQuestion extends Model
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
     'id', 'data_type_id', 'data_section_id', 'question_name', 'question_status', 'question_order', 'question_basic_search', 'question_advance_search'
 ];
}
