<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan dalam memasukkan data',
                'data' => $validator->errors(),
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $user->assignRole('user');

        $token = $user->createToken('auth_token')->plainTextToken;
        $success['token'] = $token;
        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi Berhasil',
            'data' => $success,
        ]);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();

            $success['token'] = $auth->createToken('auth_token')->plainTextToken;

            $success['name'] = $auth->name;

            if ($auth->hasRole('admin')) {
                return response()->json(['success' => true, 'message' => 'Login berhasil sebagai admin', 'data' => $success]);
            } elseif ($auth->hasRole('user')) {
                return response()->json(['success' => true, 'message' => 'Login berhasil sebagai pengguna', 'data' => $success]);
            } else {
                return response()->json(['success' => false, 'message' => 'Anda bukan bagian dari website ini', 'data' => null]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Cek kembali email dan password anda', 'data' => null]);
        }
    }
}
