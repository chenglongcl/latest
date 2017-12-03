<?php

namespace App\Http\Controllers\Api;

use Image;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Requests\Api\StorePhotoRequest;
use App\Http\Transformers\PictureTransformers;


class UploadPicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StorePhotoRequest $request)
    {
        $upload_picture_conf = config('filesystems.disks.upload_picture');
        $file = $request->file('picture');
        $ext = $file->getClientOriginalExtension();
        $filename = uniqid() . '.' . $ext;
        $path = $upload_picture_conf['root'] . $upload_picture_conf['path'] . date('Ymd');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        Image::make($file)->resize(750, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($path . '/' . $filename);
        $attributes = [
            'path' => $upload_picture_conf['path'] . date('Ymd') . '/' . $filename
        ];
        $picture = Picture::create($attributes);
        return $this->response->item($picture, new PictureTransformers());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
