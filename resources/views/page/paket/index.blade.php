  @extends('page/layout/app')

  @section('title','Data Paket Laundry')

  @section('content')
  <div class="loading" id="loading" style="display: none;">
    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
    <h4>Loading</h4>
  </div>
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Data Master</a></li>
              <li class="breadcrumb-item active" aria-current="page">Paket</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-header">
          Data Paket Laundry
          <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block new" >
            <i class="bx bx-plus"></i> Tambah Paket
          </button>
        </div>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-striped" id="table_paket" style="width: 100%;">
              <thead>
                <tr>
                  <th>No. </th>
                  <th>Nama Paket</th>
                  <th>Harga/kg</th>
                  <th>Waktu</th>
                  <th>Keterangan Paket</th>
                  <th>Action</th>
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
  <div class="modal fade text-left" data-bs-backdrop="static" id="modal_form_paket" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-white" style="padding-bottom:12px;" id="myModalLabel1"></h5>
        <button
        type="button"
        class="btn-close"
        data-bs-dismiss="modal"
        aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
       <form method="post" id="paketForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label class="col-form-label">Nama Paket <span class="text-danger">*</span></label>
              <input type="" hidden="" id="id_paket" name="id_paket">
              <input type="text" class="form-control" id="nama_paket" name="nama_paket">
              <span class="invalid-feedback" role="alert" id="nama_paketError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label class="col-form-label">Harga/kg <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="harga_paket" name="harga_paket">
              <span class="invalid-feedback" role="alert" id="harga_paketError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label class="col-form-label">Waktu <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="waktu_paket" name="waktu_paket">
              <span class="invalid-feedback" role="alert" id="waktu_paketError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label class="col-form-label">Keterangan </label>
              <textarea class="form-control" rows="4" name="keterangan_paket" id="keterangan_paket"></textarea>
              <span class="invalid-feedback" role="alert" id="keterangan_paketError">
                <strong></strong>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">
          <span>Tutup</span>
        </button>
        <button class="btn btn-primary ml-1 submit">
          <i class="bx bx-save"></i> <span>Simpan</span>
        </button>
      </div>
    </form>
  </div>
</div>
</div>
@endsection
@section('css')
<style type="text/css">
  .lds-ellipsis,
  .lds-ellipsis div {
    box-sizing: border-box;
  }
  .lds-ellipsis {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
  }
  .lds-ellipsis div {
    position: absolute;
    top: 33.33333px;
    width: 13.33333px;
    height: 13.33333px;
    border-radius: 50%;
    background: currentColor;
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
  }
  .lds-ellipsis div:nth-child(1) {
    left: 8px;
    animation: lds-ellipsis1 0.6s infinite;
  }
  .lds-ellipsis div:nth-child(2) {
    left: 8px;
    animation: lds-ellipsis2 0.6s infinite;
  }
  .lds-ellipsis div:nth-child(3) {
    left: 32px;
    animation: lds-ellipsis2 0.6s infinite;
  }
  .lds-ellipsis div:nth-child(4) {
    left: 56px;
    animation: lds-ellipsis3 0.6s infinite;
  }
  @keyframes lds-ellipsis1 {
    0% {
      transform: scale(0);
    }
    100% {
      transform: scale(1);
    }
  }
  @keyframes lds-ellipsis3 {
    0% {
      transform: scale(1);
    }
    100% {
      transform: scale(0);
    }
  }
  @keyframes lds-ellipsis2 {
    0% {
      transform: translate(0, 0);
    }
    100% {
      transform: translate(24px, 0);
    }
  }
