<?php 
namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
class PostRepository{
    public function create(array $data){
        return Post::create($data);
    }
    public function update(array $data, Post $post){
        $post->update($data); 
        return $post;
    }
}