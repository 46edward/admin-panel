<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {

        $data = $request->validate([
            'title' => 'string|required',
            'content' => 'string|required'
        ]);

        $post = Post::create($data);

        if($request->has('tags')) {
            foreach ($request->tags as $tag){
                $tag_id = Tag::where('name', $tag)->first();
                $post->tags()->attach($tag_id);
            }
        }

        return response($post);
    }
}
