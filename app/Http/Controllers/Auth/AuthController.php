<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(loginRequest $request)
    {
        $validated = $request->validated();
        if(!Auth::attempt($validated))
        {
            return response()->json([
                'message' => 'invalid credentials'
            ],401);
        }

        $user = User::where('email',$validated['email'])->first();

        return response()->json([
            'data' => $user,
            'token' => $user->createToken('api_token')->plainTextToken
        ]);

    }

    public function register(UserRequest $request)
    {
        $validated = $request->validated();
        if(!array_key_exists('PC',$validated) && array_key_exists('program_id',$validated))
        {
            return response()->json([
                'message' => 'You have to be a program coordinator or teaching staff to be register in a program'
            ], 401);
        }

        $user = User::create($validated);
        if(array_key_exists('program_id',$validated))
        {
            $user->program()->sync($validated['program_id']);
        }
        return response()->json([
            'token' => $user->createToken('api_token')->plainTextToken
        ], 201);
    }

}
