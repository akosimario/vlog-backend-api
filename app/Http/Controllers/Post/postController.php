<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\postRequest;
use App\Http\Resources\postResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class postController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService){
        $this->postService = $postService;
    }
    public function storeContent(postRequest $postRequest){
        $this->postService->create($postRequest->validated(), Auth::user(), $postRequest);
        return response()->json(['status' => true, 'message' => 'posted succesfully'], 201);
    }
    public function fetchContent(){
        $posts = Post::with('user')->with('comments')->withCount('comments')
            ->latest()->get();
        return PostResource::collection($posts);
    }
    public function updateContent(PostRequest $postRequest, Post $post){
        if ($post->user_id !== Auth::id()) {
            return response()->json(['status' => false,'message' => 'unauthorized.',], 403);
        }
        $post = $this->postService->update($postRequest->validated(),$post,$postRequest);
        return response()->json(['status' => true, 'message' => 'post updated successfully.']);
    }
    public function destroyContent(Post $post){
        if ($post->user_id !== Auth::id()) {
            return response()->json(['status' => false,'message' => 'unauthorized.',], 403);
        }
        $this->postService->delete($post);
        return response()->json(['status'=> true,'message' => 'post deleted successfully.']);
    }
    
}
