<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /* 模型Post默认对应表posts,如果你不是这样对应的,需要写
        protected $table = "post2";
    */

   //  protected $guarded;
     protected $fillable = ['title','content'];


     //文章关联用户,使用模型关联-belongsto
     public function user(){

         return $this->belongsTo('App\User');
     }


     //一个文章下有很多评论
     public function comments(){
         return $this->hasMany('App\Comment')->orderBy('created_at','desc');
     }
}
