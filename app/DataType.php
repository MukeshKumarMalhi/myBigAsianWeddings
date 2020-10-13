<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataType extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function data_question(){
    return $this->hasMany('App\DataQuestion','data_type_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'type', 'html_tag'
 ];
}
