<?php 
    require_once __DIR__ . '/../../controller/kursus.php';

    // validasi ketika tombol ditekan
    if (isset($_POST['submit'])) {
        $pesan = tambahkursus($_POST);
        if ($pesan) {
            header("Location: index.php?status=sukses");
        } else {
            header("Location: index.php?status=gagal");
        }
    }

    require_once __DIR__ . '/../../layout/header.php';
    require_once __DIR__ . '/../../layout/navigasi.php';

    $pengajar = daftarPengajar();
?>

<div class="container py-4">
     <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
     <h5 class="mb-0"><i class="fas fa-book me-2"></i>Tambah Data Kursus</h5>
                </div>
                <div class="card-body p-4">
    
    <form action="" method="POST">
       <div class="mb-3">
         
            <label for="" class="form-label">Nama Kursus</label>
            <input type="text" class="form-control" name="nama_kursus" required>
       </div>
        <div class="mb-3">
            <label for="" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" name="deskripsi" required>
       </div>

        <div class="mb-3">
        <label for="" class="form label">Nama Pengajar</label>
       <select name="id_pengajar" class="form-select" required>
        <option value=""> - Pilih Nama Pengajar - </option>
        <?php while ($p = mysqli_fetch_assoc($pengajar)) : ?>
            <option value="<?= $p['id_pengajar']; ?>"><?= $p['nama_pengajar']; ?></option>
            <?php endwhile; ?>
       </select>
      </div>
       <button class="btn btn-primary" type="submit" name="submit">Simpan Data</button>
    </form>
</div>
<?php require_once __DIR__ . '/../../layout/footer.php'; ?>