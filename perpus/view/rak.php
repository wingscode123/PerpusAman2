<?php include '../layout/header.php'; ?>
<?php 
  include('../system/fungsi.php');
  include('../system/php-mysqli/MysqliDb.php');

  $make = new Core();
  $is_admin = isset($_SESSION['admin']);
  if ($is_admin) {
      $make->check_session('admin');
  }

  $db = new MysqliDb();
?>
<?php include '../layout/menu.php' ?>
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title">
                    <h2>Rak Buku</h2> --- 
                    <?php if ($is_admin): ?>
                    <a class="btn btn-primary btn-xs" href="tambah_rak.php" title="">Tambah</a>
                    <?php endif; ?>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <table class="table table-striped table bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama RAK</th>
                        <?php if ($is_admin): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      $raks = $db->get('rak');
                      foreach ($raks as $rak) { ?>

                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $rak['nama_rak'] ?></td>
                        <?php if ($is_admin): ?>
                        <td>
                          <a class="btn btn-primary btn-xs" href="edit_rak.php?id=<?= $rak['id_rak'] ?>" title="Edit">Edit</a> | 
                          <a onclick="return confirm('Apakah ingin menghapus?')" class="btn btn-danger btn-xs" href="../controller/hapus_master.php?id=<?= $rak['id_rak'] ?>&type=rak" title="Hapus">Hapus</a>
                        </td>
                        <?php endif; ?>
                      </tr>

                      <?php $no++;  }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include '../layout/footer.php' ?>