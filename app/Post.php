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
}
