<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Requests\Api\PatchUserRequest;
use App\Models\Authorization;
use App\Http\Transformers\UserTransformer;
use App\Services\PictureService;


class UserController extends Controller
{
    protected $pictureService;

    public function __construct(PictureService $pictureService)
    {
        $this->pictureService = $pictureService;
    }

    public function store(StoreUserRequest $request)
    {
        $input = $request->only('name', 'email', 'password');
        $attributes = [
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => app('hash')->make($input['password']),
        ];
        $user = User::create($attributes);

        $authorization = new Authorization(Auth::fromUser($user));
        $authorization_arr = $authorization->toArray();
        $user->token = $authorization_arr['token'];
        $user->expired_at = $authorization_arr['expired_at'];
        $user->refresh_expired_at = $authorization_arr['refresh_expired_at'];
        return $this->responseItem($user, new UserTransformer());
    }

    public function userShow()
    {
        return $this->responseItem($this->user(), new UserTransformer());
    }

    public function patch(PatchUserRequest $request)
    {
        $user = $this->user();
        $attributes = array_filter($request->only('realname', 'avatar'));
        if ($attributes['avatar'] && file_exists('./' . $attributes['avatar'])) {
            $avatar_result = $this->pictureService->thumb(
                './' . $attributes['avatar'],
                'avatar/' . $user->id,
                'avatar',
                '300',
                '300',
                'fit'
            );
            if ($avatar_result) {
                $attributes['avatar'] = $avatar_result;
            } else {
                unset($attributes['avatar']);
            }
        }
        if ($attributes) {
            $user->where(['id' => $user->id])->update($attributes);
        }
        return $this->responseItem($user, new UserTransformer());
    }
}
