<?php

use Config\Database;

require_once __DIR__ . "/Database.php";

$db = \Config\Database::getConnection();

if ($db) {
    echo "Sukses membuat koneksi database" . PHP_EOL;
}else{
    echo "Koneksi gagal";
}


