<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Transformers\AdminTransformer;
use App\Models\Admin;
use App\Models\Authorization;
use Auth;
use Illuminate\Support\Facades\Gate;

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
        $authorization = new Authorization(Auth::fromUser($admin));
        $transformer = new AdminTransformer();
        $transformer->setAuthorization($authorization)->setDefaultIncludes(['authorization']);

        return $this->response->item($admin, $transformer)
            ->setStatusCode(201);
    }

    public function adminShow()
    {
        /*if (!Gate::allows('users_manage')) {
            return abort(401, '无访问权限');
        }*/
        return $this->response->item($this->user(), new AdminTransformer());
    }
}