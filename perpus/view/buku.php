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

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Buku Perpus</h2>
            <?php if ($is_admin): ?>
              <button class="btn btn-info btn-xs" type="button" id="openmodal">Tambah</button>
            <?php endif; ?>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              <li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <!-- isinya disini -->
          <?php 
            $db = new MysqliDb();
          ?>
          <table id="tabelku" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>UID</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>ISBN</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Rak</th>
                <th>Kategori</th>
                <?php if ($is_admin): ?>
                  <th>Aksi</th>
                <?php endif; ?>
              </tr>
            </thead>
          </table>
          <!-- /isi -->
        </div>
      </div>
    </div>
  </div>
</div>

<?php if ($is_admin): ?>
  <!-- modal add -->
  <div class="modal fade modal-wide" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myModalLabel2"></h4>
        </div>
        <div class="modal-body">
          <form id="formAdd" class="form-horizontal form-label-left" accept-charset="utf-8">
            <input type="hidden" name="type" id="type" value="">
            <input type="hidden" name="id_buku" id="id_buku" value="">
            <div class="form-group">
              <label class="control-label">Judul</label>
              <input class="form-control" type="text" id="judul" name="judul" placeholder="Judul" required>
            </div>
            <div class="form-group">
              <label class="control-label">Pengarang</label>
              <input class="form-control" type="text" name="pengarang" id="pengarang" placeholder="Pengarang" required>
            </div>
            <div class="form-group">
              <label class="control-label">Penerbit</label>
              <input class="form-control" id="penerbit" type="text" name="penerbit" placeholder="Penerbit" required>
            </div>
            <div class="form-group">
              <label class="control-label">ISBN</label>
              <input class="form-control" id="isbn" type="text" name="isbn" placeholder="ISBN" required="">
            </div>
            <div class="form-group">
              <label class="control-label">Tahun</label>
              <input class="form-control" id="tahun" type="text" name="tahun" placeholder="Tahun" required="">
            </div>
            <div class="form-group">
              <label class="control-label">Stok buku</label>
              <input class="form-control" id="stok" type="text" name="stok" placeholder="Stok buku" required="">
            </div>
            <div class="form-group">
              <label class="control-label"> Rak</label>
              <select class="form-control" name="rak" id="rak">
                <?php 
                  $raks = $db->get('rak');
                  foreach ($raks as $rak ) {
                    echo '<option value="'.$rak['id_rak'].'">'.$rak['nama_rak'].'</option>';
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label"> Kategori</label>
              <select class="form-control" name="kategori" id="kategori">
                <?php 
                  $kategoris = $db->get('kategori');
                  foreach ($kategoris as $kategori ) {
                    echo '<option value="'.$kategori['id_kategori'].'">'.$kategori['nama_kategori'].'</option>';
                  }
                ?>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-round btn-sm" data-dismiss="modal">Close</button>
          <button type="button" id="btnSubmit" class="btn btn-primary btn-round btn-sm"></button>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php include '../layout/footer.php' ?>

<script type="text/javascript">
  $(document).ready(function() {
    dt = $('#tabelku').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "../system/scripts/server_processing_buku.php"
    });

    <?php if ($is_admin): ?>
      // open modal for adding new book
      $('#openmodal').click(function() {
        $('#formAdd')[0].reset();
        $('#type').val('new');
        $('#myModalLabel2').html('Tambah Buku');
        $('#btnSubmit').html('Simpan');
        $('#modalAdd').modal('show');
      });

      // submit form for adding/editing book
      $('#btnSubmit').click(function() {
        var dataInput = {
          type: $('#type').val(),
          id_buku: $('#id_buku').val(),
          judul: $('#judul').val(),
          pengarang: $('#pengarang').val(),
          penerbit: $('#penerbit').val(),
          isbn: $('#isbn').val(),
          tahun: $('#tahun').val(),
          stok: $('#stok').val(),
          rak: $('#rak').val(),
          kategori: $('#kategori').val()
        };

        $.ajax({
          url: '../controller/proses_buku.php',
          type: 'POST',
          dataType: 'json',
          data: dataInput,
          success: function(res) {
            $.notify(res.pesan, res.type);
            $('#modalAdd').modal('hide');
            $('#formAdd')[0].reset();
            dt.ajax.reload();
          }
        });
      });

      // function to edit book
      window.editModal = function(id_buku) {
        if (id_buku) {
          $.ajax({
            url: '../controller/getEditBuku.php',
            type: 'GET',
            dataType: 'json',
            data: {id_buku: id_buku},
            success: function(res) {
              $('#type').val('edit');
              $('#id_buku').val(res.id_buku);
              $('#judul').val(res.judul);
              $('#pengarang').val(res.pengarang);
              $('#penerbit').val(res.penerbit);
              $('#isbn').val(res.isbn);
              $('#tahun').val(res.tahun);
              $('#stok').val(res.stok);
              $('#rak').val(res.rak);
              $('#kategori').val(res.kategori);
              $('#myModalLabel2').html('Edit Buku');
              $('#btnSubmit').html('Edit');
              $('#modalAdd').modal('show');
            },
            error: function(err) {
              console.log(err);
            }
          });
        } else {
          alert('id buku kosong');
        }
      };

      // function to delete book
      window.deleteModal = function(id_buku) {
        if (id_buku) {
          if (confirm('Yakin ingin menghapus?')) {
            $.ajax({
              url: '../controller/hapus.php',
              type: 'POST',
              dataType: 'json',
              data: {id: id_buku, type: 'buku'},
              success: function(response) {
                $.notify(response, 'success');
                dt.ajax.reload();
              }
            });
          }
        } else {
          alert('Gagal hapus');
        }
      };
    <?php endif; ?>
  });
</script>
