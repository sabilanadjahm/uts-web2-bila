<?php
include '../header.php';

$conn = new mysqli("localhost", "root", "", "pmb");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id_jadwal'];
  $nilai = $_POST['nilai'];
  $ket = $_POST['keterangan'];

  // Tambahkan validasi/escape jika perlu
  $stmt = $conn->prepare("UPDATE jadwal_tes SET nilai = ?, keterangan = ? WHERE id = ?");
  $stmt->bind_param("ssi", $nilai, $ket, $id);

  if ($stmt->execute()) {
    echo "<script>alert('Hasil tes berhasil disimpan!'); window.location='input_hasil_tes.php';</script>";
  } else {
    echo "<script>alert('Gagal menyimpan hasil tes.');</script>";
  }
  $stmt->close();
}

$result = $conn->query("
  SELECT j.*, p.nama FROM jadwal_tes j
  JOIN pendaftar p ON j.username = p.username
  ORDER BY j.tanggal_tes DESC
");
?>

<div class="container">
  <h2>Input Hasil Tes</h2>
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Jenis Tes</th>
      <th>Nilai</th>
      <th>Keterangan</th>
      <th>Aksi</th>
    </tr>
    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
      <tr>
        <form method="post">
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= htmlspecialchars($row['jenis_tes']) ?></td>
          <td>
            <input type="number" step="0.01" name="nilai" value="<?= htmlspecialchars($row['nilai']) ?>" required>
          </td>
          <td>
            <input type="text" name="keterangan" value="<?= htmlspecialchars($row['keterangan']) ?>" required>
          </td>
          <td>
            <input type="hidden" name="id_jadwal" value="<?= $row['id'] ?>">
            <button type="submit">Simpan</button>
          </td>
        </form>
      </tr>
    <?php endwhile; ?>
  </table>
</div>

<?php
$conn->close();
include '../footer.php';
?>
