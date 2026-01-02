<?php 
    require_once __DIR__ . '/../../controller/siswa.php';

    // validasi ketika tombol ditekan
    if (isset($_POST['submit'])) {
        $pesan = tambahSiswa($_POST);
        if ($pesan) {
            header("Location: index.php?status=sukses");
        } else {
            header("Location: index.php?status=gagal");
        }
    }

    require_once __DIR__ . '/../../layout/header.php';
    require_once __DIR__ . '/../../layout/navigasi.php';
?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
     <h5 class="mb-0"><i class="fas fa-book me-2"></i>Tambah Data Siswa</h5>
                </div>
                <div class="card-body p-4">
    <form action="" method="POST">
       <div class="mb-3">
            <label for="" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" name="nama_siswa" required>
       </div>
       <div class="mb-3">
            <label for="" class="form-label">Jenis Kelamin</label>
            <input type="text" class="form-control" name="jenis_kelamin" required>
       </div>
       <div class="mb-3">
            <label for="" class="form-label">Umur</label>
            <input type="text" class="form-control" name="umur" required>
       </div>
       <button class="btn btn-primary" type="submit" name="submit">Simpan Data</button>
    </form>
</div>
<?php require_once __DIR__ . '/../../layout/footer.php'; ?>