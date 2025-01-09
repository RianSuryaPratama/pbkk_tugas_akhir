<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\Paket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;

class PaketController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Paket::all();
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_paket.'" class="btn btn-success text-white rounded-pill btn-sm edit"><i class="bx bx-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_paket.'" class="btn btn-danger text-white rounded-pill btn-sm delete"><i class="bx bx-trash"></i></a> ';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		return view('page.paket.index');
	}
	public function save(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'nama_paket' => 'required',
			'harga_paket' => 'required',
			'waktu_paket' => 'required'
		];
		$validateMessage += [
			'nama_paket.required' => 'Nama Paket harus diisi.',
			'harga_paket.required' => 'Harga harus diisi.',
			'waktu_paket.required' => 'Waktu harus diisi.'
		];
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();

			$string = "Suka*()bumi #$^%& Kode ($%^2&^)*(0&*^19.";
			$harga_paket = preg_replace("/[^aZ0-9]/", "", $request->harga_paket);

			$data = New Paket();
			$data -> nama_paket = $request->nama_paket;
			$data -> harga_paket = $harga_paket;
			$data -> waktu_paket = $request->waktu_paket;
			$data -> keterangan_paket = $request->keterangan_paket;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Data Paket berhasil ditambahkan !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function get_edit($id_paket)
	{
		$data = Paket::where('id_paket',$id_paket)->get();
		return response()->json($data);
	}
	public function update(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'nama_paket' => 'required',
			'harga_paket' => 'required',
			'waktu_paket' => 'required'
		];
		$validateMessage += [
			'nama_paket.required' => 'Nama Paket harus diisi.',
			'harga_paket.required' => 'Harga harus diisi.',
			'waktu_paket.required' => 'Waktu harus diisi.'
		];
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			$string = "Suka*()bumi #$^%& Kode ($%^2&^)*(0&*^19.";
			$harga_paket = preg_replace("/[^aZ0-9]/", "", $request->harga_paket);

			$data = Paket::where('id_paket',$request->id_paket)->first();
			$data -> nama_paket = $request->nama_paket;
			$data -> harga_paket = $harga_paket;
			$data -> waktu_paket = $request->waktu_paket;
			$data -> keterangan_paket = $request->keterangan_paket;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Data Paket berhasil diubah !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function delete($id_paket)
	{
		try {
			DB::beginTransaction();
			$data = Paket::where('id_paket',$id_paket)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Data Paket berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
