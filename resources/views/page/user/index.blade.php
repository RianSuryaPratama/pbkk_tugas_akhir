  @extends('page/layout/app')

  @section('title','Admin')

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
              <li class="breadcrumb-item active" aria-current="page">Admin</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-header">
          Data User Admin
          <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block new" >
            <i class="bx bx-plus"></i> Tambah Admin
          </button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped dt-responseive nowrap" id="table_user" style="width: 100%;">
              <thead>
                <tr>
                  <th data-priority="2">No. </th>
                  <th data-priority="3">Nama</th>
                  <th data-priority="4">Email/Username</th>
                  <th data-priority="5">Telepon</th>
                  <th data-priority="7">Alamat</th>
                  <th data-priority="8">Foto</th>
                  <th data-priority="9">Status User</th>
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
  <div class="modal fade text-left" data-bs-backdrop="static" id="modal_form_user" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
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
       <form method="post" id="userForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label class="col-form-label">Nama <span class="text-danger">*</span></label>
              <input type="" hidden="" id="id_user" name="id_user">
              <input type="text" class="form-control input_view" id="name" name="name">
              <span class="invalid-feedback" role="alert" id="nameError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label class="col-form-label">Email/Username <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="email" name="email">
              <span class="invalid-feedback" role="alert" id="emailError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label class="col-form-label">Password <span class="text-danger mandatory"></span></label>
              <input type="text" class="form-control" id="password" name="password">
              <span class="invalid-feedback" role="alert" id="passwordError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label class="col-form-label">No. Telepon <span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="telepon" name="telepon">
              <span class="invalid-feedback" role="alert" id="teleponError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label class="col-form-label">Alamat <span class="text-danger">*</span></label>
              <textarea class="form-control" rows="4" name="alamat" id="alamat"></textarea>
              <span class="invalid-feedback" role="alert" id="alamatError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label class="col-form-label">Status User <span class="text-danger">*</span></label>
              <select class="form-control" style="width: 100%;" name="status_user" id="status_user">
                <option value="A">Aktif</option>
                <option value="I">Non Aktif</option>
              </select>
              <span class="invalid-feedback" role="alert" id="status_userError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-12 text-center">
            <input type="" hidden="" id="uploadLama" name="uploadLama">
            <center><img src="{{asset('thumbnail.png')}}" alt="user-avatar" class="d-block rounded img_preview mt-1 mb-1" height="100" width="100" id="uploadedAvatar" />
            </center>
            <div class="button-wrapper">
              <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Upload Foto</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input type="file" id="upload" name="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
              </label>
              <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                <i class="bx bx-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Reset</span>
              </button>
            </div>
            <span class="invalid-feedback d-block" role="alert" id="uploadError">
              <strong></strong>
            </span>
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
    <!--  -->
    <!--  -->
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
<script src="{{asset('panel/assets/js/pages-account-settings-account.js')}}"></script>
<script type="text/javascript">
  $(function () {
    $('#table_user').DataTable({
      processing: true,
      pageLength: 10,
      responsive: true,
      colReorder: true,
      responsive: true,
      ajax: {
        url: "{{ route('index.user') }}",
        error: function (jqXHR, textStatus, errorThrown) {
          $('#table_user').DataTable().ajax.reload();
        }
      },
      columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex'},
      { 
        data: 'name', 
        name: 'name', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'email', 
        name: 'email', 
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
      { 
        data: 'foto', 
        name: 'foto', 
        render: function (data, type, row) {
          if (data != null) {
            return '<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center"><li data-bs-toggle="tooltip"data-popup="tooltip-custom"data-bs-placement="top" class="avatar avatar-xl pull-up" title="Foto"><img src="{{asset('foto')}}/'+data+'" alt="Avatar" class="rounded-circle" /></li></ul>';
          }else{
            return '<span class="badge bg-info text-white">Belum ada foto</span>';
          }
        }  
      },
      { 
        data: 'status_user', 
        name: 'status_user', 
        render: function (data, type, row) {
          if (data == 'A') {
            return '<span class="badge bg-success text-white">Aktif</span>';
          }else{
            return '<span class="badge bg-danger text-white">Non Aktif</span>';
          }
        }  
      },
      { data: 'action', name: 'action', orderable: false, className: 'space' }
      ]
    });
  });
  var ajaxUrl = "";
  $("#id_jabatan").select2({
    placeholder: ".: PILIH JABATAN :.",
    dropdownParent: $("#modal_form_user")
  });
  $("#status_user").select2({
    placeholder: ".: PILIH STATUS USER :.",
    dropdownParent: $("#modal_form_user")
  });
  $(document).ready(function() {
    $(".new").click(function() {
      $("#loading").show();
      $("#userForm")[0].reset();
      setTimeout(function() {
        $("#loading").hide();
        $(".account-image-reset").show();
        $(".account-image-reset").trigger('click');
        $(".mandatory").html('*');
        $("#status_user").val(null).trigger('change');
        $(".invalid-feedback").children("strong").text("");
        $("#userForm input").removeClass("is-invalid");
        $("#userForm select").removeClass("is-invalid");
        $("#userForm textarea").removeClass("is-invalid");
        $(".modal-title").html('<i class="bx bx-plus"></i> Form Tambah Admin');
        $("#modal_form_user").modal('show');
        ajaxUrl = "{{route('save.user')}}";
      }, 300);
    });
  });
  $(function () {
    $('#userForm').submit(function (e) {
      e.preventDefault();
      if ($(this).data('submitted') === true) {
        return;
      }
      $(this).data('submitted', true);
      let formData = new FormData(this);
      $(".invalid-feedback").children("strong").text("");
      $("#userForm input").removeClass("is-invalid");
      $("#userForm select").removeClass("is-invalid");
      $("#userForm textarea").removeClass("is-invalid");
      $("#loading").show();
      $.ajax({
        method: "POST",
        headers: {
          Accept: "application/json"
        },
        contentType: false,
        processData: false,
        url : ajaxUrl,
        data: formData,
        success: function (response) {
          $('#userForm').data('submitted', false);
          $("#loading").hide();
          if (response.status == 'true') {
            $("#userForm")[0].reset();
            $('#modal_form_user').modal('hide');
            showToast('bg-primary','Data User Success',response.message);
            $('#table_user').DataTable().ajax.reload();
          } else {
            showToast('bg-danger','Data User Error',response.message);
          }
        },
        error: function (response) {
          $('#userForm').data('submitted', false);
          $("#loading").hide();
          if (response.status === 422) {
            let errors = response.responseJSON.errors;
            Object.keys(errors).forEach(function (key) {
              var key_temp = key.replaceAll(".", "_");
              $("#" + key_temp).addClass("is-invalid");
              $("#" + key_temp + "Error").children("strong").text(errors[key][0]);
            });
          } else {
            showToast('bg-danger','User Error',response.message);
          }
        }
      });
    });
  });
  function get_edit(userID) {
    $.ajax({
      type: "GET",
      url: "{{url('page/data_master/user/get_edit')}}"+"/"+userID,
      success: function(response) {
        $("#loading").hide();
        $.each(response, function(key, value) {
          $("#id_user").val(value.id);
          $("#name").val(value.name);
          $("#email").val(value.email);
          $("#telepon").val(value.telepon);
          $("#alamat").val(value.alamat);
          $("#uploadLama").val(value.foto);
          $("#status_user").val(value.status_user).trigger('change');
          if (value.foto == null) {
            $('.img_preview').attr("src","{{asset('thumbnail.png')}}");
          }else{
            $('.img_preview').attr("src","{{asset('foto')}}/"+value.foto);
          }
        });
      },
      error: function(response) {
        get_edit(userID);
      }
    });
  }
  $(document).on('click','.edit',function() {
    $("#loading").show();
    var userID = $(this).attr('more_id');
    $("#userForm")[0].reset();
    $(".account-image-reset").hide();
    $(".account-image-reset").trigger('click');
    $(".invalid-feedback").children("strong").text("");
    $(".mandatory").html('');
    $("#userForm input").removeClass("is-invalid");
    $("#userForm textarea").removeClass("is-invalid");
    $("#userForm select").removeClass("is-invalid");
    $("#status_user").val(null).trigger('change');
    $(".modal-title").html('<i class="bx bx-edit"></i> Form Ubah Admin');
    $("#modal_form_user").modal('show');
    ajaxUrl = "{{route('update.user')}}";
    if (userID) {
      get_edit(userID);
    }
  });
  $(document).on('click', '.delete', function (event) {
    userID = $(this).attr('more_id');
    event.preventDefault();
    Swal.fire({
      title: 'Lanjut Hapus Data?',
      text: 'Data Admin akan dihapus secara Permanent!',
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
          url: "{{url('page/data_master/user/destroy')}}"+"/"+userID,
          success:function(response)
          {
            $("#loading").hide();
            if (response.status == 'true') {
              setTimeout(function(){
                showToast('bg-success','Data Admin Dihapus',response.message);
                $('#table_user').DataTable().ajax.reload();         
              }, 50);
            }else{
              showToast('bg-danger','Data Admin Error',response.message);
            }
          },
          error: function(response) {
            $("#loading").hide();
            showToast('bg-danger','Data Karyawan Error',response.message);
          }
        })
      }
    });
  });
</script>
@endsection