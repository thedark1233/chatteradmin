<?php

namespace Codiiv\Chatter\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $table = 'chatter_discussion';

    public function category(){
      return $this->belongsTo('Codiiv\Chatter\Models\Discussion', 'chatter_category_id');
    }
    public function user(){
      return $this->belongsTo('App\User');
    }
    // public function children(){
    //   return $this->hasMany('Codiiv\Chatter\Models\Discussion', 'chatter_category_id');
    // }
}
