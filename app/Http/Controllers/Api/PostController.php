<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostCreateRequest;
use App\Http\Requests\Api\PostUpdateRequest;
use App\Models\Post;
use App\Services\Api\Post\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(PostService $service): \Illuminate\Http\JsonResponse
    {
        return $service->showAllPostData();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request, PostService $service): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        return $service->storePostData(auth()->user(), $data);
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post, PostService $service): \Illuminate\Http\JsonResponse
    {
        return $service->showPostData($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post, PostService $service): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        return $service->updatePostData(auth()->user()->id, $post, $data);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, PostService $service): \Illuminate\Http\JsonResponse
    {
        return $service->destroyPostData(auth()->user()->id,$post);
    }
}
