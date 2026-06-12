<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Services\CommentService;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct(CommentService $commentService){
        $this->commentService = $commentService;
    }

    public function store(CommentRequest $commentRequest, Post $post){
        $this->commentService->store($commentRequest->validated(), $post, Auth::user());
        return response()->json([ 'status'  => true, 'message' => 'Comment posted successfully.',], 201);
    }
    public function reply(CommentRequest $commentRequest, Comment $comment){
        $this->commentService->reply($commentRequest->validated(), $comment, Auth::user());
        return response()->json(['status'  => true, 'message' => 'Reply posted successfully.',], 201);
    }
    public function index(Post $post){
        $comments = $post->comments() ->with(['user', 'replies.user'])
            ->whereNull('discussion_id')->latest()->get();
        return response()->json(['status' => true,'data' => CommentResource::collection($comments),]);
    }

    public function destroy(Comment $comment){
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['status'  => false,'message' => 'Unauthorized.',], 403);
        }
        $this->commentService->delete($comment);
        return response()->json(['status'  => true,'message' =>'Comment deleted successfully.',]);
    }
}