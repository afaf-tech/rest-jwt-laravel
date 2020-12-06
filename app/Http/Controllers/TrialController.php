<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use JWTAuth;

use Illuminate\Support\Str;

class TrialController extends Controller
{

    public function bearerToken($request)
    {
        $header = $request->header('Authorization', '');
        if (Str::startsWith($header, 'Bearer ')) {
                    return Str::substr($header, 7);
        }
    }
    public function book() {
        $data = "Data All Book";
        return response()->json($data, 200);
    }

    public function bookAuth(Request $request) {
        $token = $this->bearerToken($request);
        $user = JWTAuth::toUser($token);
        $payload = JWTAuth::getPayload($this->bearerToken($request));

        dd($user->name);
        $user = JWTAuth::setToken($token)->toUser();;

        $data = "Welcome " . Auth::user()->name;
        return response()->json($data, 200);
    }
}
