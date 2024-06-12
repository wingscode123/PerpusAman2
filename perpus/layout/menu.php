<!-- sidebar menu -->
<?php 
$is_admin = isset($_SESSION['admin']);
$is_manajer = isset($_SESSION['manajer']);
?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  <li><a href="./index.php"><i class="fa fa-home"></i> Home </a> 
                  </li>

                  <li><a href="./anggota.php"><i class="fa fa-group"></i> Anggota </a> 
                  </li>

                  <li><a href="./buku.php"><i class="fa fa-book"></i> Buku </a> 
                  </li>

                  <?php if ($is_admin || $is_manajer): ?>

                  <li><a><i class="fa fa-edit"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="./peminjaman.php">Peminjaman</a>
                      </li>
                      <li><a href="./pengembalian.php">Pengembalian</a>
                      </li>
                      
                    </ul>
                  </li>

                  <li><a><i class="fa fa-list"></i> Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="./kategori.php">Kategori</a>
                      </li>
                      <li><a href="./rak.php">Rak</a>
                      </li>
                      
                    </ul>
                  </li>

                  <li><a><i class="fa fa-print"></i> Cetak <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="./cetak_buku.php">Buku</a>
                      </li>
                      <li><a href="./cetak_anggota.php">Cetak anggota</a>
                      </li>
                      <?php endif; ?>
                      
                    </ul>
                  </li>
              </div>
            </div>
          </div>
        </div>
        <div class="top_nav">
  <div class="nav_menu">
    <nav class="" role="navigation">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="../controller/logout.php" class="user-profile">
            <img src="../assets/images/default.jpg" alt="">
            <?php 
              if(isset($_SESSION['admin']))
              {
                echo $_SESSION['admin']['nama'];
              }
            ?>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>

        