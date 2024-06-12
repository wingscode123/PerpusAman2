<?php include '../layout/header.php'; ?>
<?php 
  include('../system/fungsi.php');
  include('../system/php-mysqli/MysqliDb.php');

  $db = new MysqliDb();

  $make = new Core();
  $make->check_session('admin');

?>
<?php include '../layout/menu.php' ?>
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title">
                    <h2>Tambah Kategori</h2> 
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                    <div class="col-md-5">
                    <form action="../controller/proses_kategori.php" method="post" accept-charset="utf-8">
                    <input type="hidden" name="type" value="new">
                    <div class="form-group">
                      <label class="control-label">Nama Kategori</label>
                      <input class="form-control" type="text" name="nama_kategori" placeholder="Nama kategori">
                    </div>
                    <input type="submit" name="" value="Simpan" class="btn btn-primary btn-xs">
                    <a class="btn btn-info btn-xs" href="kategori.php" title="">Cancel</a>
                    </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include '../layout/footer.php' ?>