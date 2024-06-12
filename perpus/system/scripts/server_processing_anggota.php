<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'anggota';

// Table's primary key
$primaryKey = 'id_anggota';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'nama', 'dt' => 0, 'field' => 'nama' ),
	array( 'db' => 'ttl',  'dt' => 1, 'field' => 'ttl' ),
	array( 'db' => 'tgl_daftar', 'dt' => 2, 'field' => 'tgl_daftar' ),
	array( 'db' => 'tgl_berakhir', 'dt' => 3, 'field' => 'tgl_berakhir'),
	array( 'db' => 'uid', 'dt' => 4, 'field' => 'uid'),
	array( 'db' => 'status_aktif', 'dt' => 5, 'field' => 'status_aktif', 'formatter'=> function($d, $row){
		return $a = ($d == '1') ? 'Aktif' : 'Tidak aktif' ;
	}),
	array( 'db' => 'id_anggota', 'dt' => 6, 'formatter'=> function($d, $row){
		// return "<a class='btn btn-xs btn-round btn-info' href=edit.php?id_kar=".$d.">Edit</a>";
		$a = "<button class='btn btn-xs btn-round btn-info' type='button' onClick=editModal(".$d.")>Edit</button> ";
		$a .= "<button class='btn btn-xs btn-round btn-info' type='button' onClick=deleteModal(".$d.")>Delete</button> ";
		$c = ($row[5]=='1') ? "<button class='btn btn-xs btn-round btn-info' type='button' onClick=cetakKartu(".$row[4].")>Cetak</button> " : "";
		return $a.$c;
	}, 'field' => 'id_anggota'),
);

// SQL server connection information
require('config.php');
$sql_details = array(
	'user' => $db_username,
	'pass' => $db_password,
	'db'   => $db_name,
	'host' => $db_host
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.customized.class.php' );

$joinQuery = "";
// $extraWhere = "`u`.`salary` >= 90000";
$extraWhere = "";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);