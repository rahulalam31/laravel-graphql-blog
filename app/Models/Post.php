<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasUuids,HasFactory;

    protected $fillable = ['title','slug','content','tag_id'];
    /**
     * Get the route key for the model.
     */
    // public function getRouteKeyName(): string
    // {
    //     return 'slug';
    // }
    public function tag()
    {
        return $this->belongsTo(tag::class, 'tag_id', 'id');
    }
}
