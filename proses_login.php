<?php 
session_start();

//Daftar Usern Login
$users = [
    'Ana' => ['password' => '12345', 'role' => 'kepala', 'nama' => 'kepala kursus'],
    'Yuha' => ['password' => '12345', 'role' => 'staff', 'nama' => 'staff kursus'],
];

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if(isset($users[$username]) && $password == $users[$username]['password']){
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['nama'] = $users[$username]['nama'];
    $_SESSION['role'] = $users[$username]['role'];
    header ('Location: view/dashboard');
    exit;
}

header('Location: index.php?err=Username atau password salah');
exit;
?>