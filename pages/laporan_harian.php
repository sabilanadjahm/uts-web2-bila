<?php
include '../header.php';
include '../koneksi.php';

$sql = "SELECT * FROM pendaftar WHERE DATE(created_at) = CURDATE() ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<div class="container">
  <h2>Laporan Aktivitas Harian PMB</h2>
  <p>Tanggal: <strong><?= date("d-m-Y") ?></strong></p>
  <table border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>Nama</th>
      <th>Username</th>
      <th>Prodi</th>
      <th>Tanggal Daftar</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['nama'] ?></td>
      <td><?= $row['username'] ?></td>
      <td><?= $row['prodi'] ?></td>
      <td><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<?php
include '../footer.php';
?>
