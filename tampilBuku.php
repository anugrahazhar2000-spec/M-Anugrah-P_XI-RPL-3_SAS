<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Buku</title>
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
  <h2>Data Buku</h2>
  <a class="btn tambah" href="tambahBuku.php">+ Tambah Data Buku</a>
  <table>
    <tr>
      <th>Nama Siswa</th><th>Kelas</th><th>Tanggal</th><th>Status Terima</th><th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    $data = mysqli_query($koneksi, "
        SELECT m.*, s.nama, s.kelas
        FROM tb_buku m
        LEFT JOIN tb_user s ON m.id_user = s.id_ussr
        ORDER BY m.tanggal DESC, m.id_buku DESC
    ");
    while ($d = mysqli_fetch_assoc($data)) {
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($d['nama'] ?? '(siswa dihapus)') ?></td>
      <td><?= htmlspecialchars($d['kelas'] ?? '-') ?></td>
      <td><?= date('d/m/Y', strtotime($d['tanggal'])) ?></td>
      <td><?= htmlspecialchars($d['status_terima']) ?></td>
      <td>
        <a class="btn edit" href="editMbg.php?id=<?= $d['id_buku'] ?>">Edit</a>
        <a class="btn hapus" href="hapusMbg.php?id=<?= $d['id_buku'] ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
      </td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>
