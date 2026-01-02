<?php 
    require_once __DIR__ . '/../database/koneksi.php';

    function tambahSiswa($data) {
        global $koneksi;
        // sesuaikan dengan field pada tabel dan name pada form
        $nama_siswa = htmlspecialchars($data['nama_siswa']);
        $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
        $umur = htmlspecialchars($data['umur']);

        // query untuk melakukan penyimpanan data
        $query = "INSERT INTO siswa (nama_siswa, jenis_kelamin, umur)
                VALUES ('$nama_siswa', '$jenis_kelamin', '$umur')";

        // eksekusi query ke database
        $result = mysqli_query($koneksi, $query);

        return $result;
}

function tampilData()
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
}

function getDataByID($id) {
    global $koneksi;
    $id = (int)$id;
    return mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa = $id");
}

function UbahSiswa($data) {
    global $koneksi;

        $id = (int)$data['id_siswa'];
        $nama_siswa = htmlspecialchars($data['nama_siswa']);
        $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
        $umur = htmlspecialchars($data['umur']);
    
    $query = "UPDATE siswa SET nama_siswa = '$nama_siswa', jenis_kelamin= '$jenis_kelamin', umur = '$umur' WHERE id_siswa = $id";

     $result = mysqli_query($koneksi, $query);

        return $result;
}

function hapusSiswa($id) {
    global $koneksi;
    $id = (int)$id;

     // Hapus dulu pendaftaran yang terkait
    mysqli_query($koneksi, "DELETE FROM pendaftaran WHERE id_siswa = $id");

    // Baru hapus siswa
    return mysqli_query($koneksi, "DELETE FROM siswa WHERE id_siswa = $id");
}
  
?>