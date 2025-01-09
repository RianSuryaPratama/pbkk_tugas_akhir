<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\Transaksi;
use App\Models\Page\Pelanggan;
use App\Models\Page\Paket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;
use File;

class HomeController extends Controller
{
	public function index(Request $request)
	{
		$results = Transaksi::join('transaksi_detail','transaksi_detail.id_transaksi','=','transaksi.id_transaksi')
		->join('paket','paket.id_paket','=','transaksi_detail.id_paket')
		->leftJoin('pelanggan','pelanggan.id_pelanggan','=','transaksi.id_pelanggan')
		->leftJoin('users','users.id','=','transaksi.id_user')
		->select(
			DB::raw('SUM(paket.harga_paket*transaksi_detail.berat) AS laundry'),
			DB::raw('MONTH(transaksi.tanggal) as month')
		);
		$results = $results->groupBy('month')
		->orderBy('month')
		->whereYear('transaksi.tanggal',date('Y'))
		->where('transaksi.pembayaran','Lunas')
		->where('transaksi.status','Diambil')
		->get();

		$data = [];
		for ($month = 1; $month <= 12; $month++) {
			$monthLabel = date('F', mktime(0, 0, 0, $month, 1));
			$data['label'][] = $monthLabel;
			$resultForMonth = $results->firstWhere('month', $month);
			$data['data']['laundry'][] = $resultForMonth ? $resultForMonth->laundry : 0;
		}
		$data['chart_data'] = json_encode($data);
		$pelanggan = Pelanggan::count();
		$paket = Paket::count();
		$admin = User::getUser();
		$hari_ini = Transaksi::whereDate('tanggal', '=', date('Y-m-d'))->count();
		$minggu_ini = Transaksi::whereBetween('tanggal', [
			\Carbon\Carbon::now()->startOfWeek()->format('Y-m-d'),
			\Carbon\Carbon::now()->endOfWeek()->format('Y-m-d')
		])->count();
		return view('page.dashboard.index',$data,compact('pelanggan','paket','admin','hari_ini','minggu_ini'));
	}
	public function myprofil()
	{
		$data = User::getMyProfil();
		return view('page.myprofil.index',compact('data'));
	}
	public function update_profil(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'name' => 'required',
			'email' => 'required',
			'telepon' => 'required',
			'alamat' => 'required'
		];
		$validateMessage += [
			'name.required' => 'Nama harus diisi.',
			'email.required' => 'Email harus diisi.',
			'telepon.required' => 'Telepon harus diisi.',
			'alamat.required' => 'Alamat harus diisi.'
		];
		$request->validate($validateRules, $validateMessage);
		$user = User::join('biodata','biodata.id_user','=','users.id')
		->where('users.id',Auth::user()->id)
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
			$data = User::where('id',Auth::user()->id)->first();
			$data -> name = $request->name;
			$data -> email = $request->email;
			if ($request->password != '') {
				$data -> password = hash::make($request->password);
			}
			$data -> save();

			if (!empty($request->file('foto'))) {
				$ambil=$request->file('foto');
				$name=$ambil->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $name;
				$ambil->move(\base_path()."/public/foto", $namaFileBaru);
				$berkas = public_path("foto/".$request->fotoLama);
				File::delete($berkas);
			}else{
				$namaFileBaru = $request->fotoLama;
			}
			$biodata = [
				'telepon' => $request->telepon,
				'foto' => $namaFileBaru,
				'alamat' => $request->alamat
			];
			DB::table('biodata')->where('id_user', Auth::user()->id)->update($biodata);
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Profil berhasil diperbarui !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
