<?php

namespace App\Http\Controllers\Api;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Requests\Api\StorePostRequest;
use App\Http\Transformers\PostTransformer;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cid = '')
    {
        $posts = $this->postService->index($cid);
        return $this->responsePaginate($posts, new PostTransformer());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $user = $this->user();
        $attributes = array_filter($request->only('cid', 'title', 'thumb', 'content', 'view'));
        if ($attributes) {
            $attributes['user_id'] = $user->id;
            $post = $this->postService->store($attributes);
        }
        return $this->responseItem($post, new PostTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postService->show($id);
        return $this->responseItem($post, new PostTransformer());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
