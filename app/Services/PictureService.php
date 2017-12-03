<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class PictureService
{
    /**
     * 图片缩略图
     * @param $img_path 图片地址
     * @param $dir  存储目录(avatar/1)
     * @param $filename
     * @param $width
     * @param $height
     * @param $type 处理方式
     * @return bool
     */
    public function thumb($img_path, $dir, $filename, $width, $height, $type = 'resize')
    {
        $upload_picture_conf = config('filesystems.disks.upload_picture');
        $path = $upload_picture_conf['root'] . $upload_picture_conf['path'] . $dir . '/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if (!$filename) {
            $filename = uniqid();
        }
        $img = Image::make($img_path);
        switch ($type) {
            case 'resize':
                $img->resize($width, $height, function ($constraint) {
                    $constraint->upsize();
                });
                break;
            case 'fit':
                $img->fit($width, $height);
                break;
        }
        $img->save($path . $filename . '.' . $img->extension);
        if ($img->filename == $filename) {
            //相对地址
            return $upload_picture_conf['path'] . $dir . '/' . $img->filename . '.' . $img->extension;
        } else {
            return false;
        }
    }
}