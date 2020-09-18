<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function user(){
    return $this->belongsTo('App\User','user_id');
  }

  public function message_file(){
    return $this->hasMany('App\MessageFile','message_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'user_id', 'name', 'email', 'message'
 ];
}
