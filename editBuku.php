<?php
include "koneksi.php";

$id = (int) ($_GET['id'] ?? 0);

if (isset($_POST['update'])) {
    $id_siswa = (int) $_POST['id_siswa'];
    $tanggal  = $_POST['tanggal'];
    $status   = $_POST['status_terima'];

    $stmt = mysqli_prepare($koneksi, "UPDATE tb_buku SET id_ussr=?, tanggal=?, status_terima=? WHERE id_mbuku=?");
    mysqli_stmt_bind_param($stmt, "issi", $id_siswa, $tanggal, $status, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: tampilBuku.php");
        exit;
    } else {
        $error = "Gagal mengubah: " . mysqli_error($koneksi);
    }
}

$stmt = mysqli_prepare($koneksi, "SELECT * FROM tb_buku WHERE id_mbg=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$d = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$d) {
    die("Data Buku tidak ditemukan.");
}

$siswa = mysqli_query($koneksi, "SELECT id_user, nama, kelas FROM tb_user ORDER BY nama ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Data Buku</title>
<style>
  body { font-family: Arial, sans-serif; padding:16px; background:#f4f6f8; }
  form { max-width:400px; background:#fff; padding:20px; border-radius:8px; }
  label { display:block; margin-top:12px; }
  input, select { width:100%; padding:8px; box-sizing:border-box; margin-top:4px; }
  button { margin-top:16px; padding:10px 16px; background:#f39c12; color:#fff; border:0; border-radius:5px; }
  .err { color:#c0392b; }
</style>
</head>
<body>
  <a href="tampilMbg.php">&laquo; Kembali</a>
  <h2>Edit Data Buku</h2>
  <?php if (!empty($error)) echo "<p class='err'>$error</p>"; ?>
  <form method="post">
    <label>Siswa</label>
    <select name="id_siswa" required>
      <?php while ($s = mysqli_fetch_assoc($siswa)) { ?>
        <option value="<?= $s['id_siswa'] ?>" <?= $s['id_siswa'] == $d['id_siswa'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($s['nama']) ?> (<?= htmlspecialchars($s['kelas']) ?>)
        </option>
      <?php } ?>
    </select>
    <label>Tanggal</label>
    <input type="date" name="tanggal" value="<?= htmlspecialchars($d['tanggal']) ?>" required>
    <label>Status Terima</label>
    <select name="status_terima" required>
      <option value="Sudah" <?= $d['status_terima'] == 'Sudah' ? 'selected' : '' ?>>Sudah</option>
      <option value="Belum" <?= $d['status_terima'] == 'Belum' ? 'selected' : '' ?>>Belum</option>
    </select>
    <button type="submit" name="update">Update</button>
  </form>
</body>
</html>
