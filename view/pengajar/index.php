<?php 

    require_once __DIR__ . '/../../controller/pengajar.php';
    require_once __DIR__ . '/../../layout/header.php';
    require_once __DIR__ . '/../../layout/navigasi.php';

    $result = tampilData();
?>

<div class="container py-4">
    <?php 
     $status = $_GET['status'] ?? '';
        if ($status == 'sukses') {
            echo "<div class='alert alert-success'> Data berhasil disimpan!</div>";
        } elseif ($status == 'gagal') {
            echo"<div class='alert alert-danger'>Data gagal disimpan</div>";
        } elseif ($status == 'update_sukses') {
            echo"<div class='alert alert-success'>Data berhasil diubah</div>";
        } elseif ($status == 'update_gagal') {
            echo"<div class='alert alert-danger'>Data gagal diubah</div>";
    } elseif ($status == 'hapus_sukses') {
            echo"<div class='alert alert-success'>Data berhasil dihapus!</div>";
        } elseif ($status == 'hapus_gagal') {
            echo"<div class='alert alert-danger'>Data gagal dihapus</div>";
        } 
    ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="m-0"><i class="fas fa-chalkboard-user me-2"></i>Data Pengajar</h3>
    <a href="tambah.php" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Tambah Data</a>
</div>

 <div class="card">
        <div class="table-responsive">
<table class="table table-hover mb-0">
                <thead class="table-light">
        <tr align="center">
          <th>No.</th>
          <th><i class="fas fa-user me-2"></i>Nama Pengajar</th>
            <th style="width: 180px">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php 
     $no = 1;
     if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
    ?>

    <tr align="center">
        <td><?= $no; ?></td>
        <td><?= $row['nama_pengajar']; ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id_pengajar']; ?>" class="btn btn-sm btn-warning">
                Edit
            </a>
               <a href="hapus.php?id=<?= $row['id_pengajar']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus?')">
                    Delete
                </a>
        </td>

    </tr>

        <?php 
         $no++;
     }
    } else {
        ?>

        <tr>
            <td colspan="3" ailgn="center">Data Pengajar tidak tersedia</td>
        </tr>
        <?php 
    }
        ?>
    </tbody>
</table>
</div>
<?php require_once __DIR__ . '/../../layout/footer.php'; ?>