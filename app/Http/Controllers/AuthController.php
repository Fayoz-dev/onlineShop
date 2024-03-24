<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect .']
            ]);
        }
        return $this->success('Login Succesfuly',['token' => $user->createToken($request->email)->plainTextToken]);
//        return response()->json([
//            'token' => $user->createToken($request->email)->plainTextToken
//        ]);
    }

    public function register(RegisterRequest $registerRequest)
    {
        $data = $registerRequest->validated();
        $data['password'] = Hash::make($registerRequest->password);
        $user = User::create($data);
        $user->assignRole('customer');

        if ($registerRequest->hasFile('photo')){
            $path = $registerRequest->file('photo')->store('users/'. $user->id, 'public');
            $user->photos()->create([
                'full_name' => $registerRequest->file('photo')->getClientOriginalName(),
                'path' => $path
            ]);
        }

        return $this->success('user created success',
        ['token' => $user->createToken($registerRequest->email)->plainTextToken]
        );
    }

    public function logout()
    {

    }

    public function changePassword()
    {

    }

    public function user(Request $request)
    {
        return $this->response(new UserResource($request->user()));
    }
}
