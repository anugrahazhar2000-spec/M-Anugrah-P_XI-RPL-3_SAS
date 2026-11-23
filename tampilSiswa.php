<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Siswa</title>
<style>
  body { font-family: Arial, sans-serif; padding:16px; background:#f4f6f8; }
  table { border-collapse:collapse; width:100%; background:#fff; }
  th, td { border:1px solid #ccc; padding:8px; text-align:left; }
  th { background:#2e86de; color:#fff; }
  a.btn { padding:6px 10px; border-radius:5px; color:#fff; text-decoration:none; font-size:14px; }
  .tambah { background:#27ae60; display:inline-block; margin:10px 0; }
  .edit { background:#f39c12; }
  .hapus { background:#e74c3c; }
  .kembali { color:#2e86de; }
</style>
</head>
<body>
  <a class="kembali" href="index.php">&laquo; Menu</a>
  <h2>Data Siswa</h2>
  <a class="btn tambah" href="tambahSiswa.php">+ Tambah Siswa</a>
  <table>
    <tr>
    <th>Email</th><th>Password</th><th>Nama</th><th>Kelas</th><th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM tb_user ORDER BY id_user ASC");
    while ($d = mysqli_fetch_assoc($data)) {
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($d['email']) ?></td>
      <td><?= htmlspecialchars($d['password']) ?></td>
      <td><?= htmlspecialchars($d['nama']) ?></td>
      <td><?= htmlspecialchars($d['kelas']) ?></td>
      <td>
        <a class="btn edit" href="editSiswa.php?id=<?= $d['id_siswa'] ?>">Edit</a>
        <a class="btn hapus" href="hapusSiswa.php?id=<?= $d['id_siswa'] ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
      </td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>