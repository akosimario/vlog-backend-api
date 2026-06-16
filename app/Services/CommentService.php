<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Repositories\CommentRepository;

class CommentService{
    protected CommentRepository $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(array $data, Post $post, User $user){
        return $this->commentRepository->create(['post_id'=> $post->id,
            'user_id' => $user->id,
            'body' => $data['body'],
            'discussion_id'=> null]);
    }

    public function reply(array $data, Comment $comment, User $user){
        return $this->commentRepository->create(['post_id' => $comment->post_id,
            'user_id' => $user->id,
            'body' => $data['body'],
            'discussion_id'=> $comment->id]);
    }
    public function delete(Comment $comment){
        $comment->replies()->delete();
        $comment->delete();
    }
}