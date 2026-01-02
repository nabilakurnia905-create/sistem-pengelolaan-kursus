<?php 
require_once __DIR__ . '/../database/koneksi.php';

// TAMPIL

function tampilData()
{
    global $koneksi;
    $query = "
        SELECT 
            d.id_daftar, 
            t.tgl_mulai, 
            d.status_daftar, 
            d.total_bayar,
            s.nama_siswa
        FROM pendaftaran d
        LEFT JOIN siswa s ON s.id_siswa = d.id_siswa
        LEFT JOIN detail_daftar t ON t.id_daftar = d.id_daftar
        ORDER BY t.tgl_mulai ASC
    ";
    return mysqli_query($koneksi, $query);
}

function daftarSiswa() {
    global $koneksi;
    return mysqli_query($koneksi, "SELECT id_siswa, nama_siswa FROM siswa ORDER BY nama_siswa");
}

function daftarKursus() {
    global $koneksi;
    return mysqli_query($koneksi, "SELECT id_kursus, nama_kursus FROM kursus ORDER BY nama_kursus");
}


// GET BY ID
function getDataByID($id)
{
    global $koneksi;
    $id = (int)$id;

    $header = mysqli_query($koneksi, "SELECT p.*, s.nama_siswa
                                      FROM pendaftaran p
                                      INNER JOIN siswa s ON s.id_siswa = p.id_siswa
                                      WHERE p.id_daftar = $id");

    $detail = mysqli_query($koneksi, "SELECT d.*, k.nama_kursus
                                      FROM detail_daftar d
                                      INNER JOIN kursus k ON k.id_kursus = d.id_kursus
                                      WHERE d.id_daftar = $id");

    return ['head' => $header, 'detail' => $detail];
}


//TAMBAH PENDAFTARAN

function tambahPendaftaran($data)
{
    global $koneksi;

    $id_siswa      = (int)$data['id_siswa'];
    $tgl_daftar    = mysqli_real_escape_string($koneksi, $data['tgl_daftar']);

    // array multiple
    $kursus_list   = $data['id_kursus'] ?? [];
    $harga_list    = $data['harga'] ?? [];
    $mulai_list    = $data['tgl_mulai'] ?? [];
    $selesai_list  = $data['tgl_selesai'] ?? [];

    // Cek minimal 1 baris
    if (count($kursus_list) == 0) return false;

    mysqli_begin_transaction($koneksi);

    // INSERT HEADER
    $insert = "
        INSERT INTO pendaftaran (id_siswa, tgl_daftar, status_daftar, total_bayar)
        VALUES ($id_siswa, '$tgl_daftar', 'proses', 0)
    ";

    if (!mysqli_query($koneksi, $insert)) {
        mysqli_rollback($koneksi);
        return false;
    }

    $id_daftar = mysqli_insert_id($koneksi);
    $total_bayar = 0;

    // LOOP DETAIL
    for ($i = 0; $i < count($kursus_list); $i++) {

        $id_kursus   = (int)$kursus_list[$i];
        $harga       = (int)$harga_list[$i];

        $tgl_mulai   = mysqli_real_escape_string($koneksi, $mulai_list[$i] ?? '');
        $tgl_selesai = mysqli_real_escape_string($koneksi, $selesai_list[$i] ?? '');

        // Cek input tidak boleh kosong
        if ($tgl_mulai == "" || $tgl_selesai == "") {
            mysqli_rollback($koneksi);
            return false;
        }

        $total_bayar += $harga;

        // INSERT DETAIL
        $insertDetail = "
            INSERT INTO detail_daftar (id_daftar, id_kursus, harga, tgl_mulai, tgl_selesai)
            VALUES ($id_daftar, $id_kursus, $harga, '$tgl_mulai', '$tgl_selesai')
        ";

        if (!mysqli_query($koneksi, $insertDetail)) {
            mysqli_rollback($koneksi);
            return false;
        }
    }


    // UPDATE TOTAL BAYAR
    mysqli_query($koneksi, "
        UPDATE pendaftaran 
        SET total_bayar = $total_bayar
        WHERE id_daftar = $id_daftar
    ");

    mysqli_commit($koneksi);
    return true;
}


// HAPUS
function hapusPendaftaran($id) {
    global $koneksi;
    $id = (int)$id;
    return mysqli_query($koneksi, "DELETE FROM pendaftaran WHERE id_daftar = $id");
}

function updateStatus($id)
{
    global $koneksi;

    $query = "UPDATE pendaftaran 
              SET status_daftar = 'Selesai'
              WHERE id_daftar = '$id'";
              
    return mysqli_query($koneksi, $query);
}



?>
