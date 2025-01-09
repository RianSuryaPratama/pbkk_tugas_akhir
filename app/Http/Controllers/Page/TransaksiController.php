<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\Transaksi;
use App\Models\Page\Paket;
use App\Models\Page\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;
use PDF;

class TransaksiController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Transaksi::getTransaksi($request);
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_transaksi.'" class="btn btn-success text-white rounded-pill btn-sm edit"><i class="bx bx-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_transaksi.'" class="btn btn-danger text-white rounded-pill btn-sm delete"><i class="bx bx-trash"></i></a> ';
				$button .= '<a href="'.route('invoice',$data->id_transaksi).'" target="_blank" class="btn btn-info text-white rounded-pill btn-sm invoice"><i class="fa fa-file"></i></a> ';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		$paket = Paket::all();
		$pelanggan = Pelanggan::all();
		return view('page.transaksi.index',compact('paket','pelanggan'));
	}
	public function save(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'id_pelanggan' => 'required',
			'tanggal' => 'required',
			'status' => 'required',
			'pembayaran' => 'required',
			'estimasi' => 'required'
		];
		$validateMessage += [
			'id_pelanggan.required' => 'Pelanggan harus dipilih.',
			'tanggal.required' => 'Tanggal harus diisi.',
			'status.required' => 'Status harus dipilih.',
			'pembayaran.required' => 'Pembayaran harus dipilih.',
			'estimasi.required' => 'Estimasi harus dipilih.'
		];
		if (isset($request->transaksi)) {
			foreach ($request->transaksi as $key => $value) {
				$validateRules += [
					'transaksi.*.id_paket' => 'required',
					'transaksi.*.berat' => 'required'
				];
				$validateMessage += [
					'transaksi.*.id_paket.required' => 'Nama Paket harus dipilih.',
					'transaksi.*.berat.required' => 'Berat harus diisi.'
				];
			}
		}
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			$data = New Transaksi();
			$data -> id_user = Auth::user()->id;
			$data -> id_pelanggan = $request->id_pelanggan;
			$data -> tanggal = $request->tanggal;
			$data -> estimasi = $request->estimasi;
			$data -> status = $request->status;
			$data -> pembayaran = $request->pembayaran;
			$data -> catatan = $request->catatan;
			$data -> save();

			if (isset($request->transaksi)) {
				$id_paket_array = [];
				foreach ($request->transaksi as $key => $value) {
					if (in_array($value['id_paket'], $id_paket_array)) {
						return response()->json(['status'=>'warning','message'=>'Paket tidak boleh sama dalam 1 transaksi.']);
					}
					$id_paket_array[] = $value['id_paket'];
					DB::table('transaksi_detail')->insert([
						'id_transaksi'=>$data->id_transaksi,
						'id_paket'=>$value['id_paket'],
						'berat'=>$value['berat']
					]);
				}
			}else{
				return response()->json(['status'=>'warning','message'=>'Detail Paket harus ditambahkan minimal 1.']);
			}
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Transaksi baru berhasil ditambahkan !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function get_edit($id_transaksi)
	{
		$result = Transaksi::getEdit($id_transaksi);
		$data = $result['data'];
		$detail = $result['detail'];
		return response()->json(['data'=>$data,'detail'=>$detail]);
	}
	public function update(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'id_pelanggan' => 'required',
			'tanggal' => 'required',
			'status' => 'required',
			'pembayaran' => 'required',
			'estimasi' => 'required'
		];
		$validateMessage += [
			'id_pelanggan.required' => 'Pelanggan harus dipilih.',
			'tanggal.required' => 'Tanggal harus diisi.',
			'status.required' => 'Status harus dipilih.',
			'pembayaran.required' => 'Pembayaran harus dipilih.',
			'estimasi.required' => 'Estimasi harus dipilih.'
		];
		if (isset($request->transaksi)) {
			foreach ($request->transaksi as $key => $value) {
				$validateRules += [
					'transaksi.*.id_paket' => 'required',
					'transaksi.*.berat' => 'required'
				];
				$validateMessage += [
					'transaksi.*.id_paket.required' => 'Nama Paket harus dipilih.',
					'transaksi.*.berat.required' => 'Berat harus diisi.'
				];
			}
		}
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			$data = Transaksi::where('id_transaksi',$request->id_transaksi)->first();
			$data -> id_user = Auth::user()->id;
			$data -> id_pelanggan = $request->id_pelanggan;
			$data -> tanggal = $request->tanggal;
			$data -> estimasi = $request->estimasi;
			$data -> status = $request->status;
			$data -> pembayaran = $request->pembayaran;
			$data -> catatan = $request->catatan;
			$data -> save();
			if (!empty($request->id_detail_del)) {
				$id_detail_del = explode(",", $request->id_detail_del);
				DB::table('transaksi_detail')->whereIn('id_transaksi_detail',$id_detail_del)->delete();
			}
			if (isset($request->transaksi)) {
				$id_paket_array = [];
				foreach ($request->transaksi as $key => $value) {
					if (in_array($value['id_paket'], $id_paket_array)) {
						return response()->json(['status'=>'warning','message'=>'Paket tidak boleh sama dalam 1 transaksi.']);
					}
					$id_paket_array[] = $value['id_paket'];
					if ($value['id_transaksi_detail'] == '') {
						DB::table('transaksi_detail')->insert([
							'id_transaksi'=>$data->id_transaksi,
							'id_paket'=>$value['id_paket'],
							'berat'=>$value['berat']
						]);
					}else{
						DB::table('transaksi_detail')->where('id_transaksi_detail',$value['id_transaksi_detail'])
						->update([
							'id_paket'=>$value['id_paket'],
							'berat'=>$value['berat']
						]);
					}
				}
			}else{
				return response()->json(['status'=>'warning','message'=>'Detail Paket harus ditambahkan minimal 1.']);
			}
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Transaksi baru berhasil diubah !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function delete($id_transaksi)
	{
		try {
			DB::beginTransaction();
			$data = Transaksi::where('id_transaksi',$id_transaksi)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Data Transaksi berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function riwayat_transaksi(Request $request)
	{
		if ($request->ajax()) {
			$data = Transaksi::getRiwayatTransaksi($request);
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_transaksi.'" class="btn btn-primary text-white rounded-pill btn-sm view"><i class="fa fa-eye"></i></a> ';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		$paket = Paket::all();
		$pelanggan = Pelanggan::all();
		return view('page.riwayat.index',compact('paket','pelanggan'));
	}
	public function laporan(Request $request)
	{
		if ($request->ajax()) {
			$data = Transaksi::getRiwayatTransaksi($request);
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->rawColumns(['action'])
			->make(true);
		}
		return view('page.laporan.index');
	}
	public function export_laporan(Request $request)
	{
		$data = Transaksi::getExportLaporanTransaksi($request);
		$pdf = PDF::loadview('page.laporan.export',compact('data'))->setPaper('A4','landscape');
		
		$pdf->getDomPDF()->getOptions()->set('isHtml5ParserEnabled', true);
		$pdf->getDomPDF()->getOptions()->set('isPhpEnabled', true);
		if (ob_get_length() > 0) {
			ob_end_clean();
		}
		return $pdf->stream();
	}
	public function invoice($id_transaksi)
	{
		$result = Transaksi::leftJoin('pelanggan','pelanggan.id_pelanggan','=','transaksi.id_pelanggan')
		->leftJoin('users','users.id','=','transaksi.id_user')
		->where('transaksi.id_transaksi',$id_transaksi);
		$data = clone $result;
		$data = $data->get();
		$detail = clone $result;
		$detail = $detail->join('transaksi_detail','transaksi_detail.id_transaksi','=','transaksi.id_transaksi')
		->leftJoin('paket','paket.id_paket','=','transaksi_detail.id_paket')
		->get();
		$pdf = PDF::loadview('page.transaksi.invoice',compact('data','detail'))->setPaper('A4','potrait');
		$pdf->getDomPDF()->getOptions()->set('isHtml5ParserEnabled', true);
		$pdf->getDomPDF()->getOptions()->set('isPhpEnabled', true);
		if (ob_get_length() > 0) {
			ob_end_clean();
		}
		return $pdf->stream();
	}
}
