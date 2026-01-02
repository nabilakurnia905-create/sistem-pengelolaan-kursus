<?php
if(session_status() === PHP_SESSION_NONE) session_start();
$user = $_SESSION['nama'] ?? null;
$role = $_SESSION['role'] ?? null;
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a href="index.php" class="navbar-brand"><i class="fas fa-graduation-cap me-2"></i>Sistem Pengelola Kursus</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>   
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   <?php if ($role === 'kepala') : ?>
                <li class="nav-item">
                    <a href="../siswa/" class="nav-link"><i class="fas fa-users me-1"></i>Siswa</a>
                </li>
                <li class="nav-item">
                    <a href="../pengajar/" class="nav-link"><i class="fas fa-chalkboard-user me-1"></i>Pengajar</a>
                </li>
                  <li class="nav-item">
                    <a href="../kursus/" class="nav-link"><i class="fas fa-book me-1"></i>kursus</a>
                </li>
                  <?php endif; ?>

        <?php if ($role === 'staff') : ?>
                <li class="nav-item">
                    <a href="../pendaftaran/" class="nav-link"><i class="fas fa-clipboard-list me-1"></i>Pendaftaran</a>
                </li>
                  <?php endif; ?>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <?php if($user): ?>
        <li class="nav-item">
          <span class="nav-link">Hallo, <strong><?= $user; ?></strong></span>
        </li>
        <li class="nav-item">
          <a href="../../logout.php" class="nav-link text-danger">Logout</a>
        </li>
        <?php else: ?>
          <li class="nav-item"><a href="/index.php" class="nav-link"></a>Login</li>
          <?php endif; ?>
    </ul>
        </div>
    </div>
</nav>