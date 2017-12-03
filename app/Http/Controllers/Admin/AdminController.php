<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Transformers\AdminTransformer;
use App\Models\Admin;
use App\Models\Authorization;
use Auth;

class AdminController extends Controller
{

    public function store(StoreAdminRequest $request)
    {
        $input = $request->only('name', 'email', 'password', 'role');
        $attributes = [
            'name' => $input['name'],
            'email' => $input['email'],
            'role' => $input['role'],
            'password' => app('hash')->make($input['password']),
        ];
        $admin = Admin::create($attributes);
        $authorization = new Authorization(Auth::guard('admin')->fromUser($admin));
        $transformer = new AdminTransformer();
        $transformer->setAuthorization($authorization)->setDefaultIncludes(['authorization']);

        return $this->response->item($admin, $transformer)
            ->setStatusCode(201);
    }

    public function adminShow()
    {
        return $this->response->item(Auth::guard('admin')->user(), new AdminTransformer());
    }
}
