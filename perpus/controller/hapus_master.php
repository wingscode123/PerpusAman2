<?php 

include('../system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

$id = $_GET['id'];
$type = $_GET['type'];

switch ($type) {

	case 'kategori':
		$db->where('id_kategori', $id);
		$del = $db->delete('kategori');
		if ($del) {
			echo "<script>alert('Hapus berhasil')</script>";
			echo "<script>window.location.href='../view/kategori.php'</script>";
		} else {
			echo "<script>alert('Hapus gagal')</script>";
			echo "<script>history.back()</script>";
		}
		break;
	case 'rak':
		$db->where('id_rak', $id);
		$del = $db->delete('rak');
		if ($del) {
			echo "<script>alert('Hapus berhasil')</script>";
			echo "<script>window.location.href='../view/rak.php'</script>";
		} else {
			echo "<script>alert('Hapus gagal')</script>";
			echo "<script>history.back()</script>";
		}
		break;
	case 'denda':
		$db->where('id_denda', $id);
		$del = $db->delete('denda');
		if ($del) {
			echo "<script>alert('Hapus berhasil')</script>";
			echo "<script>window.location.href='../view/denda.php'</script>";
		} else {
			echo "<script>alert('Hapus gagal')</script>";
			echo "<script>history.back()</script>";
		}
		break;
	default:
	
		break;
}

?>