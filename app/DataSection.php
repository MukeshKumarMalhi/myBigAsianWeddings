<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataSection extends Model
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
     'id', 'data_question_id', 'section_name', 'section_status', 'section_order', 'section_basic_search', 'section_advance_search'
 ];
}
