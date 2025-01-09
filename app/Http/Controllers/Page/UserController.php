<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = User::getUser();
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id.'" class="btn btn-success text-white rounded-pill btn-sm edit"><i class="bx bx-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id.'" class="btn btn-danger text-white rounded-pill btn-sm delete"><i class="bx bx-trash"></i></a> ';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		return view('page.user.index');
	}
	public function save(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'name' => 'required',
			'password' => 'required',
			'email' => 'required|unique:users,email',
			'status_user' => 'required',
			'telepon' => 'required',
			'alamat' => 'required'
		];
		$validateMessage += [
			'name.required' => 'Nama harus diisi.',
			'password.required' => 'Password harus diisi.',
			'email.required' => 'Email harus diisi.',
			'email.unique' => 'Email yang digunakan sudah terdaftar.',
			'status_user.required' => 'Status User harus dipilih.',
			'telepon.required' => 'Telepon harus diisi.',
			'alamat.required' => 'Alamat harus diisi.'
		];
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			$password = $request->password;

			$data = New User();
			$data -> name = $request->name;
			$data -> email = $request->email;
			$data -> password = hash::make($password);
			$data -> level = 'Admin';
			$data -> status_user = $request->status_user;
			$data -> save();
			if (!empty($request->file('upload'))) {
				$ambil=$request->file('upload');
				$name=$ambil->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $name;
				$ambil->move(\base_path()."/public/foto", $namaFileBaru);
			}else{
				$namaFileBaru = NULL;
			}
			DB::table('biodata')->insert([
				'id_user'=>$data->id,
				'telepon'=>$request->telepon,
				'foto'=>$namaFileBaru,
				'alamat'=>$request->alamat
			]);
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'User Admin berhasil ditambahkan !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function get_edit($id_user)
	{
		$data = User::getEditUser($id_user);
		return response()->json($data);
	}
	public function update(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'name' => 'required',
			'email' => 'required',
			'status_user' => 'required',
			'telepon' => 'required',
			'alamat' => 'required'
		];
		$validateMessage += [
			'name.required' => 'Nama harus diisi.',
			'email.required' => 'Email harus diisi.',
			'status_user.required' => 'Status User harus dipilih.',
			'telepon.required' => 'Telepon harus diisi.',
			'alamat.required' => 'Alamat harus diisi.'
		];
		$request->validate($validateRules, $validateMessage);
		$user = User::join('biodata','biodata.id_user','=','users.id')
		->where('users.id',$request->id_user)
		->first();
		if ($user->email != $request->email) {
			$request->validate([
				'email' => 'unique:users,email'
			],[
				'email.unique' => 'Email yang anda masukkan sudah terdaftar.',
			]);
		}
		try {
			DB::beginTransaction();
			$data = User::where('id',$request->id_user)->first();
			$data -> name = $request->name;
			if ($request->password != '') {
				$data -> password = hash::make($request->password);
			}
			$data -> email = $request->email;
			$data -> status_user = $request->status_user;
			$data -> save();
			if (!empty($request->file('upload'))) {
				$ambil=$request->file('upload');
				$name=$ambil->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $name;
				$ambil->move(\base_path()."/public/foto", $namaFileBaru);
			}else{
				$namaFileBaru = $request->uploadLama;
			}
			DB::table('biodata')->where('id_user',$request->id_user)->update([
				'telepon'=>$request->telepon,
				'foto'=>$namaFileBaru,
				'alamat'=>$request->alamat
			]);
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'User Admin berhasil diubah !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function delete($id_user)
	{
		try {
			DB::beginTransaction();
			$data = User::where('id',$id_user)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Data Admin berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
