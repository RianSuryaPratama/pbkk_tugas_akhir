  @extends('page/layout/app')

  @section('title','Data Pelanggan')

  @section('content')
  <div class="loading" id="loading" style="display: none;">
    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
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
              <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-header">
          Data Pelanggan
          <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block new" >
            <i class="bx bx-plus"></i> Tambah Pelanggan
          </button>
        </div>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-striped" id="table_pelanggan" style="width: 100%;">
              <thead>
                <tr>
                  <th>No. </th>
                  <th>Nama</th>
                  <th>Telepon</th>
                  <th>Alamat</th>
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
  <div class="modal fade text-left" data-bs-backdrop="static" id="modal_form_pelanggan" tabindex="-1" role="dialog"
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
       <form method="post" id="pelangganForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label class="col-form-label">Nama <span class="text-danger">*</span></label>
              <input type="" hidden="" id="id_pelanggan" name="id_pelanggan">
              <input type="text" class="form-control" id="nama" name="nama">
              <span class="invalid-feedback" role="alert" id="namaError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label class="col-form-label">Telepon <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="telepon" name="telepon">
              <span class="invalid-feedback" role="alert" id="teleponError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label class="col-form-label">Alamat </label>
              <textarea class="form-control" rows="4" name="alamat" id="alamat"></textarea>
              <span class="invalid-feedback" role="alert" id="alamatError">
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
  $(function () {
    $('#table_pelanggan').DataTable({
      processing: true,
      pageLength: 10,
      responsive: true,
      colReorder: true,
      responsive: true,
      ajax: {
        url: "{{ route('index.pelanggan') }}",
        error: function (jqXHR, textStatus, errorThrown) {
          $('#table_pelanggan').DataTable().ajax.reload();
        }
      },
      columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex'},
      { 
        data: 'nama', 
        name: 'nama', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'telepon', 
        name: 'telepon', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'alamat', 
        name: 'alamat', 
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
        $("#pelangganForm")[0].reset();
        $(".invalid-feedback").children("strong").text("");
        $("#pelangganForm input").removeClass("is-invalid");
        $("#pelangganForm textarea").removeClass("is-invalid");
        $(".modal-title").html('<i class="bx bx-plus"></i> Form Tambah Pelanggan');
        $("#modal_form_pelanggan").modal('show');
        ajaxUrl = "{{route('save.pelanggan')}}";
      }, 300);
    });
  });
  $(function () {
    $('#pelangganForm').submit(function (e) {
      e.preventDefault();
      if ($(this).data('submitted') === true) {
        return;
      }
      $(this).data('submitted', true);
      let formData = $(this).serializeArray();
      $(".invalid-feedback").children("strong").text("");
      $("#pelangganForm input").removeClass("is-invalid");
      $("#pelangganForm textarea").removeClass("is-invalid");
      $("#loading").show();
      $.ajax({
        method: "POST",
        headers: {
          Accept: "application/json"
        },
        url : ajaxUrl,
        data: formData,
        success: function (response) {
          $('#pelangganForm').data('submitted', false);
          $("#loading").hide();
          if (response.status == 'true') {
            $("#pelangganForm")[0].reset();
            $('#modal_form_pelanggan').modal('hide');
            showToast('bg-primary','Pelanggan Success',response.message);
            $('#table_pelanggan').DataTable().ajax.reload();
          } else {
            showToast('bg-danger','Pelanggan Error',response.message);
          }
        },
        error: function (response) {
          $('#pelangganForm').data('submitted', false);
          $("#loading").hide();
          if (response.status === 422) {
            let errors = response.responseJSON.errors;
            Object.keys(errors).forEach(function (key) {
              $("#" + key).addClass("is-invalid");
              $("#" + key + "Error").children("strong").text(errors[key][0]);
            });
          } else {
            showToast('bg-danger','Pelanggan Error',response.message);
          }
        }
      });
    });
  });
  function get_edit(pelangganID) {
    $.ajax({
      type: "GET",
      url: "{{url('page/data_master/pelanggan/get_edit')}}"+"/"+pelangganID,
      success: function(response) {
        $("#loading").hide();
        $.each(response, function(key, value) {
          $("#id_pelanggan").val(value.id_pelanggan);
          $("#nama").val(value.nama);
          $("#telepon").val(value.telepon);
          $("#alamat").val(value.alamat);
        });
      },
      error: function(response) {
        get_edit(pelangganID);
      }
    });
  }
  $(document).on('click','.edit',function() {
    $("#loading").show();
    var pelangganID = $(this).attr('more_id');
    $("#pelangganForm")[0].reset();
    $(".invalid-feedback").children("strong").text("");
    $("#pelangganForm input").removeClass("is-invalid");
    $("#pelangganForm textarea").removeClass("is-invalid");
    $(".modal-title").html('<i class="bx bx-edit"></i> Form Ubah Pelanggan');
    $("#modal_form_pelanggan").modal('show');
    ajaxUrl = "{{route('update.pelanggan')}}";
    if (pelangganID) {
      get_edit(pelangganID);
    }
  });
  $(document).on('click', '.delete', function (event) {
    pelangganID = $(this).attr('more_id');
    event.preventDefault();
    Swal.fire({
      title: 'Lanjut Hapus Data?',
      text: 'Data Pelanggan akan dihapus secara Permanent!',
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
          url: "{{url('page/data_master/pelanggan/destroy')}}"+"/"+pelangganID,
          success:function(response)
          {
            $("#loading").hide();
            if (response.status == 'true') {
              setTimeout(function(){
                showToast('bg-success','Pelanggan Dihapus',response.message);
                $('#table_pelanggan').DataTable().ajax.reload();         
              }, 50);
            }else{
              showToast('bg-danger','Pelanggan Error',response.message);
            }
          },
          error: function(response) {
            $("#loading").hide();
            showToast('bg-danger','Pelanggan Error',response.message);
          }
        })
      }
    });
  });
</script>
@endsection