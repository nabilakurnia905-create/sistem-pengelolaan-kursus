<?php 
require_once __DIR__. '/../../controller/kursus.php';

//ambil id dri url
if(!isset($_GET['id'])) {
    die("ID Tidak Ditemukan!");
}
$id=(int)$_GET['id'];

//ambil data lama
$data = mysqli_fetch_assoc(getDataByID($id));

//validasi ketika tombol ditekan
if (isset($_POST['submit'])){
   $pesan = ubahKursus($_POST);
   if ($pesan == 'sukses'){
    header("Location: index.php?status=update_sukses");
   
   }else{
    header("Location: index.php?status=update_gagal");
    
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
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Ubah Data Kursus</h5>
                </div>
                <div class="card-body p-4">

    <form action="" method="POST">
        <input type="hidden" name="id_kursus" value="<?= $data['id_kursus']; ?>">
      <div class="mb-3">
        <label for="" class="form label">Nama Kursus</label>
        <input type="text" class="form-control" name="nama_kursus" value="<?= $data['nama_kursus']; ?>" required>
      </div>
        <div class="mb-3">
        <label for="" class="form label">Deskripsi</label>
        <input type="text" class="form-control" name="deskripsi" value="<?= $data['deskripsi']; ?>" required>
      </div>
        <div class="mb-3">
        <label for="" class="form label">-- Pilih Nama Pengajar --</label>
         <select name="id_pengajar" class="form-select" required>
        <option value="<?= $data['id_pengajar']; ?>"> <?= $data['nama_pengajar']; ?>  </option>
        <?php while ($p = mysqli_fetch_assoc($pengajar)) : ?>
            <option value="<?= $p['id_pengajar']; ?>"><?= $p['nama_pengajar']; ?></option>
            <?php endwhile; ?>
       </select>
      </div>

<button class="btn btn-primary" type="submit" name="submit">Simpan Data</button>
    </form>
</div>
<?php require_once __DIR__ . '/../../layout/footer.php' ?>