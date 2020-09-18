<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function user(){
    return $this->belongsTo('App\User','user_id');
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

 protected $fillable = [
     'id', 'user_id', 'feedback_type', 'feedback_about', 'feedback_notes'
 ];
}
