<?php

namespace App\Services;


use App\Models\Post;


class PostService extends BaseService
{
    private $post;

    public function __construct(Post $post)
    {
        parent::__construct();
        $this->post = $post;
    }

    public function index($cid)
    {
        $where = ['posts.status' => 1];
        if ($cid) {
            $where['posts.cid'] = $cid;
        }
        $field = [
            'users.name as author',
            'category.name as cname',
            'posts.*'
        ];
        $result = $this->post->leftJoin('users', 'users.id', '=', 'posts.user_id')->
        leftJoin('category', 'category.id', '=', 'posts.cid')->
        where($where)->select($field)->paginate();
        return $result;
    }

    public function store($attributes)
    {
        $result = $this->post->create($attributes);
        return $result;
    }

    public function show($id)
    {
        $where = [
            'posts.id' => $id,
            'posts.status' => 1
        ];
        $field = [
            'users.name as author',
            'category.name as cname',
            'posts.*'
        ];
        $result = $this->post->leftJoin('users', 'users.id', '=', 'posts.user_id')->
        leftJoin('category', 'category.id', '=', 'posts.cid')->
        where($where)->select($field)->firstOrFail();
        return $result;
    }
}