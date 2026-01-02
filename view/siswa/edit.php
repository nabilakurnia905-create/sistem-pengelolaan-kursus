<?php 
    require_once __DIR__ . '/../../controller/siswa.php';

    // ambil id dari url
    if (!isset($_GET['id'])) {
        die("ID Tidak Ditemukan");
    }
    $id = (int)$_GET['id'];

    // ambil data lama
    $data = mysqli_fetch_assoc(getDataByID($id));

    if (isset($_POST['submit'])) {
        $pesan = UbahSiswa($_POST);
        if ($pesan) {
            header("Location: index.php?status=update_sukses");
        } else {
            header("Location: index.php?status=update_gagal");
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
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Ubah Data Siswa</h5>
                </div>
                <div class="card-body p-4">

    <form action="" method="POST">
        <input type="hidden" name="id_siswa" value="<?= $data['id_siswa']; ?>">
       <div class="mb-3">
            <label for="" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" name="nama_siswa"  value="<?= $data['nama_siswa']; ?>"required>
       </div>
       <div class="mb-3">
            <label for="" class="form-label">Jenis Kelamin</label>
            <input type="text" class="form-control" name="jenis_kelamin" value="<?= $data['jenis_kelamin']; ?>"required>
       </div>
       <div class="mb-3">
            <label for="" class="form-label">Umur</label>
            <input type="text" class="form-control" name="umur" value="<?= $data['umur']; ?>"required>
       </div>
       <button class="btn btn-primary" type="submit" name="submit">Simpan Data</button>
    </form>
</div>
<?php require_once __DIR__ . '/../../layout/footer.php'; ?>