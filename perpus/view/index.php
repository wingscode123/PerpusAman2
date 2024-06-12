<?php include '../layout/header.php'; ?>

<?php 
  include('../system/fungsi.php');

  $make = new Core();
  $is_admin = isset($_SESSION['admin']);
  $is_manajer = isset($_SESSION['manajer']);
?>

<?php include '../layout/menu.php' ?>


        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title">
                    <h2>HOMEPAGE</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                    <div class="w-10">
                      <center><img src="../assets/images/PerpustakaanUB.jpg" alt="" title="UNIVERSITAS BRAWIJAYA" class="img-responsive border rounded"></center>
                    </div>
                </div>
              </div>
            </div>
          </div>
        <div class="databox">
          <?php $db = new MysqliDb() ?>
          <div class="box anggotabox" style="background-color: #529b8a;">
            <h1>
              <?php 
                $total = 0;
                $rows = $db -> get('anggota');
                foreach($rows as $row){
                  $total++;
                };
                echo $total;
              ?>
            </h1>
            <h2>Jumlah Anggota</h2>  
            
          </div>
          <div class="box bukubox" style="background-color: #709faf;">
          <h1>
              <?php 
                $total = 0;
                $rows = $db -> get('buku');
                foreach($rows as $row){
                  $total++;
                };
                echo $total;
              ?>
            </h1>
          <h2>Jumlah Buku</h2>  
            
          </div>
          <?php if ($is_admin || $is_manajer): ?>
          <div class="box pinjambox" style="background-color: #ce7ea5;">
          <h1>
              <?php 
                $total = 0;
                $rows = $db -> get('transaksi');
                foreach($rows as $row){
                  $total++;
                };
                echo $total;
              ?>
            </h1>
          <h2>Jumlah Peminjaman</h2>  
            
          </div>
          <?php endif; ?>
          <div class="box kategoribox" style="background-color: #6c70d1;">
          <h1>
              <?php 
                $total = 0;
                $rows = $db -> get('kategori');
                foreach($rows as $row){
                  $total++;
                };
                echo $total;
              ?>
            </h1>
          <h2>Kategori Buku</h2>  
            
        </div>
    </div>
        </div>

<style>
.databox{
  width: 100%;
  display: flex;
  justify-content: space-evenly;
  color: white;
  font-family: 'Hind Siliguri', sans-serif;
}

.databox .box{
    height: 350px;
    width: 300px;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    flex-direction: column;
}
</style>

        
<?php include '../layout/footer.php'?>