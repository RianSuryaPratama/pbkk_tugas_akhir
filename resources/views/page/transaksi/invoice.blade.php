<!DOCTYPE html>
<html>
<head>
	<title>CETAK NOTA TRANSAKSI</title>
<!-- 	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('template/dist/assets/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('template/dist/assets/css/app.css')}}">
-->
<link href="{{asset('logo-true.png')}}" rel="icon">

</head>
<body>
	<?php  
	function tanggal_indo($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);

		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
	?>
	@foreach($data as $pn)
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-9">
				<img src="{{asset('logo-true.png')}}" width="80" style="float: left;">
				<center><span style="font-size: 40px;font-family: Courier;"><strong>LAUNDRY CEMARA
				</strong></span><br>
					<span>JL.BEKASI RAYA<br> Kabupaten JAWA BARAT</span>
					<br>
					<span style="font-size: 25px;"><b>Telp : 081234675463</b></span>
				</center>
			</div>
		</div>
		<div class="row mt-5" style="margin-top: 10px;">
			<table style="width: 100%;padding: 0;margin: 0;text-align: center;" cellpadding="5" cellspacing="0" border="1">
				<tbody>
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td>{{$pn->nama}}</td>
						<td>Tanggal</td>
						<td>:</td>
						<td>{{tanggal_indo($pn->tanggal)}}</td>
					</tr>
					<tr>
						<td>Telepon</td>
						<td>:</td>
						<td>{{$pn->telepon}}</td>
						<td>Estimasi Selesai</td>
						<td>:</td>
						<td>{{tanggal_indo($pn->estimasi)}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row mt-2" style="margin-top: 5px;">
			<table style="width: 100%;padding: 0;margin: 0;text-align: center;" cellpadding="5" cellspacing="0" border="1">
				<thead>
					<tr>
						<td>No.</td>
						<td>Paket Laundry</td>
						<td>Harga Paket</td>
						<td>Berat</td>
						<td>Total</td>
					</tr>
				</thead>
				<tbody>
					<?php $nol=0; ?>
					<?php $no=1; ?>
					@foreach($detail as $dt)
					<?php  
					$total=$dt->harga_paket*$dt->berat;
					$subtotal=$nol+=$total;
					?>
					<tr>
						<td>{{$no}}. </td>
						<td>{{$dt->nama_paket}}</td>
						<td>Rp. {{number_format($dt->harga_paket,0,",",".")}}</td>
						<td>{{$dt->berat}}</td>
						<td>Rp. {{number_format($dt->berat*$dt->harga_paket,0,",",".")}}</td>
					</tr>
					<?php $no++; ?>
					@endforeach
				</tbody>
			</table>
			@if(!empty($subtotal))
			<h4>Subtotal : Rp {{number_format($subtotal,0,",",".")}}</h4>
			@endif
			@if($pn->pembayaran == 'Lunas')
			<h1 class="text text-success" style="font-family: Comic Sans">LUNAS</h1>
			@else
			<h1 class="text text-danger" style="font-family: Comic Sans">BELUM LUNAS</h1>
			@endif
			<div class="row mt-2" style="font-family: Lucida Bright;">
				<table style="width: 100%;text-align: center;">
					<tr>
						<td><h4>Hormat Kami, </h4></td>
						<td><h4>Penerima, </h4></td>
					</tr>
					<tr>
						<td><h4 class="text mt-5">({{$pn->name}})</h4></td>
						<td><h4 class="text mt-5">({{$pn->nama}})</h4></td>
					</tr>
				</table>
				<h2 style="font-family: Cambria;">PENGAMBILAN CUCIAN TANPA BON TIDAK DILAYANI</h2>
			</div>
			<div class="col-lg-4">
				<b>Perhatian : </b> <br>
				1. Pengambilan Barang harus di sertai Nota.<br>
				2. Penyelesain cucian maksimal 3 hari setelah masuk.<br>
				3. Barang yang akan dilaundry mohon di kontrol terlebih dahulu, apabila ada yang cacat mohon memberi informasi ke kami.<br>
				4. Apabila terjadi luntur, susut akibat sifat kain bukan tanggung jawab kami.<br>
				5. Barang yang tidak diambil selama 1 Bulan bila hilang bukan tanggung jawab kami.<br>
				6. Bila terjadi kehilangan atau catat karena kelalaian kami, kami hanya bertanggung jawab 2 (dua) kali ongkos cuci dan hak klaim 24 jam. <br>
				7. Konsumen dianggap setuju dengan pernyataan ini.
			</div>
		</div>
	</div>
	@endforeach
</body>

</html>