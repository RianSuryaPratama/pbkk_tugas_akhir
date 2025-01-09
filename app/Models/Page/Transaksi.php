<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // use HasFactory;
    protected $table="transaksi";
	protected $primaryKey="id_transaksi";

	public static function getTransaksi($request)
	{
		$data = Transaksi::join('transaksi_detail','transaksi_detail.id_transaksi','=','transaksi.id_transaksi')
		->leftJoin('pelanggan','pelanggan.id_pelanggan','=','transaksi.id_pelanggan')
		->leftJoin('paket','paket.id_paket','=','transaksi_detail.id_paket')
		->leftJoin('users','users.id','=','transaksi.id_user')
		->select(
			\DB::RAW('SUM(paket.harga_paket*transaksi_detail.berat) as subtotal'),
			\DB::RAW('COUNT(transaksi_detail.id_paket) as jumlah_paket'),
			\DB::RAW('pelanggan.nama as nama_pelanggan'),
			\DB::RAW('pelanggan.telepon as telepon_pelanggan'),
			\DB::RAW('transaksi.id_transaksi as id_transaksi'),
			\DB::RAW('transaksi.tanggal as tanggal'),
			\DB::RAW('transaksi.estimasi as estimasi'),
			\DB::RAW('transaksi.status as status'),
			\DB::RAW('transaksi.pembayaran as pembayaran'),
			\DB::RAW('transaksi.catatan as catatan')
		)
		->groupBy('pelanggan.nama','pelanggan.telepon','transaksi.tanggal','transaksi.estimasi','transaksi.status','transaksi.pembayaran','transaksi.catatan','transaksi.id_transaksi')
		->where('transaksi.status','!=','Diambil')
		->orWhere('transaksi.pembayaran','Belum Lunas')
		->get();
		return $data;
	}
	public static function getEdit($id_transaksi)
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
		return ['data'=>$data,'detail'=>$detail];
	}
	public static function getRiwayatTransaksi($request)
	{
		$data = Transaksi::join('transaksi_detail','transaksi_detail.id_transaksi','=','transaksi.id_transaksi')
		->leftJoin('pelanggan','pelanggan.id_pelanggan','=','transaksi.id_pelanggan')
		->leftJoin('paket','paket.id_paket','=','transaksi_detail.id_paket')
		->leftJoin('users','users.id','=','transaksi.id_user')
		->select(
			\DB::RAW('SUM(paket.harga_paket*transaksi_detail.berat) as subtotal'),
			\DB::RAW('COUNT(transaksi_detail.id_paket) as jumlah_paket'),
			\DB::RAW('pelanggan.nama as nama_pelanggan'),
			\DB::RAW('pelanggan.telepon as telepon_pelanggan'),
			\DB::RAW('transaksi.id_transaksi as id_transaksi'),
			\DB::RAW('transaksi.tanggal as tanggal'),
			\DB::RAW('transaksi.estimasi as estimasi'),
			\DB::RAW('transaksi.status as status'),
			\DB::RAW('transaksi.pembayaran as pembayaran'),
			\DB::RAW('transaksi.catatan as catatan')
		)
		->groupBy('pelanggan.nama','pelanggan.telepon','transaksi.tanggal','transaksi.estimasi','transaksi.status','transaksi.pembayaran','transaksi.catatan','transaksi.id_transaksi')
		->where('transaksi.status','Diambil')
		->where('transaksi.pembayaran','Lunas');
		if (!empty($request->awal)) {
			$data->whereBetween('transaksi.tanggal',[$request->awal,$request->akhir]);
		}
		$data = $data->get();
		return $data;
	}
	public static function getExportLaporanTransaksi($request)
	{
		$data = Transaksi::join('transaksi_detail','transaksi_detail.id_transaksi','=','transaksi.id_transaksi')
		->leftJoin('pelanggan','pelanggan.id_pelanggan','=','transaksi.id_pelanggan')
		->leftJoin('paket','paket.id_paket','=','transaksi_detail.id_paket')
		->leftJoin('users','users.id','=','transaksi.id_user')
		->select(
			\DB::RAW('SUM(paket.harga_paket*transaksi_detail.berat) as subtotal'),
			\DB::RAW('paket.nama_paket as nama_paket'),
			\DB::RAW('paket.harga_paket as harga_paket'),
			\DB::RAW('transaksi_detail.berat as berat'),
			\DB::RAW('pelanggan.nama as nama_pelanggan'),
			\DB::RAW('pelanggan.alamat as alamat_pelanggan'),
			\DB::RAW('transaksi.id_transaksi as id_transaksi'),
			\DB::RAW('transaksi.tanggal as tanggal'),
			\DB::RAW('transaksi.estimasi as estimasi'),
			\DB::RAW('transaksi.status as status'),
			\DB::RAW('transaksi.pembayaran as pembayaran'),
			\DB::RAW('transaksi.catatan as catatan')
		)
		->groupBy('pelanggan.nama','pelanggan.alamat','transaksi.tanggal','transaksi.estimasi','transaksi.status','transaksi.pembayaran','transaksi.catatan','transaksi.id_transaksi','paket.nama_paket','paket.harga_paket','transaksi_detail.berat')
		->where('transaksi.status','Diambil')
		->where('transaksi.pembayaran','Lunas');
		if (!empty($request->awal)) {
			$data->whereBetween('transaksi.tanggal',[$request->awal,$request->akhir]);
		}
		$data = $data->orderBy('transaksi.tanggal','ASC')->get();
		return $data;
	}
}
