<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Return a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $posts = Post::all();

        return response()->json(PostResource::collection($posts), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $newPost = Post::create($request->validated());

        return response()->json(new PostResource($newPost), 201);
    }

    /**
     * Display a listing of the resource.
     */
    public function showAll(): Response
    {
        return Inertia::render('Post/Index');
    }

    /**
     * Display the specified resource.
     */
    public function showDetail(Post $post): Response
    {
        $post = Post::where('id', $post->id)->with(['categories', 'genders'])->first();

        return Inertia::render('Post/Detail', [
            'post' => $post,
        ]);
    }

    /**
     * Return the specified resource.
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json(new PostResource($post), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $post->update($request->validated());

        return response()->json(new PostResource($post), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json()->setStatusCode(204);
    }
}
