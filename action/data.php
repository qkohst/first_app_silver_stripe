<?php

// DB table to use
$table = 'warna';

// Table's primary key
$primaryKey = 'ID';


// Array kolom basisdata akan dikirim kembali ke DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// 'db' mewakili parameter kolom database
// 'dt' adalah parameter yang akan ditampilkan di database pada index.php

$columns = array(
    array('db' => 'ID', 'dt' => 'no'),
    array('db' => 'NamaWarna', 'dt' => 'NamaWarna'),
    array('db' => 'Status', 'dt' => 'Status'),
    array(
        'db' => 'ID',
        'dt' => 'aksi',

        // kalo kalian mau bikin tombol edit pake 'formatter' => function($d, $row) {return ....}
        // kalian bisa custom dengan menggunakan class bootstrap untuk mempercantik tampilan
        'formatter' => function ($d, $row) {
            return '<a href="edit?ID=' . $d . '">EDIT</a>';
        }
    ),
);

//melakukan koneksi ke database
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db' => 'mge-training',
    'host' => 'localhost'
);

//code di bawah tidak perlu diedit

require('ssp.class.php');

echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
