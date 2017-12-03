<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'cid', 'title', 'thumb', 'content', 'view', 'comment_count'
    ];

    /**
     *
     */
    public function author()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id')->
        select(['name', 'avatar']);
    }
}
