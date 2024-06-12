<?php 
include('../system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();
 

$type = $_POST['type'];
$id_ang = $_POST['id_ang'];
$nama = $_POST['nama'];
$ttl = $_POST['ttl'];
$tgl_daftar = $_POST['tgl_daftar'];
$tgl_berakhir = $_POST['tgl_berakhir'];
$status_aktif = $_POST['status_aktif'];

// jadikan array
$dataInput = array(
	'uid'=>time(),
	'nama'=>ucwords($nama),
	'ttl'=>ucwords($ttl),
	'tgl_daftar'=>$tgl_daftar,
	'tgl_berakhir'=>$tgl_berakhir,	
	'status_aktif'=>$status_aktif
	);

switch ($type) {
	case 'new':
		$pesan = $db->insert('anggota', $dataInput);

		if ($pesan) {
			echo json_encode(array('pesan'=>"Tambah berhasil", 'type'=>'success'));
		} else {
			echo json_encode(array('pesan'=>'Gagal '. $db->getLastError(), 'type'=>'error'));
		}
		break;

	case 'edit':
		$db->where('id_anggota', $id_ang);
		$pesan = $db->update('anggota', $dataInput);
		if ($pesan) {
			echo json_encode(array('pesan'=>"Edit berhasil", 'type'=>'success'));
		} else {
			echo json_encode(array('pesan'=>'Gagal '. $db->getLastError(), 'type'=>'error'));
		}
		break;
	
	default:
		echo json_encode('Gagal, error tidak diketahui ');
		break;
}
?>