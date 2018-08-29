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
        $input = $request->only('name', 'email', 'password', 'is_admin');
        $attributes = [
            'name' => $input['name'],
            'email' => $input['email'],
            'is_admin' => $input['is_admin'],
            'password' => app('hash')->make($input['password']),
        ];
        $admin = Admin::create($attributes);

        $authorization = new Authorization(Auth::fromUser($admin));
        $authorization_arr = $authorization->toArray();
        $admin->token = $authorization_arr['token'];
        $admin->expired_at = $authorization_arr['expired_at'];
        $admin->refresh_expired_at = $authorization_arr['refresh_expired_at'];
        return $this->responseItem($admin, new AdminTransformer());
    }

    public function adminShow()
    {
        /*if (Gate::allows('users_manage')) {
            return abort(401, trans('msg.no_abilitie'));
        }*/
        return $this->responseItem($this->user(), new AdminTransformer());
    }
}
