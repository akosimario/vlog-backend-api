<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Comment\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
class commentController extends Controller
{
   protected CommentService $commentService;

    public function __construct(CommentService $commentService){
        $this->commentService = $commentService;
    }
    public function store(CommentRequest $commentRequest, Post $post){
        $this->commentService->store($commentRequest->validated(),$post,Auth::user());
        return response()->json(['status' => true,'message' => 'comment posted successfully.',], 201);
    }
    public function reply(CommentRequest $commentRequest, Comment $comment){
        $this->commentService->reply($commentRequest->validated(),$comment,Auth::user());
        return response()->json(['status' => true,'message' => 'reply posted successfully.'], 201);
    }
    public function index(Post $post){
        $comments = $post->comments()->with(['user', 'reply.user'])       
            ->whereNull('discussion_id')->latest()->get();
        return response()->json(['status' => true,'data' => commentResource::collection($comments),
        ]);
    }
    public function destroy(Comment $comment){
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['status' => false,'message' => 'unauthorized.',], 403);
        }
        $this->commentService->delete($comment);
        return response()->json(['status'  => true,'message' => 'comment deleted successfully.',]);
    }

}
