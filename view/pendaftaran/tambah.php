<?php 
    require_once __DIR__ . '/../../controller/pendaftaran.php';

    // validasi ketika tombol ditekan
    if (isset($_POST['submit'])) {
        $pesan = tambahPendaftaran($_POST);
        if ($pesan) {
            header("Location: index.php?status=sukses");
        } else {
            header("Location: index.php?status=gagal");
        }
    }

    require_once __DIR__ . '/../../layout/header.php';
    require_once __DIR__ . '/../../layout/navigasi.php';

    $siswa = daftarSiswa();
    $kursus = daftarKursus();
    
?>

<div class="container py-4">
   <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
     <h5 class="mb-0"><i class="fas fa-book me-2"></i>Tambah Data</h5>
                </div>
                <div class="card-body p-4">
    
    
    <form action="" method="POST">
     <div class="row">
         <div class="col-md-4 mb-3">
        <label for="" class="form-label">Nama Siswa</label>
       <select name="id_siswa" class="form-select" required>
        <option value=""> - Pilih Nama Siswa - </option>
        <?php while ($p = mysqli_fetch_assoc($siswa)) : ?>
            <option value="<?= $p['id_siswa']; ?>"><?= $p['nama_siswa']; ?></option>
            <?php endwhile; ?>
       </select>
      </div>
        <div class="col-md-4 mb-3">
         <label for="" class="form-label">Tanggal Daftar</label>
         <input type="date" name="tgl_daftar" class="form-control" value="<?= date('Y-m-d'); ?>" required>
      </div></div>
      <div class="mb-2">
    <strong>Daftar Kursus</strong>
    <button type="button" class="btn btn-sm btn-outline-primary" onclick="tambahBaris()">Tambah Baris</button>
</div>

<table class="table table-bordered" id="tbl">
    <thead class="table-light">
        <tr>
            <th>Nama Kursus</th>
            <th>Harga Kursus</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>
                <select name="id_kursus[]" class="form-select" required>
                    <option value="">Pilih Kursus</option>
                    <?php while ($b = mysqli_fetch_assoc($kursus)) : ?>
                        <option value="<?= $b['id_kursus']; ?>">
                            <?= $b['nama_kursus']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </td>

            <td>
                <input type="number" name="harga[]" class="form-control" step="0.01" required>
            </td>

            <td>
                <input type="date" name="tgl_mulai[]" class="form-control" required>
            </td>

            <td>
                <input type="date" name="tgl_selesai[]" class="form-control" required>
            </td>

            <td>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapusBaris(this)">
                    Hapus
                </button>
            </td>
        </tr>
    </tbody>
</table>

<button class="btn btn-primary" type="submit" name="submit">Simpan Data</button>
                       </form>
                       </div>

<script>
  function tambahBaris() {
    const tbody = document.querySelector('#tbl tbody');
    const tr0 = tbody.querySelector('tr');
    const clone = tr0.cloneNode(true);

    // Reset semua input
    clone.querySelector('select').selectedIndex = 0;
    clone.querySelector('input[name="harga[]"]').value = "";
    clone.querySelector('input[name="tgl_mulai[]"]').value = "";
    clone.querySelector('input[name="tgl_selesai[]"]').value = "";

    tbody.appendChild(clone);
}

    function hapusBaris(btn){
    const tbody = document.querySelector('#tbl tbody');
    if(tbody.rows.length > 1) btn.closest('tr').remove();
}

</script>
<?php require_once __DIR__ . '/../../layout/footer.php'; ?>