<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\PostCondition;

class Comment extends Model
{
    protected $fillable = ['post_id','user_id','body','discussion_id'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function reply(){
        return $this->hasMany(Comment::class,'discussion_id','id');
    }

    public function parent(){
        return $this->belongsTo(Comment::class,'discussion_id');
    }
}
