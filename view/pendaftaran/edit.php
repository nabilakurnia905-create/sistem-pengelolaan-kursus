<?php 
require_once __DIR__ . '/../../controller/pendaftaran.php';

// ambil id dari url
if (!isset($_GET['id'])) {
    die("ID Tidak Ditemukan");
}
$id = (int)$_GET['id'];

// ambil data lama
$data = mysqli_fetch_assoc(getDataByID($id));


//validasi ketika tombol ditekan
if (isset($_POST['submit'])){
   $pesan = ubahPendaftaran($_POST);
   if ($pesan == 'sukses'){
    header("Location: index.php?status=update_sukses");
   
   }else{
    header("Location: index.php?status=update_gagal");
    
   }
}

require_once __DIR__ . '/../../layout/header.php';
require_once __DIR__ . '/../../layout/navigasi.php';

$siswa = daftarSiswa();
?>


        <div class="container py-4">
   
    <h2>Form Ubah Data Pendaftaran</h2>

    <form action="" method="POST">
        <input type="hidden" name="id_daftar" value="<?= $data['id_daftar']; ?>">
      <div class="mb-3">
        <label for="" class="form label">Tanggal Daftar</label>
        <input type="text" class="form-control" name="tgl_daftar" value="<?= $data['tgl_daftar']; ?>" required>
      </div>
        <div class="mb-3">
        <label for="" class="form label">status</label>
        <input type="text" class="form-control" name="status_daftar" value="<?= $data['status_daftar']; ?>" required>
      </div>
       <div class="mb-3">
        <label for="" class="form label">Total Bayar</label>
        <input type="text" class="form-control" name="total_bayar" value="<?= $data['total_bayar']; ?>" required>
      </div>
      
        <div class="mb-3">
        <label for="" class="form label">Nama Siswa</label>
       <select name="id_siswa" class="form-select" required>
         <option value=""> - Pilih Nama Siswa - </option>
        <?php while ($p = mysqli_fetch_assoc($siswa)) : ?>
            <option value="<?= $p['id_siswa']; ?>"><?= $p['nama_siswa']; ?></option>
            <?php endwhile; ?>
    
       </select>
      </div>


        <button class="btn btn-primary" type="submit" name="submit">Simpan Perubahan</button>
    </form>
</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
