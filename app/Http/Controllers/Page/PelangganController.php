<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;

class PelangganController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Pelanggan::all();
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_pelanggan.'" class="btn btn-success text-white rounded-pill btn-sm edit"><i class="bx bx-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_pelanggan.'" class="btn btn-danger text-white rounded-pill btn-sm delete"><i class="bx bx-trash"></i></a> ';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		return view('page.pelanggan.index');
	}
	public function save(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'nama' => 'required',
			'telepon' => 'required',
			'alamat' => 'required'
		];
		$validateMessage += [
			'nama.required' => 'Nama Pelanggan harus diisi.',
			'telepon.required' => 'Telepon Pelanggan harus diisi.',
			'alamat.required' => 'Alamat Pelanggan harus diisi.'
		];
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();

			$data = New Pelanggan();
			$data -> nama = $request->nama;
			$data -> telepon = $request->telepon;
			$data -> alamat = $request->alamat;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Data Pelanggan berhasil ditambahkan !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function get_edit($id_pelanggan)
	{
		$data = Pelanggan::where('id_pelanggan',$id_pelanggan)->get();
		return response()->json($data);
	}
	public function update(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'nama' => 'required',
			'telepon' => 'required',
			'alamat' => 'required'
		];
		$validateMessage += [
			'nama.required' => 'Nama Pelanggan harus diisi.',
			'telepon.required' => 'Telepon Pelanggan harus diisi.',
			'alamat.required' => 'Alamat harus diisi.'
		];
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			$data = Pelanggan::where('id_pelanggan',$request->id_pelanggan)->first();
			$data -> nama = $request->nama;
			$data -> telepon = $request->telepon;
			$data -> alamat = $request->alamat;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Data Pelanggan berhasil diubah !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function delete($id_pelanggan)
	{
		try {
			DB::beginTransaction();
			$data = Pelanggan::where('id_pelanggan',$id_pelanggan)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Data Pelanggan berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
