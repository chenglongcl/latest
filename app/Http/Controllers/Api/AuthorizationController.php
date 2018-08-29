<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Authorization;
use Illuminate\Http\Request;
use App\Http\Requests\Api\StoreAuthRequest;
use App\Http\Transformers\AuthorizationTransformer;

class AuthorizationController extends Controller
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
    public function store(StoreAuthRequest $request)
    {
        $input = $request->only('name', 'password');
        $credentials = [
            $this->username($input['name']) => $input['name'],
            'password' => $input['password'],
        ];
        if (!$token = Auth::attempt($credentials)) {
            abort(401, '用户名或密码错误');
        }
        $authorization = new Authorization($token);
        $user = Auth::getUser();
        $result = [
            'id' => $user->id,
            'name' => $user->name,
            'token' => $authorization->getToken(),
            'expired_at' => $authorization->getExpiredAt(),
            'refresh_expired_at' => $authorization->getRefreshExpiredAt()
        ];
        return $this->responseData($result, 0);
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
    public function update()
    {
        $authorization = new Authorization(Auth::refresh());
        return $this->response->item($authorization, new AuthorizationTransformer())->setStatusCode(201);
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

    /**
     * Get user login field.
     *
     * @param string $login
     * @param string $default
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    protected function username($login, $default = 'name')
    {
        $map = [
            'email' => filter_var($login, FILTER_VALIDATE_EMAIL),
            'mobile' => preg_match(
                '/^(\+?0?86\-?)?((13\d|14[57]|15[^4,\D]|17[3678]|18\d)\d{8}|170[059]\d{7})$/', $login),
        ];
        foreach ($map as $field => $value) {
            if ($value) {
                return $field;
            }
        }
        return $default;
    }
}
