<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;
class PostService
{
    protected PostRepository $postRepository;
    public function __construct(PostRepository $postRepository){
        $this->postRepository = $postRepository;
    }
    public function create(array $data, $request){
        $imagePath = $this->handleImgUpload($request);
        return $this->postRepository->create(['user_id' => Auth::id() ?? 2,
            'title' => $data['title'],
            'body' => $data['body'],
            'image_url' => $imagePath,
            'video_url' => $data['video_url'] ?? '']);
    }
    private function handleImgUpload($request){
        if (!$request->hasFile('image')) {
            return null;
        }
        $fileName = $request->file('image')->hashName();
        $request->file('image')->move(public_path('uploads/images'), $fileName);

        return asset('uploads/images/' . $fileName);
    }
    public function update(array $data, Post $post){
        if (!empty($data['image'])) {
            $data['image_url'] = $this->handleImgUpload($data['image']);
        }
        $postData = ['title' => $data['title'] ?? $post->title,
            'body' => $data['body'] ?? $post->body,
            'image_url' => $data['image_url'] ?? $post->image_url,
            'video_url' => $data['video_url'] ?? $post->video_url,];
        $this->postRepository->update($postData,$post);
        return $post;
    }
    public function delete(Post $post)
    {
        $post->delete();
    }
}
