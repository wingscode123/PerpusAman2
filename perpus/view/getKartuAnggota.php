<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cetak kartu anggota</title>
	<link rel="stylesheet" href="">
	<style >
	@media print{
		.cetak{
			display: none;
			height: 0;
		}
		.namakartu{
			font-family: arial;
			font-size: 14px;
			text-align: center;
		}
		.namajl{
			font-size: 11px;
 			text-align: center;
		}
		.namaKampus{
			font-size: 18px;
			text-align: center;
			font-weight: bold;
		}
		tr.border_bawah{
	 	
		    border-bottom: solid 1px #000;
		}
		table{
			width: 400px;
			border-collapse: collapse;
		}
	}

		.namakartu{
			font-family: arial;
			font-size: 14px;
			text-align: center;
		}
		.namajl{
			font-size: 12px;
 			text-align: center;
		}
		.namaKampus{
			font-size: 18px;
			text-align: center;
			font-weight: bold;
		}
		tr.border_bawah{
	 	
		    border-bottom: solid 1px #000;
		}
		table{
			width: 400px;
			border-collapse: collapse;
		}
	</style>
</head>
<body>
<?php 
include('../system/php-mysqli/MysqliDb.php');

$db = new MysqliDb();

$id = $_GET['uid'];
$db->where('uid', $id);
$ang = $db->getOne('anggota');
?>
<button class="cetak" id="cetak" onclick="cetak()">Cetak</button>
<p></p>
	<table class="tab" >
		<tr class="border_bawah">
			<td rowspan="4"><img src="../assets/images/LogoUB.png" alt="" width="50" height="50"></td>
		</tr>
		<tr>
			<td class="namakartu">KARTU PERPUSTAKAAN</td>
		</tr>
		<tr>
			<td class="namaKampus">Universitas Brawijaya</td>
		</tr>
		<tr class="border_bawah">
			<td class="namajl">Jl. Veteran, Ds. Ketawanggede, Kec. Lowokwaru, Kota Malang, Prov. Jawa Timur</td>
		</tr>
	</table>
	<table class="tab">
		<tr>
			<td rowspan="6"><img src="../assets/images/3x4.png" alt="" width="80" height="60"></td>
		</tr>
		<tr>
			<td>UID</td>
			<td>:</td>
			<td><?= $ang['uid'] ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $ang['nama'] ?></td>
		</tr>
		<tr>
			<td>TTL</td>
			<td>:</td>
			<td><?= $ang['ttl'] ?></td>
		</tr>
		<tr>
			<td>Masa berlaku</td>
			<td>:</td>
			<td><?= $ang['tgl_berakhir'] ?></td>
		</tr>
	</table>
</body>
<script type="text/javascript">
	function cetak() {
		window.print();
	}
</script>
</html>