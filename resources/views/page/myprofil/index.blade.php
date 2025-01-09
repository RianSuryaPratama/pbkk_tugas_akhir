  @extends('page/layout/app')

  @section('title','My Profil')

  @section('content')
  @foreach($data as $dt)
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
              <li class="breadcrumb-item"><a href="">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">Profil</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <section class="section">
     <div class="card mb-4">
      <h5 class="card-header">Profil Saya</h5>
      <form id="profilForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="d-flex align-items-start align-items-sm-center gap-4">
            @if($dt->foto != NULL)
            <img src="{{asset('foto')}}/{{$dt->foto}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
            @else
            <img src="{{asset('thumbnail.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
            @endif
            <input type="" hidden="" value="{{$dt->foto}}" name="fotoLama">
            <div class="button-wrapper">
              <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Upload foto</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input
                type="file"
                id="upload"
                class="account-file-input"
                name="foto"
                hidden
                accept="image/png, image/jpeg" />
              </label>
              <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                <i class="bx bx-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Reset</span>
              </button>
            </div>
          </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">Nama <span class="text-danger">*</span></label>
              <input class="form-control" type="text" id="name" name="name" value="{{$dt->name}}" autofocus />
              <span class="invalid-feedback" role="alert" id="nameError">
                <strong></strong>
              </span>
            </div>
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">Email/Username <span class="text-danger">*</span></label>
              <input class="form-control" type="text" id="email" name="email" value="{{$dt->email}}" autofocus />
              <span class="invalid-feedback" role="alert" id="emailError">
                <strong></strong>
              </span>
            </div>
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">Telepon <span class="text-danger">*</span></label>
              <input class="form-control" type="number" id="telepon" name="telepon" value="{{$dt->telepon}}" autofocus />
              <span class="invalid-feedback" role="alert" id="teleponError">
                <strong></strong>
              </span>
            </div>
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">Password</label>
              <input class="form-control" type="text" id="password" name="password" autofocus />
              <span class="invalid-feedback" role="alert" id="passwordError">
                <strong></strong>
              </span>
            </div>
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">Alamat <span class="text-danger">*</span></label>
              <input class="form-control" type="text" id="alamat" name="alamat" value="{{$dt->alamat}}" autofocus />
              <span class="invalid-feedback" role="alert" id="alamatError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>
@endforeach
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
  $('#profilForm').submit(function (e) {
    e.preventDefault();
    if ($(this).data('submitted') === true) {
      return;
    }
    $(this).data('submitted', true);
    let formData = new FormData(this);
    $(".invalid-feedback").children("strong").text("");
    $("#profilForm input").removeClass("is-invalid");
    $("#loading").show();
    $.ajax({
      method: "POST",
      headers: {
        Accept: "application/json"
      },
      contentType: false,
      processData: false,
      url : "{{route('update_profil')}}",
      data: formData,
      success: function (response) {
        $('#profilForm').data('submitted', false);
        $("#loading").hide();
        if (response.status == 'true') {
          $("#profilForm")[0].reset();
          showToast('bg-primary','Profil Success',response.message);
          document.location.href='';
        } else {
          showToast('bg-danger','Profil Error',response.message);
        }
      },
      error: function (response) {
        $('#profilForm').data('submitted', false);
        $("#loading").hide();
        if (response.status === 422) {
          let errors = response.responseJSON.errors;
          Object.keys(errors).forEach(function (key) {
            $("#" + key).addClass("is-invalid");
            $("#" + key + "Error").children("strong").text(errors[key][0]);
          });
        } else {
          showToast('bg-danger','Profil Error',response.message);
        }
      }
    });
  });
});
</script>
@endsection