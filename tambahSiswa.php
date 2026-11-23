<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $nis   = (int) $_POST['nis'];
    $nama  = $_POST['nama'];
    $kelas = $_POST['kelas'];

    mysqli_stmt_bind_param($stmt, $nis, $nama, $kelas);
    $stmt = mysqli_prepare($koneksi, "INSERT INTO tb_user (nis, nama, kelas) VALUES (?, ?, ?)");

    if (mysqli_stmt_execute($stmt)) {
        header("Location: tampilSiswa.php");
        exit;
    } else {
        $error = "Gagal menyimpan: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tambah Siswa</title>
<style>
  body { font-family: Arial, sans-serif; padding:16px; background:#f4f6f8; }
  form { max-width:400px; background:#fff; padding:20px; border-radius:8px; }
  label { display:block; margin-top:12px; }
  input { width:100%; padding:8px; box-sizing:border-box; margin-top:4px; }
  button { margin-top:16px; padding:10px 16px; background:#27ae60; color:#fff; border:0; border-radius:5px; }
  .err { color:#c0392b; }
</style>
</head>
<body>
  <a href="tampilSiswa.php">&laquo; Kembali</a>
  <h2>Tambah Siswa</h2>
  <?php if (!empty($error)) echo "<p class='err'>$error</p>"; ?>
  <form method="post">
    <label>Email</label>
    <input type="text" name="Email" required>
    <label>Paswword</label>
    <input type="text" name="Password" required>
    <label>Nama</label>
    <input type="text" name="nama" required>
    <label>Kelas</label>
    <input type="text" name="kelas" required>
    <button type="submit" name="simpan">Simpan</button>
  </form>
</body>
</html>
