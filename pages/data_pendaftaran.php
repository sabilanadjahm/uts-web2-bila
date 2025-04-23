<?php
include '../header.php';

$conn = new mysqli("localhost", "root", "", "pmb");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM pendaftar ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<div class="container">
  <h2>Data Pendaftar</h2>
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Username</th>
      <th>Nama</th>
      <th>Whatsapp</th>
      <th>Asal Sekolah</th>
      <th>Tahun Lulus</th>
      <th>Prodi</th>
      <th>Aksi</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
      <?php $no = 1; while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $row['username'] ?></td>
          <td><?= $row['nama'] ?></td>
          <td><?= $row['whatsapp'] ?></td>
          <td><?= $row['asal_sekolah'] ?></td>
          <td><?= $row['tahun_lulus'] ?></td>
          <td><?= $row['prodi'] ?? '-' ?></td>
          <td>
            <a href="input_data_mahasiswa.php?id=<?= $row['id'] ?>">Edit</a>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="8">Belum ada data pendaftar.</td></tr>
    <?php endif; ?>
  </table>
</div>

<?php
$conn->close();
include '../footer.php';
?>
