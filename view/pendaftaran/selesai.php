<?php 
require_once __DIR__. '/../../controller/pendaftaran.php';
 

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if (updateStatus($id)) {
        header("Location: index.php?status=selesai");
        exit;
    } else {
        header("Location: index.php?status=gagal");
        exit;
    }
} else {
    echo "ID tidak ditemukan";
}

 ?>


