<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function __invoke(UserLoginRequest $request): UserResource
    {
        $data = $request->validated();

        $user = User::where('username', $request['username'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'errors' => [
                    'message' => ['Username or password wrong']
                ]
            ], 400);
        }

        //  Buat token baru
        $user->token = Str::uuid()->toString();
        $user->save();

        return new UserResource($user);
    }
}
