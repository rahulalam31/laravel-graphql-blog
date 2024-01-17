<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PostService
{


    public function getAll()
    {
        // return cache('posts', function(){
            return Post::with('tag')->latest()->get();
        // });
    }
    public function show($slug)
    {
        return Post::with('tag')->where('slug', $slug)->first();
    }
    public function store($data)
    {
        Cache::flush();

        $post = new Post;
        $post->title = $data->title;
        $post->slug = Str::slug($data->title, '-'). '-' . uniqid();
        $post->content = $data->content;
        $post->tag_id = $data->tag_id;
        $post->user_id = auth()->user()->id;
        $post->save();

        return $post;
    }
}
