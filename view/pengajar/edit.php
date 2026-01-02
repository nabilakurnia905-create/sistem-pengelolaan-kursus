<?php 
    require_once __DIR__ . '/../../controller/pengajar.php';

    // ambil id dari url
    if (!isset($_GET['id'])) {
        die("ID Tidak Ditemukan");
    }
    $id = (int)$_GET['id'];

    // ambil data lama
    $data = mysqli_fetch_assoc(getDataByID($id));

    if (isset($_POST['submit'])) {
        $pesan = UbahPengajar($_POST);
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
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Ubah Data Pengajar</h5>
                </div>
                <div class="card-body p-4">


    <form action="" method="POST">
        <input type="hidden" name="id_pengajar" value="<?= $data['id_pengajar']; ?>">
       <div class="mb-3">
            <label for="" class="form-label">Nama Pengajar</label>
            <input type="text" class="form-control" name="nama_pengajar" value="<?= $data['nama_pengajar']; ?>"required>
       </div>
       <button class="btn btn-primary" type="submit" name="submit">Simpan Data</button>
    </form>
</div>
<?php require_once __DIR__ . '/../../layout/footer.php'; ?>