<?php 
require_once __DIR__. '/../../controller/pendaftaran.php';
require_once __DIR__ . '/../../layout/header.php';
require_once __DIR__ . '/../../layout/navigasi.php';

$id = (int)($_GET['id']?? 0);
$data = getDataByID($id);
$header = mysqli_fetch_assoc($data['head']);
if (!$header) { header("Location: index.php"); exit;}
?>

<div class="container py-4">
    <h3 class="mb-4 fw-bold text-success">Detail Pendaftaran</h3>
     <div class="card mb-4 shadow-sm border-0">
       
        <div class="card-body">
    <div class="mb-3">
        <div><strong>Nomor daftar :</strong> <?= $header['id_daftar']; ?></div>
        <div><strong>tanggal Daftar :</strong> <?= $header['tgl_daftar']; ?></div>
        <div><strong>Nama Siswa :</strong> <?= $header['nama_siswa']; ?></div>
          <div><strong>Status Daftar :</strong> <?= $header['status_daftar']; ?></div>
       
        <div class="mt-2">
                <strong>Total Bayar:</strong>
            
                    Rp <?= number_format($header['total_bayar'], 0, ',', '.'); ?>
                
            </div>
    </div>


       <div class="card shadow-sm border-0">
        <div class="card-header text-white fw-semibold">
            Detail Kursus yang Diambil
        </div>

        <div class="card-body p-0">
            <table class="table table-hover table-striped table-bordered text-center align-middle mb-0">
                <thead class="table-secondary">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Kursus</th>
                        <th width="150">Tanggal Mulai</th>
                        <th width="150">Tanggal Selesai</th>
                        <th width="150">Harga</th>
                        
                    </tr>
                </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($data['detail'])) : ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row['nama_kursus']; ?></td>
                    <td><?= $row['tgl_mulai']; ?></td>
                    <td><?= $row['tgl_selesai']; ?></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                  
                   
                </tr>
                <?php $no++; endwhile; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary mt-4">Kembali ke Pendaftaran</a>
   
</div>
<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
