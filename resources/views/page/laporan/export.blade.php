<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Export Laporan Transaksi</title>
</head>
<style type="text/css">
  @page {
    margin: 100px 25px;
  }

  header {
    position: fixed;
    top: -100px;
    left: 0px;
    right: 0px;
    height: 50px;
    font-size: 20px !important;
    text-align: center;
    line-height: 35px;
  }

</style>
<body>
  <?php
  function tanggal_indonesia($tgl, $tampil_hari=true){
    $nama_hari=array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
    $nama_bulan = array (
      1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
      "September", "Oktober", "November", "Desember");
    $tahun=substr($tgl,0,4);
    $bulan=$nama_bulan[(int)substr($tgl,5,2)];
    $tanggal=substr($tgl,8,2);
    $text="";
    if ($tampil_hari) {
      $urutan_hari=date('w', mktime(0,0,0, substr($tgl,5,2), $tanggal, $tahun));
      $hari=$nama_hari[$urutan_hari];
      $text .= $hari.", ";
    }
    $text .=$tanggal ." ". $bulan ." ". $tahun;
    return $text;
  }
  ?>
  <header>
    Laundry_Cemara <br>Laporan Transaksi<br>
    @if($_GET['awal'] != '')
    <small>Periode : {{tanggal_indonesia($_GET['awal'])}} - {{tanggal_indonesia($_GET['akhir'])}}</small>
    @endif
  </center>
</header>
<main>
  <?php $nul = 0; ?>
  <div class="card-body">
    <br>
    <table style="width: 100%;padding: 0;margin: 0;text-align: center;" cellpadding="5" cellspacing="0" border="1">
      <thead>
        <tr style="background: #eee;">
          <th data-priority="1">No. </th>
          <th data-priority="2">Nama Pelanggan</th>
          <th data-priority="4">Alamat Pelanggan</th>
          <th data-priority="5">Tanggal</th>
          <th data-priority="6">Status</th>
          <th data-priority="7">Pembayaran</th>
          <th data-priority="7">Catatan</th>
          <th data-priority="8">Paket Laundry</th>
          <th data-priority="9">Harga/kg</th>
          <th data-priority="9">Berat</th>
          <th data-priority="9">Total</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php $prev_kode = " "; ?>
        <?php $no=1; ?>
        @foreach($data as $dt)
        <?php  
        $subtotal = $nul+=$dt->subtotal;
        ?>
        <tr>
         @if ($prev_kode != $dt->id_transaksi)
         <td>{{$no}}. </td>
         <td align="center">{{$dt->nama_pelanggan}}</td>
         <td align="center">{{$dt->alamat_pelanggan}}</td>
         <td align="center">{{$dt->tanggal}}</td>
         <td align="center">{{$dt->status}}</td>
         <td align="center">{{$dt->pembayaran}}</td>
         <td align="center">{{$dt->catatan}}</td>
         <?php $no++ ?>
         @else
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         @endif
         <td>{{$dt->nama_paket}}</td>
         <td>Rp. {{number_format($dt->harga_paket,0,",",".")}}</td>
         <td>{{$dt->berat}} kg</td>
         <td>Rp. {{number_format($dt->subtotal,0,",",".")}}</td>
       </tr>
       <?php $prev_kode = $dt->id_transaksi;  ?>
       @endforeach
     </tbody>
   </table>
   @if(!empty($subtotal))
   <h3>Subtotal : Rp. {{number_format($subtotal,0,",",".")}}</h3>
   @endif
 </div>
</main>
</body>
</html>
