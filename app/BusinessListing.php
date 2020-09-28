<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessListing extends Model
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
     'id', 'category_id', 'name'
 ];
}
