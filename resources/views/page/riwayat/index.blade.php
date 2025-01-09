  @extends('page/layout/app')

  @section('title','Data Riwayat Transaksi')

  @section('content')
  <div class="loading" id="loading" style="display: none;">
    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    <h4>Loading</h4>
  </div>
  <div class="page-heading" id="pageTransaksi">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Transaksi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Riwayat Transaksi</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-header">
          Data Riwayat Transaksi
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped nowrap dt-responsive" id="table_transaksi" style="width: 100%;">
              <thead>
                <tr>
                  <th data-priority="3">No. </th>
                  <th data-priority="2">Nama Pelanggan</th>
                  <th data-priority="4">Telepon Pelanggan</th>
                  <th data-priority="5">Tanggal</th>
                  <th data-priority="6">Status</th>
                  <th data-priority="7">Pembayaran</th>
                  <th data-priority="8">Jumlah Paket</th>
                  <th data-priority="9">Subtotal</th>
                  <th data-priority="11">Catatan</th>
                  <th data-priority="1">Action</th>
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
  @include('page.riwayat.form')
  @endsection
  @section('css')
  <style type="text/css">
    .lds-roller,
    .lds-roller div,
    .lds-roller div:after {
      box-sizing: border-box;
    }
    .lds-roller {
      display: inline-block;
      position: relative;
      width: 80px;
      height: 80px;
    }
    .lds-roller div {
      animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
      transform-origin: 40px 40px;
    }
    .lds-roller div:after {
      content: " ";
      display: block;
      position: absolute;
      width: 7.2px;
      height: 7.2px;
      border-radius: 50%;
      background: currentColor;
      margin: -3.6px 0 0 -3.6px;
    }
    .lds-roller div:nth-child(1) {
      animation-delay: -0.036s;
    }
    .lds-roller div:nth-child(1):after {
      top: 62.62742px;
      left: 62.62742px;
    }
    .lds-roller div:nth-child(2) {
      animation-delay: -0.072s;
    }
    .lds-roller div:nth-child(2):after {
      top: 67.71281px;
      left: 56px;
    }
    .lds-roller div:nth-child(3) {
      animation-delay: -0.108s;
    }
    .lds-roller div:nth-child(3):after {
      top: 70.90963px;
      left: 48.28221px;
    }
    .lds-roller div:nth-child(4) {
      animation-delay: -0.144s;
    }
    .lds-roller div:nth-child(4):after {
      top: 72px;
      left: 40px;
    }
    .lds-roller div:nth-child(5) {
      animation-delay: -0.18s;
    }
    .lds-roller div:nth-child(5):after {
      top: 70.90963px;
      left: 31.71779px;
    }
    .lds-roller div:nth-child(6) {
      animation-delay: -0.216s;
    }
    .lds-roller div:nth-child(6):after {
      top: 67.71281px;
      left: 24px;
    }
    .lds-roller div:nth-child(7) {
      animation-delay: -0.252s;
    }
    .lds-roller div:nth-child(7):after {
      top: 62.62742px;
      left: 17.37258px;
    }
    .lds-roller div:nth-child(8) {
      animation-delay: -0.288s;
    }
    .lds-roller div:nth-child(8):after {
      top: 56px;
      left: 12.28719px;
    }
    @keyframes lds-roller {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
  </style>
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
    function riwayatTransaksiTable() {
  // $(function () {
    $('#table_transaksi').DataTable({
      processing: true,
      pageLength: 10,
      responsive: true,
      colReorder: true,
      responsive: true,
      ajax: {
        url: "{{ route('index.riwayat_transaksi') }}",
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
      },
      { data: 'action', name: 'action', orderable: false, className: 'space' }
      ]
    });
  }
  $(function () {
    riwayatTransaksiTable();
  });
  $(document).ready(function() {
    $("#status").select2({
      placeholder: ".: STATUS LAUNDRY :."
    });
    $("#pembayaran").select2({
      placeholder: ".: STATUS PEMBAYARAN :."
    });
    $("#id_pelanggan").select2({
      placeholder: ".: PILIH PELANGGAN :."
    });
  });
  function formatRupiah(value) {
    let stringValue = value.toString();
    let parts = stringValue.split(".");
    let wholePart = parts[0];
    let decimalPart = parts.length > 1 ? "." + parts[1] : "";
    let formattedWholePart = wholePart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    let formattedValue = "Rp. " + formattedWholePart + decimalPart;
    return formattedValue;
  }
  let global_id_detail = 0;
  let totalSubtotal = 0;
  $(document).on('click', '#new_detail', function () {
    var content = jQuery("#sample_table_detail tr"),
    size = global_id_detail++,
    element = null,
    element = content.clone();
    element.attr('id','rec-'+size);
    element.attr('class','rec');
    // element.find('.delete-record').attr('data-id', size);

    element.find('.id_transaksi_detail_input').attr('id', 'transaksi_' + size + '_id_transaksi_detail');
    element.find('.id_transaksi_detail_input').attr('name', 'transaksi[' + size + '][id_transaksi_detail]');

    element.find('.id_paket_input').attr('id', 'transaksi_' + size + '_id_paket');
    element.find('.id_paket_input').attr('name', 'transaksi[' + size + '][id_paket]');
    element.find('.id_paket_input_error').attr('id', 'transaksi_' + size + '_id_paketError');
    element.find('.id_paket_input').select2({
      placeholder: ".: PILIH PAKET :."
    }).on('change',function(e) {
     var selectedOption = $(this).find('option:selected');
     var more_harga = selectedOption.attr('more_harga');
     var more_keterangan = selectedOption.attr('more_keterangan');
     if (selectedOption && e.target.value != '') {
      element.find('.total_input').val('');
      element.find('.berat_input').val('');
      element.find('.harga_paket_input').val(formatRupiah(more_harga,'Rp. '));
      element.find('.keterangan_paket_input').val(more_keterangan);
    }
  }).val(null).trigger('change');
    // element.find('.id_paket_input').val(null).trigger('change');

    element.find('.harga_paket_input').attr('id', 'transaksi_' + size + '_harga_paket');
    element.find('.harga_paket_input').attr('name', 'transaksi[' + size + '][harga_paket]');

    element.find('.keterangan_paket_input').attr('id', 'transaksi_' + size + '_harga_paket');
    element.find('.keterangan_paket_input').attr('name', 'transaksi[' + size + '][harga_paket]');

    element.find('.berat_input').attr('id', 'transaksi_' + size + '_berat');
    element.find('.berat_input').attr('name', 'transaksi[' + size + '][berat]');
    element.find('.berat_input_error').attr('id', 'transaksi_' + size + '_beratError');
    element.find('.berat_input').on('input',function(e) {
      var harga_paket = element.find('.harga_paket_input').val();
      var numericHarga = parseInt(harga_paket.replace(/\D/g, ''), 10);
      if (harga_paket != '') {
        var berat = e.target.value;
        var totalHarga = numericHarga*berat;
        element.find('.total_input').val(formatRupiah(totalHarga,'Rp. '));
        updateTotalSubtotal();
      }
    });

    element.find('.total_input').attr('id', 'transaksi_' + size + '_total');
    element.find('.total_input').attr('name', 'transaksi[' + size + '][total]');

    element.appendTo('#table_detail');
    $('#table_detail tr').each(function (index) {
      $(this).find('span.sn').html(index + 1);
    });
  });
  function updateTotalSubtotal() {
    totalSubtotal = 0;
    $('#table_detail tr').each(function () {
      var existingTotalHarga = $(this).find('.total_input').val();
      if (existingTotalHarga == '') {
        var numericTotalHarga = parseInt('Rp. 0'.replace(/\D/g, ''), 10);;
      }else{
        var numericTotalHarga = parseInt(existingTotalHarga.replace(/\D/g, ''), 10);
      }
      totalSubtotal += numericTotalHarga;
      $(".subtotal_view").html('Subtotal : '+formatRupiah(totalSubtotal,'Rp. '));
    });
  }
  $(".close").click(function() {
    $("#pageTransaksiForm").attr('hidden',true);
    $("#pageTransaksi").attr('hidden',false);
  })
  function get_edit(transaksiID) {
    $.ajax({
      type: "GET",
      url: "{{url('page/transaksi/transaksi/get_edit')}}"+"/"+transaksiID,
      success: function(response) {
        $("#loading").hide();
        $("#transaksiForm input").attr('readonly',true);
        $("#transaksiForm select").attr('readonly',true);
        $("#transaksiForm textarea").attr('readonly',true);
        totalSubtotal = 0;
        $.each(response.data, function(key, value) {
          $("#id_transaksi").val(value.id_transaksi);
          $("#id_pelanggan").val(value.id_pelanggan).trigger('change');
          $("#tanggal").val(value.tanggal);
          $("#estimasi").val(value.estimasi);
          $("#status").val(value.status).trigger('change');
          $("#pembayaran").val(value.pembayaran).trigger('change');
          $("#catatan").val(value.catatan);
        });
        $.each(response.detail, function(key, value_detail) {
          $("#new_detail").trigger('click');
        });
        setTimeout(function () {
          $('#table_detail tr').each(function (index) {
            $(this).find('span.sn').html(index + 1);
            $(this).find('.delete-record').attr('more_id', response.detail[index].id_transaksi_detail);
            $(this).find('.id_transaksi_detail_input').val(response.detail[index].id_transaksi_detail);
            $(this).find('.id_paket_input').val(response.detail[index].id_paket).trigger('change');
            $(this).find('.berat_input').val(response.detail[index].berat);
            $(this).find('.total_input').val(formatRupiah(response.detail[index].harga_paket*response.detail[index].berat,'Rp. '));
            var existingTotalHarga = $(this).find('.total_input').val();
            var numericTotalHarga = parseInt(existingTotalHarga.replace(/\D/g, ''), 10);
            totalSubtotal += numericTotalHarga;
          }); 
          $(".subtotal_view").html('Subtotal : '+formatRupiah(totalSubtotal,'Rp. '));
        }, 500);
      },
      error: function(response) {
        get_edit(transaksiID);
      }
    });
  }
  $(document).on('click','.view',function() {
    var transaksiID = $(this).attr('more_id');
    $("#loading").show();
    $("#pageTransaksi").attr('hidden',true);
    $("#transaksiForm")[0].reset();
    $(".invalid-feedback").children("strong").text("");
    $("#transaksiForm input").removeClass("is-invalid");
    $("#transaksiForm select").removeClass("is-invalid");
    $("#transaksiForm textarea").removeClass("is-invalid");
    $(".modal-title").html('<i class="fa fa-eye"></i> Detail Riwayat Transaksi');
    jQuery('.rec').remove();
    $("#pageTransaksiForm").attr('hidden',false);
    ajaxUrl = "{{route('update.transaksi')}}";
    $(".subtotal_view").html('');
    $("#id_pelanggan").val(null).trigger('change');
    $("#status").val(null).trigger('change');
    $("#pembayaran").val(null).trigger('change');
    $(".delete-record").hide();
    global_id_detail = 0;
    if (transaksiID) {
      get_edit(transaksiID);
    }
  });
</script>
@endsection