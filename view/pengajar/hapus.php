<?php 
require_once __DIR__. '/../../controller/pengajar.php';

$id = (int)($_GET['id'] ?? 0);
    if ($id > 0 ){
        $ok = hapusPengajar($id);
        if($ok){
            header("Location: index.php?status=hapus_sukses");
            exit;
        }
    }
    header("Location: index.php?status=hapus_gagal");
    exit;

