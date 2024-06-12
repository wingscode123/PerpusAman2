<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Perpustakaan | UNIVERSITAS BRAWIJAYA</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
  </head>

  <body style="background:#F7F7F7;">
    <div class="">
<?php 
  session_start();
  include ('../system/fungsi.php');
  $a = new Core();
  $a->check_login('admin');
  $a = new Core();
  $a->check_login('manajer');
 ?>
      <div id="wrapper">
        <div id="" class=" ">

          <section class="login_content">
              <h1>Login Form</h1>
              <form action="../controller/proses_login.php" method="post" accept-charset="utf-8">
                <div>
                  <input type="text" name="username" class="form-control" placeholder="Username" required autofocus="true" />
                </div>
                <div>
                  <input type="password" name="password" class="form-control" placeholder="Password" required />
                </div>
                <button type="submit" class="btn btn-default">Login</button>
              </form>

              <div class="clearfix"></div>
              <div class="separator">

                <div class="clearfix"></div>
                <br />
                <div>
                  <h1> PERPUSTAKAAN UNIVERSITAS BRAWIJAYA</h1>

                  <p>©2023 All Rights Reserved. ..... </p>
                  <br><center><p>Repost by <a href='https://www.instagram.com/ikzaazabd/' title='Kel7' target='_blank'>Kelompok 7</a></p></center>
                  
                </div>
              </div>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>