<?php 
include('../system/php-mysqli/MysqliDb.php');
include('../system/fungsi.php');
$db = new MysqliDb();
$root = new Core();


$buku_id = $_POST['buku_id'];
$anggota_id = $_POST['anggota_id'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_7 = strtotime($tgl_pinjam);
$tgl_kembali = strtotime("+7 days", $tgl_7);


$db->where('id_buku', $buku_id);
$databuku = $db->getOne('buku');
if ($databuku['stok'] < 1 ) {
	echo $root->json_response('Stok buku tidak mencukupi.', 'error', 422);
	exit();
}

$dataInput = array(
	'buku_id'=> $buku_id,
	'anggota_id'=>$anggota_id,
	'tgl_pinjam'=>$tgl_pinjam,
	'tgl_kembali'=>date('Y-m-d',$tgl_kembali)
	);

$pesan = $db->insert('transaksi', $dataInput);

if ($pesan) {
	$db->where('id_buku', $buku_id);
	$db->update('buku', array('stok'=>$databuku['stok'] - 1));
	echo json_encode(array('pesan'=>"Tambah berhasil", 'type'=>'success'));
} else {
	echo json_encode(array('pesan'=>'Gagal '. $db->getLastError(), 'type'=>'error'));
}

?>