<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionBusinessCategory extends Model
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
     'id', 'data_section_id', 'category_id'
 ];
}
