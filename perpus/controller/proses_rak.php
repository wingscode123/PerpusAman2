<?php 
include('../system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

$type = $_POST['type'];
$nama = $_POST['nama_rak'];

$dataInput = array(
	'nama_rak'=>strtoupper($nama)
	);

switch ($type) {
	case 'new':
		$pesan = $db->insert('rak', $dataInput);

		if ($pesan) {
			echo "<script>alert('Tambah berhasil')</script>";
			echo "<script>window.location.href='../view/rak.php'</script>";
		} else {
			echo "<script>alert('Tambah gagal')</script>";
			echo "<script>history.back()</script>";
		}
		break;

	case 'edit':
		$id = $_POST['id_rak'];
		$db->where('id_rak', $id);
		$pesan = $db->update('rak', $dataInput);
		if ($pesan) {
			echo "<script>alert('Edit berhasil')</script>";
			echo "<script>window.location.href='../view/rak.php'</script>";
		} else {
			echo "<script>alert('Edit gagal')</script>";
			echo "<script>history.back()</script>";
		}
		break;
	
	default:
		echo json_encode('Gagal, error tidak diketahui ');
		break;
}
?>