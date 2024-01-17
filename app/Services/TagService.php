<?php

namespace App\Services;

use App\Models\Post;
use App\Models\tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class TagService
{


    public function getAll()
    {
        return cache('tags', function(){
            return tag::all();
        });
    }
    public function store($data)
    {
        Cache::flush();
        $tag = new tag;
        $tag->name = $data->name;
        $tag->slug = Str::slug($data->name, '-');
        $tag->save();

        return $tag;
    }
    public function show($slug)
    {
        // $tag = tag::where('slug', $slug)->first();
        // return Post::with('tag')->where('tag_id', $tag->id)->latest()->get();
        return Post::with('tag')->whereHas('tag', function($query) use($slug) {
            $query->where('slug',$slug);
        });
    }
}
