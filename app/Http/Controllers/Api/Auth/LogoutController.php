<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(?Request $request): JsonResponse
    {
        $user = Auth::user()->id;
        $user->token = null;
        $user->save();

        return response()->json(['data' => '', 'message' => 'Logout success']);
    }
}
