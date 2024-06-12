<?php 
	// session_start();
	include('../system/fungsi.php');

	$username = $_POST['username'];
	$password = $_POST['password'];

	$app = new Core();
    if ($app->proses_login($username, md5($password)) === TRUE) {
        if (isset($_SESSION['admin'])) {
            header('Location: ../view/index.php');
        } elseif (isset($_SESSION['manajer'])) {
            header('Location: ../view/index.php');
        }
    } else {
        echo "<script>alert('Username atau password salah!')</script>";
        echo "<script>history.back();</script>";
    }
?>