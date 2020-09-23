<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataType extends Model
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
     'id', 'type', 'html_tag'
 ];
}
