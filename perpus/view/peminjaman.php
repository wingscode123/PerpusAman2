<?php include '../layout/header.php'; ?>
<?php 
  include('../system/fungsi.php');

  $make = new Core();
  $is_admin = isset($_SESSION['admin']);
  if ($is_admin) {
      $make->check_session('admin');
  }
?>
<?php include '../layout/menu.php' ?>
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title">
                    <h2>Peminjaman buku</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <?php if ($is_admin): ?>
                    <div class="row">
                    <div class="col-md-7">
                    <h4>Masukan barcode Anggota dan Buku</h4>
                     <form class="form-inline">
                      <div class="form-group">
                        <input type="text" id="uid_ang" class="form-control" placeholder="ID Anggota">
                        <input type="hidden" id="anggota_id" name="anggota_id">
                      </div>
                      <div class="form-group">
                        <input type="text" id="uid_buku" class="form-control" disabled="disabled" placeholder="ID Buku">
                        <input type="hidden" id="buku_id" name="buku_id">
                      </div>
                      <button id="btnSimpanPeminjaman" type="button" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-5">
                      <p id="nama_ang"></p>
                      <p id="nama_buku"></p>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <h2>Daftar Peminjaman buku</h2>
                    <table id="tabelku" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Judul buku</th>
                          <th>Tgl pinjam</th>
                          <th>Tgl kembali</th>
                        </tr>
                      </thead>
                      
                    </table>
                    </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include '../layout/footer.php' ?>
<script type="text/javascript">
  $(document).ready(function() {
    // keyup uid anggota
    $('#uid_ang').keyup(function(event) {
      uid_ang = $('#uid_ang').val();
      $.getJSON('../controller/getDataPeminjaman.php', {uid_ang: uid_ang, type: 'anggota'}, function(json, textStatus) {
          $('#anggota_id').val(json.id_anggota);
          $('#nama_ang').html('Nama anggota : <b><u>'+json.nama+'</u></b>');
          $('#uid_buku').removeAttr('disabled');
      });
    });
    $('#uid_buku').keyup(function(event) {
      uid_buku = $('#uid_buku').val();
      $.getJSON('../controller/getDataPeminjaman.php', {uid_buku: uid_buku, type: 'buku'}, function(json, textStatus) {
          $('#buku_id').val(json.id_buku);
          $('#nama_buku').html('Nama Buku : <b><u>'+json.judul+'</u></b> | Stok : '+json.stok);
      });
    });

    dt = $('#tabelku').DataTable({
      'prosessing': true,
      "serverSide": true,
      "ajax": "../system/scripts/server_processing_daftarpeminjaman.php"
    });

    $('#btnSimpanPeminjaman').click(function(event) {
      // console.log('woooooooooooooo');
      var dataInput = {
        buku_id: $('#buku_id').val(),
        anggota_id :$('#anggota_id').val(),
        tgl_pinjam: (new Date()).toISOString().substring(0,10),
      }

      $.ajax({
        url: '../controller/postDataPeminjaman.php',
        type: 'POST',
        dataType: 'json',
        data: dataInput,
      })
      .success(function(res){
        $.notify(res.pesan, res.type);
        dt.ajax.reload();
        $('#buku_id').val('');
        $('#anggota_id').val('');
        $('#uid_ang').val('');
        $('#uid_buku').val('');
        $('#uid_buku').attr('disabled', 'disabled');
      }).error(function(er) {
        var hj = $.parseJSON(er.responseText);
        // alert(hj.message);
        $.notify(hj.message, hj.type);
        return false;
      });;
      
    });

  });
  console.log();
</script>