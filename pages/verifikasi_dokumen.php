<?php
include '../header.php';

$conn = new mysqli("localhost", "root", "", "pmb");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['verifikasi_id'])) {
  $id = $_GET['verifikasi_id'];
  $conn->query("UPDATE pendaftar SET status_verifikasi='sudah' WHERE id=$id");
  echo "<script>window.location='verifikasi_dokumen.php';</script>";
}

$result = $conn->query("SELECT * FROM pendaftar ORDER BY created_at DESC");
?>

<div class="container">
  <h2>Verifikasi Dokumen Pendaftaran</h2>
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Whatsapp</th>
      <th>Prodi</th>
      <th>Status Verifikasi</th>
      <th>Aksi</th>
    </tr>
    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $row['nama'] ?></td>
      <td><?= $row['whatsapp'] ?></td>
      <td><?= $row['prodi'] ?? '-' ?></td>
      <td><?= $row['status_verifikasi'] == 'sudah' ? '✅' : '❌' ?></td>
      <td>
        <?php if ($row['status_verifikasi'] == 'belum'): ?>
          <a href="?verifikasi_id=<?= $row['id'] ?>" onclick="return confirm('Verifikasi dokumen ini?')">Verifikasi</a>
        <?php else: ?>
          -
        <?php endif; ?>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<?php
$conn->close();
include '../footer.php';
?>
