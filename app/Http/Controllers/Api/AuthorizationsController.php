<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WeappAuthorizationRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class AuthorizationsController extends Controller
{
    public function weappStore(WeappAuthorizationRequest $request)
    {
        $code = $request->code;

        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);

        if (isset($data['errcode'])) {
            throw new AuthenticationException('code 不正确');
        }

        $user = User::where('weapp_openid', $data['openid'])->first();

        $attributes = $request->only(['name', 'avatar']);
        $attributes['weixin_session_key'] = $data['session_key'];

        if (!$user) {
            $attributes['password'] = '123456';
            $attributes['weapp_openid'] = $data['openid'];
            $user = User::create($attributes);
        }

        $user->fill($attributes);
        $user->save();

        $token = auth()->login($user);

        return $this->respondWithToken($token)->setStatusCode(201);
    }

    public function destroy()
    {
        auth()->logout();
        return response(null, 204);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
