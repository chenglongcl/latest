<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 10:09
 */

namespace App\Http\Transformers;


use App\Models\Picture;
use League\Fractal\TransformerAbstract;

class PictureTransformers extends TransformerAbstract
{
    public function transform(Picture $picture)
    {
        return $picture->attributesToArray();
    }
}