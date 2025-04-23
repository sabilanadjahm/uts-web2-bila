<?php
include '../header.php';
include '../koneksi.php';

// Ambil data pendaftar dan jadwal tes
$sql = "SELECT p.nama, p.username, p.prodi, j.tanggal_tes, j.jam_tes, j.lokasi
        FROM pendaftar p
        LEFT JOIN jadwal_tes j ON p.username = j.username";

$result = $conn->query($sql);
if (!$result) {
  die("Query gagal: " . $conn->error);
}
?>

<div class="container">
  <h2>Cetak Kartu Ujian</h2>
  <table border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>Nama</th>
      <th>Username</th>
      <th>Program Studi</th>
      <th>Tanggal Tes</th>
      <th>Jam Tes</th>
      <th>Lokasi</th>
      <th>Aksi</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['prodi'] ?? '-') ?></td>
        <td><?= $row['tanggal_tes'] ? date('d-m-Y', strtotime($row['tanggal_tes'])) : '-' ?></td>
        <td><?= htmlspecialchars($row['jam_tes'] ?? '-') ?></td>
        <td><?= htmlspecialchars($row['lokasi'] ?? '-') ?></td>
        <td>
          <?php if (!empty($row['tanggal_tes'])): ?>
            <a href="cetak_pdf.php?username=<?= urlencode($row['username']) ?>" target="_blank">Cetak</a>
          <?php else: ?>
            <em>Belum dijadwalkan</em>
          <?php endif; ?>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>

<?php include '../footer.php'; ?>
