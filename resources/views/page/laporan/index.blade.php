  @extends('page/layout/app')

  @section('title','Laporan Transaksi')

  @section('content')
  <div class="loading" id="loading" style="display: none;">
    <img src="{{asset('gif_export.gif')}}" width="100">
  </div>
  <div class="page-heading" id="pageTransaksi">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Laporan</a></li>
              <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-xl-6 pb-4" style="background: white;box-shadow:2px 2px grey;">
          <div class="row mt-2">
            <label class="col-sm-3 form-label mt-2" style="color: black;">Tanggal Awal</label>
            <div class="col-sm-8">
              <input type="date" value="" class="form-control" id="awal">
            </div>
          </div>
          <div class="row mt-2">
            <label class="col-sm-3 form-label mt-2" style="color: black;">Tanggal Akhir</label>
            <div class="col-sm-8">
              <input type="date" value="" class="form-control" id="akhir">
            </div>
          </div>
          <button type="button" id="filter" class="btn btn-info mt-4"><i class="fa fa-filter"></i> Tampilkan</button>
          <a href="" id="export_pdf" class="btn btn-danger mt-4"><i class="fa fa-file-pdf"></i></a>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-header">
          Data Laporan Transaksi
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped nowrap dt-responsive" id="table_transaksi" style="width: 100%;">
              <thead>
                <tr>
                  <th data-priority="1">No. </th>
                  <th data-priority="2">Nama Pelanggan</th>
                  <th data-priority="4">Telepon Pelanggan</th>
                  <th data-priority="5">Tanggal</th>
                  <th data-priority="6">Status</th>
                  <th data-priority="7">Pembayaran</th>
                  <th data-priority="8">Jumlah Paket</th>
                  <th data-priority="9">Estimasi Selesai</th>
                  <th data-priority="10">Subtotal</th>
                  <th data-priority="12">Catatan</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
  @endsection
  @section('scripts')
  <script type="text/javascript">
    function tanggal_indonesia(dateString) {
      const hariDalamSeminggu = [
      'Minggu',
      'Senin',
      'Selasa',
      'Rabu',
      'Kamis',
      'Jumat',
      'Sabtu'
      ];
      const bulan = [
      'Januari',
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
      ];
      const tanggal = dateString.split('-');
      const hari = tanggal[2];
      const bulanIndex = parseInt(tanggal[1]) - 1;
      const tahun = tanggal[0];
      const dateObj = new Date(tahun, bulanIndex, hari);
      const namaHari = hariDalamSeminggu[dateObj.getDay()];
      return `${namaHari}, ${hari} ${bulan[bulanIndex]} ${tahun}`;
    }
    function formatRupiah(value) {
      let stringValue = value.toString();
      let parts = stringValue.split(".");
      let wholePart = parts[0];
      let decimalPart = parts.length > 1 ? "." + parts[1] : "";
      let formattedWholePart = wholePart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      let formattedValue = "Rp. " + formattedWholePart + decimalPart;
      return formattedValue;
    }
    function riwayatTransaksiTable(awal,akhir) {
  // $(function () {
    $('#table_transaksi').DataTable({
      processing: true,
      pageLength: 10,
      responsive: true,
      colReorder: true,
      responsive: true,
      ajax: {
        url: "{{ route('index.laporan') }}",
        data: {awal: awal, akhir: akhir},
        error: function (jqXHR, textStatus, errorThrown) {
          $('#table_transaksi').DataTable().ajax.reload();
        }
      },
      columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex'},
      { 
        data: 'nama_pelanggan', 
        name: 'nama_pelanggan', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'telepon_pelanggan', 
        name: 'telepon_pelanggan', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'tanggal', 
        name: 'tanggal', 
        render: function (data, type, row) {
          return tanggal_indonesia(data);
        }  
      },
      { 
        data: 'status', 
        name: 'status', 
        render: function (data, type, row) {
          return'<b class="text-success">'+data+'</b>';
        }  
      },
      { 
        data: 'pembayaran', 
        name: 'pembayaran', 
        render: function (data, type, row) {
          return'<span class="text-success">'+data+'</span>';
        }  
      },
      { 
        data: 'jumlah_paket', 
        name: 'jumlah_paket', 
        render: function (data, type, row) {
          return data+' Paket';
        }  
      },
      { 
        data: 'estimasi', 
        name: 'estimasi', 
        render: function (data, type, row) {
          return tanggal_indonesia(data);
        }  
      },
      { 
        data: 'subtotal', 
        name: 'subtotal', 
        render: function (data, type, row) {
          if (data != null) {
            return formatRupiah(data,'Rp. ');
          }
        }  
      },
      { 
        data: 'catatan', 
        name: 'catatan', 
        render: function (data, type, row) {
          return data;
        }  
      }
      ]
    });
  }
  $(function () {
    riwayatTransaksiTable(awal,akhir);
  });
  var awal = '';
  var akhir = '';
  var route = "{{ route('export_laporan') }}?awal="+awal+"&akhir="+akhir;
  $("#export_pdf").attr('href', route);
  $(document).on('click', '#filter', function() {
   awal = $("#awal").val() || '';
   akhir = $("#akhir").val() || '';
   setTimeout(function() {
    $('#table_transaksi').DataTable().destroy();
    riwayatTransaksiTable(awal, akhir);
    var route = "{{ route('export_laporan') }}?awal="+awal+"&akhir="+akhir;
    $("#export_pdf").attr('href', route);
  }, 300);
 });
  $("#export_pdf").click(function(event){
    event.preventDefault();
    var data = '';
    var url = $(this).attr('href');
    $("#loading").show();
    setTimeout(function() {
      $.ajax({
        type: 'GET',
        url: url,
        data: data,
        xhrFields: {
          responseType: 'blob'
        },
        success: function(response){
          $("#loading").hide();
          var blob = new Blob([response]);
          var link = document.createElement('a');
          link.href = window.URL.createObjectURL(blob);
          link.download = "Laporan Transaksi.pdf";
          link.click();
        },
        error: function(response){
          $("#loading").hide();
          alert('Terjadi kesalahan, mohon ulangi export anda.');
        }
      });
    }, 600);
  });
</script>
@endsection