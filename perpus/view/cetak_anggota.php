<?php include '../layout/header.php'; ?>
<?php 
  include('../system/fungsi.php');

  $make = new Core();
  $make->check_session('admin');

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
                    <h2>Cetak Anggota</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                    <div class="col-md-5">
                    <h2>Cetak anggota berdasarkan status</h2>
                    <form action="" method="POST" role="form">
                    
                      <div class="form-group">
                        <label for="">Pilih Status</label>
                        <select id="status" name="status" class="form-control">

                          <option value="*">Semua Status</option>
                          <option value="1">Aktif</option>
                          <option value="0">Tdk Aktif</option>
                          
                        </select>
                      </div>
                    
                      
                    
                      <button id="cetakAnggota" type="button" class="btn btn-primary">Submit</button>
                    </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include '../layout/footer.php' ?>
<script type="text/javascript">
  $('#cetakAnggota').click(function(event) {
    var status = $('#status').val();
    var left = (screen.width/2) - (800/2);
    var right = (screen.height/2) - (640/2);

    var url = 'tampilCetakAnggota.php?status='+status;

    window.open(url, '', 'width=800, height=640, scrollbars=yes, left='+left+', top='+top+'');
  });
</script>