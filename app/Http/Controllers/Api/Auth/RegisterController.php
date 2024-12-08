<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function __invoke(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (User::where('username', $data['username'])->exists()) {
            return response()->json([
                'errors' => [
                    'username' => ['Username already registered']
                ]
            ], 400);
        }

        $user = new User($data);
        $user->username = Str::lower($request['username']);
        $user->password = Hash::make($request['password'], PASSWORD_DEFAULT);
        $user->save();

        return (new UserResource($user))->response()->setStatusCode(201);
    }
}
