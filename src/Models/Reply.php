<?php

namespace Codiiv\Chatter\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'chatter_posts';

     public function discussion(){
       return $this->belongsTo('Codiiv\Chatter\Models\Discussion', 'chatter_discussion_id');
     }
    // public function children(){
    //   return $this->hasMany('Codiiv\Chatter\Models\Discussion', 'chatter_category_id');
    // }

     public function user(){
       return $this->belongsTo('App\User', 'user_id');
     }

}
