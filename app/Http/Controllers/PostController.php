<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepostRequest;
use App\Models\Post;
use App\Service\Post\PostService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;
use SebastianBergmann\Diff\Exception;

class PostController extends Controller
{
    protected $post;

    /**
     * @param PostService $post
     */
    public function __construct(PostService $post)
    {
        $this->post = $post;
    }

    /**
     * @return Response
     */
    public function CreatePost(): Response
    {
        return Inertia::render('CreatePost');
    }

    /**
     * @param CreatepostRequest $request
     * @return JsonResponse
     */
    public function savePost(CreatepostRequest $request): JsonResponse
    {
        try {
            $this->post->createPost($request);

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {

            return response()->json(['status' => 500]);
        }
    }

    /**
     * @return Builder[]|Collection
     */
    public function getPosts()
    {
        return Post::query()->orderBy('id', 'DESC')->get();
    }

    /**
     * @param $id
     * @return Response
     */
    public function updatePost($id): Response
    {
        $post = Post::where('id', $id)->first();

        return Inertia::render('UpdatePost')->with(['post' => $post]);
    }

    /**
     * @param CreatepostRequest $request
     * @return void
     */
    public function editPost(CreatepostRequest $request)
    {
        $this->post->editPost($request);
    }
}
