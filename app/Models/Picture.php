<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Picture extends BaseModel
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path', 'url', 'md5', 'sha1', 'status'
    ];

}
