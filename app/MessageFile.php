<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageFile extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function message(){
    return $this->belongsTo('App\Message','message_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'message_id', 'file_name', 'file_url'
 ];
}
