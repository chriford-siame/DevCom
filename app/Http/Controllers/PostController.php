<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     description="User Model",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="User ID"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="User name"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="User email"
 *     )
 * )
 */


class PostController extends Controller
{

    // /**
    //  * @OA\Post(
    //  *     path="/api/posts",
    //  *     summary="Create a new post",
    //  *     description="Creates a new post and returns the created post",
    //  *     @OA\RequestBody(
    //  *         required=true,
    //  *         @OA\JsonContent(
    //  *             required={"title", "description"},
    //  *             @OA\Property(property="title", type="string", example="John Doe"),
    //  *             @OA\Property(property="description", type="string", format="email", example="john.doe@example.com"),
    //  *         ),
    //  *     ),
    //  *     @OA\Response(
    //  *         response=201,
    //  *         description="post created",
    //  *         @OA\JsonContent(ref="#/components/schemas/Post")
    //  *     )
    //  */ 
    public function post_create(Request $request)
    {
        $post_data = $request->validate([
            "title" => ["required", "max:50", "min:1"],
            "body" => ["required", "max:800"],
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        $response = response()->json([
            "data" => $post,
            "message" => "Post created successfully",
        ], 201);
        return $response;
    }

    /**
     * @OA\Get(
     *     path="/api/posts",
     *     @OA\Response(response="200", description="A post method")
     * )
     */
    public function get_posts()
    {
        $response = Post::all();
        return new PostResource($response);
    }


    public function get_post(Post $post)
    {
        $post = Post::find($post);
        if (!empty($post)) {
            $response = response()->json($post, 200);
            return $response;
        } else {
            $response = response()->json([
                "message" => "Blog post not found"
            ], 404);
            return $response;
        }
        // return new PostResource($response);
    }


    public function update_post(Request $request, Post $post)
    {
        if (Post::where('id', $post)->exists()) {

            $post = Post::find($post);
            $post->title = is_null($request->title) ? $post->title : $request->title;
            $post->body = is_null($request->body) ? $post->body : $request->body;
            $post->save();
            $response = response()->json([
                "message" => "Post updated"
            ], 404);
            return $response;
        } else {
            $response = response()->json([
                "message" => "Post not found"
            ], 404);
            return $response;
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/delete/{id}",
     * @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id"},
     *             @OA\Property(property="post", type="string", example="1"),
     *         ),
     *     ),
     * )
     */
    public function delete_post(Post $post)
    {
        if (Post::where("id", $post)->exists()) {
            $post = Post::find($post);
            $post->delete();
            $response = response()->json([
                "message" => "Post deleted successfully"
            ], 202);
            return $response;
        } else {
            $response = response()->json([
                "message" => "Post not found"
            ], 404);
            return $response;
        }
    }
}
