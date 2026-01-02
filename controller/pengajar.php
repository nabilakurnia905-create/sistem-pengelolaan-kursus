<?php 
    require_once __DIR__ . '/../database/koneksi.php';

    function tambahpengajar($data) {
        global $koneksi;
        // sesuaikan dengan field pada tabel dan name pada form
        $nama_pengajar = htmlspecialchars($data['nama_pengajar']);

        // query untuk melakukan penyimpanan data
        $query = "INSERT INTO pengajar (nama_pengajar)
                VALUES ('$nama_pengajar')";

        // eksekusi query ke database
        $result = mysqli_query($koneksi, $query);

        return $result;
}
function tampilData()
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM pengajar ORDER BY nama_pengajar ASC");
}

function getDataByID($id) {
    global $koneksi;
    $id = (int)$id;
    return mysqli_query($koneksi, "SELECT * FROM pengajar WHERE id_pengajar = $id");
}
function UbahPengajar($data) {
    global $koneksi;

        $id = (int)$data['id_pengajar'];
        $nama_pengajar = htmlspecialchars($data['nama_pengajar']);
    
    $query = "UPDATE pengajar SET nama_pengajar = '$nama_pengajar' WHERE id_pengajar = $id";

     $result = mysqli_query($koneksi, $query);

        return $result;
}

function hapusPengajar($id) {
    global $koneksi;
    $id = (int)$id;
     // Hapus dulu kursus yang terkait
    mysqli_query($koneksi, "DELETE FROM kursus WHERE id_pengajar = $id");

    // Baru hapus pengajar
    return mysqli_query($koneksi, "DELETE FROM pengajar WHERE id_pengajar = $id");
}


?>