  @extends('page/layout/app')

  @section('title','Dashboard')

  @section('content')
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <div class="row">
      @if(Auth::user()->level == 'Admin')
      <div class="col-lg-3 mt-2">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <i class="bx bx-hard-hat" style="font-size: 0.5in;"></i>
              </div>
              <div class="dropdown">
                <button
                class="btn p-0"
                type="button"
                id="cardOpt3"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                >
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                <a class="dropdown-item" href=" {{route('index.paket')}} ">Lihat Detail</a>
              </div>
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Paket</span>
          <h3 class="card-title mb-2">{{$paket}}</h3>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mt-2">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <i class="bx bx-user" style="font-size: 0.5in;"></i>
            </div>
            <div class="dropdown">
              <button
              class="btn p-0"
              type="button"
              id="cardOpt3"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
              >
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
              <a class="dropdown-item" href=" {{route('index.pelanggan')}} ">Lihat Detail</a>
            </div>
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">Pelanggan</span>
        <h3 class="card-title mb-2">{{$pelanggan}}</h3>
      </div>
    </div>
  </div>
  @else
  <div class="col-lg-3 mt-2">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <i class="bx bxs-user-account" style="font-size: 0.5in;"></i>
          </div>
          <div class="dropdown">
            <button
            class="btn p-0"
            type="button"
            id="cardOpt3"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            >
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
            <a class="dropdown-item" href=" {{route('index.user')}} ">Lihat Detail</a>
          </div>
        </div>
      </div>
      <span class="fw-semibold d-block mb-1">Admin</span>
      <h3 class="card-title mb-2">{{count($admin)}}</h3>
    </div>
  </div>
</div>
@endif
<div class="col-lg-3 mt-2">
  <div class="card">
    <div class="card-body">
      <div class="card-title d-flex align-items-start justify-content-between">
        <div class="avatar flex-shrink-0">
          <i class="bx bx-donate-blood" style="font-size: 0.5in;"></i>
        </div>
      </div>
      <span class="fw-semibold d-block mb-1">Transaksi hari ini</span>
      <h3 class="card-title mb-2">{{$hari_ini}}</h3>
    </div>
  </div>
</div>
<div class="col-lg-3 mt-2">
  <div class="card">
    <div class="card-body">
      <div class="card-title d-flex align-items-start justify-content-between">
        <div class="avatar flex-shrink-0">
          <i class="bx bx-donate-blood" style="font-size: 0.5in;"></i>
        </div>
      </div>
      <span class="fw-semibold d-block mb-1">Transaksi minggu ini</span>
      <h3 class="card-title mb-2">{{$minggu_ini}}</h3>
    </div>
  </div>
</div>
<div class="col-lg-12 mt-2">
  <div class="card">
   <canvas id="bar-chart"></canvas>
 </div>
</div>
</div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
  $(function () {
    var cData = JSON.parse(`<?php echo $chart_data; ?>`);
    var ctx = $("#bar-chart");

    var datasets = [
    {
      label: "Transaksi Laundry",
      data: cData.data.laundry,
      backgroundColor: "#696cff",
      borderColor: "#4CAF50",
      borderWidth: 1,
    },
    ];

    var data = {
      labels: cData.label,
      datasets: datasets,
    };

    var options = {
      responsive: true,
      layout: {
        padding: {
          left: 20,
          right: 20,
          top: 20,
          bottom: 20
        }
      },
      plugins: {
        title: {
          display: true,
          text: "Chart Transaksi Tahun {{date('Y')}}",
          font: {
            size: 18
          },
          padding: {
            top: 10,
            bottom: 30
          },
        },
      },
      legend: {
        display: true,
        position: "bottom",
        labels: {
          fontColor: "#333",
          fontSize: 16,
        },
      },
      scales: {
        x: {
          barPercentage: 0.4,
          categoryPercentage: 0.5,
          grid: {
            display: false
          },
        },
        y: {
          beginAtZero: true,
        },
      },
    };

    var chart1 = new Chart(ctx, {
      type: "bar",
      data: data,
      options: options,
    });
  });
</script>
@endsection