</style>
@endsection
@section('scripts')
<script type="text/javascript">
  function formatRupiah(angka, prefix) {
    let numberString = angka.replace(/[^,\d]/g, '').toString(),
    split = numberString.split(','),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      let separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
  $(document).on('keyup','#harga_paket',function() {
    $(this).val(formatRupiah($(this).val(), 'Rp. '));
  });
  $(function () {
    $('#table_paket').DataTable({
      processing: true,
      pageLength: 10,
      responsive: true,
      colReorder: true,
      responsive: true,
      ajax: {
        url: "{{ route('index.paket') }}",
        error: function (jqXHR, textStatus, errorThrown) {
          $('#table_paket').DataTable().ajax.reload();
        }
      },
      columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex'},
      { 
        data: 'nama_paket', 
        name: 'nama_paket', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'harga_paket', 
        name: 'harga_paket', 
        render: function (data, type, row) {
          return formatRupiah(data,'Rp. ');
        }  
      },
      { 
        data: 'waktu_paket', 
        name: 'waktu_paket', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'keterangan_paket', 
        name: 'keterangan_paket', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { data: 'action', name: 'action', orderable: false, className: 'space' }
      ]
    });
  });
  var ajaxUrl = "";
  $(document).ready(function() {
    $(".new").click(function() {
      $("#loading").show();
      setTimeout(function() {
        $("#loading").hide();
        $("#paketForm")[0].reset();
        $(".invalid-feedback").children("strong").text("");
        $("#paketForm input").removeClass("is-invalid");
        $("#paketForm textarea").removeClass("is-invalid");
        $(".modal-title").html('<i class="bx bx-plus"></i> Form Tambah Paket');
        $("#modal_form_paket").modal('show');
        ajaxUrl = "{{route('save.paket')}}";
      }, 300);
    });
  });
  $(function () {
    $('#paketForm').submit(function (e) {
      e.preventDefault();
      if ($(this).data('submitted') === true) {
        return;
      }
      $(this).data('submitted', true);
      let formData = $(this).serializeArray();
      $(".invalid-feedback").children("strong").text("");
      $("#paketForm input").removeClass("is-invalid");
      $("#paketForm textarea").removeClass("is-invalid");
      $("#loading").show();
      $.ajax({
        method: "POST",
        headers: {
          Accept: "application/json"
        },
        url : ajaxUrl,
        data: formData,
        success: function (response) {
          $('#paketForm').data('submitted', false);
          $("#loading").hide();
          if (response.status == 'true') {
            $("#paketForm")[0].reset();
            $('#modal_form_paket').modal('hide');
            showToast('bg-primary','Paket Success',response.message);
            $('#table_paket').DataTable().ajax.reload();
          } else {
            showToast('bg-danger','Paket Error',response.message);
          }
        },
        error: function (response) {
          $('#paketForm').data('submitted', false);
          $("#loading").hide();
          if (response.status === 422) {
            let errors = response.responseJSON.errors;
            Object.keys(errors).forEach(function (key) {
              $("#" + key).addClass("is-invalid");
              $("#" + key + "Error").children("strong").text(errors[key][0]);
            });
          } else {
            showToast('bg-danger','Paket Error',response.message);
          }
        }
      });
    });
  });
  function get_edit(paketID) {
    $.ajax({
      type: "GET",
      url: "{{url('page/data_master/paket/get_edit')}}"+"/"+paketID,
      success: function(response) {
          $("#loading").hide();
          $.each(response, function(key, value) {
            $("#id_paket").val(value.id_paket);
            $("#nama_paket").val(value.nama_paket);
            $("#keterangan_paket").val(value.keterangan_paket);
            $("#waktu_paket").val(value.waktu_paket);
            $("#harga_paket").val(formatRupiah(value.harga_paket,'Rp. '));
          });
      },
      error: function(response) {
        get_edit(paketID);
      }
    });
  }
  $(document).on('click','.edit',function() {
    $("#loading").show();
    var paketID = $(this).attr('more_id');
    $("#paketForm")[0].reset();
    $(".invalid-feedback").children("strong").text("");
    $("#paketForm input").removeClass("is-invalid");
    $("#paketForm textarea").removeClass("is-invalid");
    $(".modal-title").html('<i class="bx bx-edit"></i> Form Ubah Paket');
    $("#modal_form_paket").modal('show');
    ajaxUrl = "{{route('update.paket')}}";
    if (paketID) {
      get_edit(paketID);
    }
  });
  $(document).on('click', '.delete', function (event) {
    paketID = $(this).attr('more_id');
    event.preventDefault();
    Swal.fire({
      title: 'Lanjut Hapus Data?',
      text: 'Data Paket akan dihapus secara Permanent!',
      icon: 'warning',
      type: 'warning',
      showCancelButton: !0,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: 'Lanjutkan'
    }).then((result) => {
      if (result.isConfirmed) {
        $("#loading").show();
        $.ajax({
          method: "GET",
          url: "{{url('page/data_master/paket/destroy')}}"+"/"+paketID,
          success:function(response)
          {
            $("#loading").hide();
            if (response.status == 'true') {
              setTimeout(function(){
                showToast('bg-success','Paket Dihapus',response.message);
                $('#table_paket').DataTable().ajax.reload();         
              }, 50);
            }else{
              showToast('bg-danger','Paket Error',response.message);
            }
          },
          error: function(response) {
            $("#loading").hide();
            showToast('bg-danger','Paket Error',response.message);
          }
        })
      }
    });
  });
</script>
@endsection