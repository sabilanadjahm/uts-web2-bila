<?php
include '../header.php';

$conn = new mysqli("localhost", "root", "", "pmb");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $status = $_POST['status_kelulusan'];

  $stmt = $conn->prepare("UPDATE pendaftar SET status_kelulusan = ? WHERE username = ?");
  $stmt->bind_param("ss", $status, $username);

  if ($stmt->execute()) {
    echo "<script>alert('Status kelulusan berhasil diubah'); window.location='kelulusan.php';</script>";
  } else {
    echo "<script>alert('Gagal mengubah status kelulusan');</script>";
  }
  $stmt->close();
}

$pendaftar = $conn->query("SELECT username, nama, status_kelulusan FROM pendaftar ORDER BY nama ASC");
?>

<div class="container">
  <h2>Kelulusan Pendaftar</h2>
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Username</th>
      <th>Status Kelulusan</th>
      <th>Aksi</th>
    </tr>
    <?php $no = 1; while ($p = $pendaftar->fetch_assoc()): ?>
    <tr>
      <form method="post">
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($p['nama']) ?></td>
        <td><?= htmlspecialchars($p['username']) ?></td>
        <td>
          <select name="status_kelulusan" required>
            <option value="Belum Ditetapkan" <?= $p['status_kelulusan'] == 'Belum Ditetapkan' ? 'selected' : '' ?>>Belum Ditetapkan</option>
            <option value="Lulus" <?= $p['status_kelulusan'] == 'Lulus' ? 'selected' : '' ?>>Lulus</option>
            <option value="Tidak Lulus" <?= $p['status_kelulusan'] == 'Tidak Lulus' ? 'selected' : '' ?>>Tidak Lulus</option>
          </select>
        </td>
        <td>
          <input type="hidden" name="username" value="<?= htmlspecialchars($p['username']) ?>">
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
