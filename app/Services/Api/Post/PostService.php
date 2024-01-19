<?php

namespace App\Services\Api\Post;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService
{

    public function showAllPostData()
    {
        return response()->json([
            'status' => 'success',
            'posts' => Post::all(),
        ]);
    }

    public function storePostData($user, $data)
    {
        try {
            $post = $user->posts()->create($data);
            return response()->json([
                'status' => true,
                'message' => "Post was successfully created!",
                'post' => $post,
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'post' => $exception->getCode(),
            ], 200);
        }

    }

    public function showPostData($post)
    {

           $postToFind = Post::findOrFail($post);

           if ($postToFind) {
               return response()->json([
                   'status' => 'success',
                   'post' => $postToFind,
               ]);
           } else
            return response()->json([
                'status' => false,
                'message' => "Post was not found!",
                'post' => "No data",
            ], 200);

    }


    public function updatePostData($userId, $post, $data)
    {
        if ($post->user->id == $userId) {
            $post->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Post was successfully updated',
                'post' => $post,
            ]);
        } else return response()->json(['error' => 'You cannot change not yours post']);

    }

    public function destroyPostData($user, $post)
    {
        if ($post->user->id == $user) {
            $post->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Post was successfully deleted',
                'post' => $post,
            ]);
        } else return response()->json(['error' => 'You cannot delete not yours post']);

    }
}
