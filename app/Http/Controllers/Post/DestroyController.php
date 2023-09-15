<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagResource;
use App\Models\Post;
use App\Models\Tag;

class DestroyController extends Controller
{
    public function __invoke(Post $post)
    {
        $post->delete();
        return response([]);
    }
}
