<?php 
require_once __DIR__ . '/../database/koneksi.php';

//  MENAMPILKAN SEMUA PENDAFTARAN 
function tampilData()
{
    global $koneksi;
    $query = "
        SELECT 
            k.id_kursus, 
            k.nama_kursus, 
            k.deskripsi, 
            p.id_pengajar,
            p.nama_pengajar
        FROM kursus k
        LEFT JOIN pengajar p ON k.id_pengajar = p.id_pengajar
        ORDER BY k.nama_kursus ASC
    ";
    return mysqli_query($koneksi, $query);
}

function daftarPengajar()
{
     global $koneksi;
     return mysqli_query($koneksi, "SELECT id_pengajar, nama_pengajar FROM pengajar ORDER BY nama_pengajar");

}

// MENDAPATKAN DATA PENDAFTARAN BERDASARKAN ID 
function getDataByID($id) {
    global $koneksi;
    $id = (int)$id;
    return mysqli_query ($koneksi, "
       SELECT 
            k.id_kursus, 
            k.nama_kursus, 
            k.deskripsi, 
            p.id_pengajar,
            p.nama_pengajar
        FROM kursus k
        LEFT JOIN pengajar p ON k.id_pengajar = p.id_pengajar
        WHERE k.id_kursus = $id");
}

function tambahkursus($data) {
    global $koneksi;

    $nama_kursus = htmlspecialchars($data['nama_kursus']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $id_pengajar = htmlspecialchars($data['id_pengajar']);

    $query = "
        INSERT INTO kursus (nama_kursus, deskripsi, id_pengajar)
        VALUES ('$nama_kursus', '$deskripsi', '$id_pengajar')
    ";

    return mysqli_query($koneksi, $query);
}

function ubahKursus ($data){
     global $koneksi;
    //sesuaikan dengan field pada tabel dan name pada form
    $id = (int)$data['id_kursus'];
    $nama_kursus = htmlspecialchars($data['nama_kursus']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $id_pengajar = htmlspecialchars($data['id_pengajar']);

    $query = "UPDATE kursus SET nama_kursus = '$nama_kursus',
                                deskripsi = '$deskripsi',
                                id_pengajar = '$id_pengajar'
                                WHERE id_kursus = $id";

//eksekusi query ke database
    $result = mysqli_query($koneksi, $query);

    return $result;
}

function hapusKursus($id) {
    global $koneksi;
    $id = (int)$id;
    return mysqli_query($koneksi, "DELETE FROM kursus WHERE id_kursus = $id");
}
