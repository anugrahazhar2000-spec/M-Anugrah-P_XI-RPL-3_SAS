<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $id_siswa = (int) $_POST['id_siswa'];
    $tanggal  = $_POST['tanggal'];
    $status   = $_POST['status_terima'];

    $stmt = mysqli_prepare($koneksi, "INSERT INTO tb_user (id_siswa, tanggal, status_terima) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iss", $id_user, $tanggal, $status);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: tampilBuku.php");
        exit;
    } else {
        $error = "Gagal menyimpan: " . mysqli_error($koneksi);
    }
}

$siswa = mysqli_query($koneksi, "SELECT id_user, nama, kelas FROM tb_user ORDER BY nama ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tambah Data Perpustakaan</title>
<style>
  body { font-family: Arial, sans-serif; padding:16px; background:#f4f6f8; }
  form { max-width:400px; background:#fff; padding:20px; border-radius:8px; }
  label { display:block; margin-top:12px; }
  input, select { width:100%; padding:8px; box-sizing:border-box; margin-top:4px; }
  button { margin-top:16px; padding:10px 16px; background:#27ae60; color:#fff; border:0; border-radius:5px; }
  .err { color:#c0392b; }
</style>
</head>
<body>
  <a href="tampilMbg.php">&laquo; Kembali</a>
  <h2>Tambah Data Buku</h2>
  <?php if (!empty($error)) echo "<p class='err'>$error</p>"; ?>
  <form method="post">
    <label>Siswa</label>
    <select name="id_siswa" required>
      <option value="">-- Pilih Siswa --</option>
      <?php while ($s = mysqli_fetch_assoc($siswa)) { ?>
        <option value="<?= $s['id_siswa'] ?>">
          <?= htmlspecialchars($s['nama']) ?> (<?= htmlspecialchars($s['kelas']) ?>)
        </option>
      <?php } ?>
    </select>
    <label>Tanggal</label>
    <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" required>
    <label>Status Terima</label>
    <select name="status_terima" required>
      <option value="Sudah">Sudah</option>
      <option value="Belum">Belum</option>
    </select>
    <button type="submit" name="simpan">Simpan</button>
  </form>
</body>
</html>
