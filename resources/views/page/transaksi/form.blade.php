   <div class="page-heading" hidden="" id="pageTransaksiForm">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Transaksi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Form Transaksi</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 modal-title"></h5>
        <div class="col">
          <button style="float: right;" type="button" class="btn btn-outline-info btn-xs rounded-pill text-nowrap" data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="top" data-bs-html="true" data-bs-content="Dalam form ini anda dapat menambahkan detail paket laundry dengan cara klik tombol <b>Tambah Paket</b>." title="Informasi">
            <i class="bx bx-info-circle"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <form method="post" enctype="multipart/form-data" id="transaksiForm">
          @csrf
          <div class="row">
            <div class="col-lg-6 mb-2">
              <input type="" hidden="" id="id_transaksi" name="id_transaksi">
              <label class="">Nama Pelanggan <span class="text-danger">*</span></label>
              <div class="input-group">
                <select class="form-control" style="width: 100%;" id="id_pelanggan" name="id_pelanggan">
                 @foreach($pelanggan as $plg)
                 <option value="{{$plg->id_pelanggan}}">{{$plg->nama}}</option>
                 @endforeach
               </select>
               <span class="invalid-feedback" role="alert" id="id_pelangganError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6 mb-2">
            <label class="">Tanggal <span class="text-danger">*</span></label>
            <div class="input-group">
              <input type="date" id="tanggal" name="tanggal" class="form-control"/>
              <span class="invalid-feedback" role="alert" id="tanggalError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6 mb-2">
            <label class="">Status <span class="text-danger">*</span></label>
            <div class="input-group">
              <?php  
              $status = array('Baru','Proses','Selesai','Diambil');
              ?>
              <select class="form-control" style="width: 100%;" id="status" name="status">
                @foreach($status as $sts)
                <option value="{{$sts}}">{{$sts}}</option>
                @endforeach
              </select>
              <span class="invalid-feedback" role="alert" id="statusError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6 mb-2">
            <label class="">Pembayaran <span class="text-danger">*</span></label>
            <div class="input-group">
              <?php  
              $pembayaran = array('Lunas','Belum Lunas');
              ?>
              <select class="form-control" style="width: 100%;" id="pembayaran" name="pembayaran">
                @foreach($pembayaran as $pem)
                <option value="{{$pem}}">{{$pem}}</option>
                @endforeach
              </select>
              <span class="invalid-feedback" role="alert" id="pembayaranError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6 mb-2">
            <label class="">Estimasi Selesai</label>
            <div class="input-group">
              <input type="date" class="form-control" id="estimasi" name="estimasi"/>
              <span class="invalid-feedback" role="alert" id="estimasiError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6">
            <label class="">Catatan</label>
            <div class="input-group">
              <textarea class="form-control" placeholder="Catatan ..." rows="4" id="catatan" name="catatan"></textarea>
              <span class="invalid-feedback" role="alert" id="catatanError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-12">
            <!-- fasilitas -->
            <input type="" id="id_detail_del" name="id_detail_del" hidden="">
            <button type="button" id="new_detail" class="btn btn-info text-white btn-sm mb-2">
              <i class="bx bx-plus"></i> Tambah Paket
            </button>
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped responsive-table" style="width: 100%;">
                <thead style="background: #aaa;color: #000;">
                 <tr>
                  <th>No. </th>
                  <th>Nama Paket</th>
                  <th>Harga/kg</th>
                  <th>Keterangan Paket</th>
                  <th>Berat</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="table_detail">
              </tbody>
            </table>
          </div>
          <h5 class="subtotal_view mt-3"></h5>
          <!-- end fasilitas -->
        </div>
        <!-- end kamar -->
      </div>
      <button type="submit" class="btn btn-primary mt-3"><i class="bx bx-save"></i> Simpan</button>
      <button type="button" class="btn close mt-3"> Kembali</button>
    </form>
    <div style="display:none;">
      <table id="sample_table_detail">
        <tr id="">
          <td data-label="No."><span class="sn" style="vertical-align:middle;"></span></td>   
          <td data-label="Nama Paket">
            <input type="" hidden="" name="transaksi[0][id_transaksi_detail]" id="transaksi_0_id_transaksi_detail" class="form-control form-control-sm id_transaksi_detail_input">
            <select name="transaksi[0][id_paket]" style="width: 100%;" id="transaksi_0_id_paket" class="form-control form-control-sm id_paket_input">
              @foreach($paket as $pkt)
              <option value="{{$pkt->id_paket}}" more_harga="{{$pkt->harga_paket}}" more_keterangan="{{$pkt->keterangan_paket}}">{{$pkt->nama_paket}}</option>
              @endforeach
            </select>
            <span class="invalid-feedback id_paket_input_error" role="alert" id="transaksi_0_id_paketError">
              <strong></strong>
            </span>
          </td>
          <td data-label="Harga">
            <input name="transaksi[0][harga_paket]" disabled="" id="transaksi_0_harga_paket" class="form-control harga_paket_input">
          </td>
          <td data-label="Keetrangan">
            <textarea name="transaksi[0][keterangan_paket]" disabled="" id="transaksi_0_keterangan_paket" class="form-control keterangan_paket_input" rows="4"></textarea>
          </td>
          <td data-label="Berat">
            <input type="number" min="1" name="transaksi[0][berat]" id="transaksi_0_berat" class="form-control berat_input">
            <span class="invalid-feedback berat_input_error" role="alert" id="transaksi_0_beratError">
              <strong></strong>
            </span>
          </td>
          <td data-label="Total">
            <input name="transaksi[0][total]" disabled="" id="transaksi_0_total" class="form-control total_input">
          </td>
          <td>
            <center>
              <button type="button" class="delete-record btn btn-sm btn-danger" data-id="0"><i class="bx bx-x"></i></button>
            </center>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
</div>