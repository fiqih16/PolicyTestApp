<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request) {
        $post = new Post();
        $post->text = $request->text;
        $post->user_id = $request->user()->id;
        $post->save();

        return response(['Success' => true]);
    }

    public function delete(Request $request,Post $post) {
        if ($request->user()->cannot('delete', $post)) {
            return response(['error' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response(['success' => true]);
    }

    public function update(Request $request, Post $post) {
        if ($request->user()->cannot('update', $post)) {
            return response(['error' => 'unauthorized'], 403);
        }

        $post->text = $request->text;
        $post->save();

        return response(['success' => true]);
    }
}
