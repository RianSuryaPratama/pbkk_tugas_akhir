<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
	public function ceklogin(Request $request)
	{
		if (Auth::attempt(['email'=>$request->email,'password'=>$request->password,'status_user'=>'A'])) {
			if (Auth::user()->level == 'Owner') {
				return response()->json([
					'status' => 'true',
					'title'=>'Login Berhasil',
					'message'=>'Login berhasil, selamat beraktivitas !!',
					'url'=>route('index.dashboard')
				]);
			}elseif (Auth::user()->level == 'Admin') {
				return response()->json([
					'status' => 'true',
					'title'=>'Login Berhasil',
					'message'=>'Login berhasil, selamat beraktivitas !!',
					'url'=>route('index.dashboard')
				]);
			}
		}else{
			return response()->json([
				'status' => 'false',
				'title'=>'Login Gagal',
				'message'=>'Email/Password yang anda masukkan tidak sesuai.'
			]);
		}
	}
	public function logout(Request $request)
	{
		Auth::logout();
		return redirect('/');
	}
}
