<?php
include "koneksi.php";

$id = (int) ($_GET['id'] ?? 0);

if (isset($_POST['update'])) {
    $email  = $_POST['email'];
    $password = $_POST['password'];
    $nama  = $_POST['nama'];
    $kelas = $_POST['kelas'];

    $stmt = mysqli_prepare($koneksi, "UPDATE tb_user SET email=?, password=?, nama=?, kelas=? WHERE id_user=?");
    mysqli_stmt_bind_param($stmt,$email,$password, $nama, $kelas, );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: tampilSiswa.php");
        exit;
    } else {
        $error = "Gagal mengubah: " . mysqli_error($koneksi);
    }
}

$stmt = mysqli_prepare($koneksi, "SELECT * FROM tb_user WHERE id_user=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$d = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$d) {
    die("Data siswa tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Siswa</title>
<style>
  body { font-family: Arial, sans-serif; padding:16px; background:#f4f6f8; }
  form { max-width:400px; background:#fff; padding:20px; border-radius:8px; }
  label { display:block; margin-top:12px; }
  input { width:100%; padding:8px; box-sizing:border-box; margin-top:4px; }
  button { margin-top:16px; padding:10px 16px; background:#f39c12; color:#fff; border:0; border-radius:5px; }
  .err { color:#c0392b; }
</style>
</head>
<body>
  <a href="tampilSiswa.php">&laquo; Kembali</a>
  <h2>Edit Siswa</h2>
  <?php if (!empty($error)) echo "<p class='err'>$error</p>"; ?>
  <form method="post">
    <label>Email</label>
    <input type="text" name="Email" value="<?= htmlspecialchars($d['nama']) ?>" required>
    <label>Password</label>
    <input type="text" name="Password" value="<?= htmlspecialchars($d['nama']) ?>" required>
    <label>Nama</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($d['nama']) ?>" required>
    <label>Kelas</label>
    <input type="text" name="kelas" value="<?= htmlspecialchars($d['kelas']) ?>" required>
    <button type="submit" name="update">Update</button>
  </form>
</body>
</html>
