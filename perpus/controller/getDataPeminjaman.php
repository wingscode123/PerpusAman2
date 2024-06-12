<?php 
include('../system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

$type = $_GET['type'];

switch ($type) {
	case 'anggota':
		$uid_ang = $_GET['uid_ang'];
		$db->where('uid', $uid_ang);
		$data = $db->getOne('anggota');
		if ($data) {
			echo json_encode($data);
		} else {
			echo json_encode(array('nama'=>'Data tidak valid'));
		}
		break;

	case 'buku':
		$uid_buku = $_GET['uid_buku'];
		$db->where('uid_buku', $uid_buku);
		$data = $db->getOne('buku');
		if ($data) {
			echo json_encode($data);
		} else {
			echo json_encode(array('nama'=>'Data tidak valid', 'stok'=>''));
		}
		break;
	
	default:
	
		break;
}