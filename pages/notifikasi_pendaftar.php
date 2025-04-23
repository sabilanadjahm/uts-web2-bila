<?php
include '../header.php';

$conn = new mysqli("localhost", "root", "", "pmb");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Cari berdasarkan username (simulasi cek mandiri oleh pendaftar)
$status = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $result = $conn->query("SELECT nama, status_kelulusan FROM pendaftar WHERE username='$username'");
  $status = $result->fetch_assoc();
}
?>

<div class="container">
  <h2>Cek Status Kelulusan</h2>
  <form method="post">
    <label>Masukkan Username:</label><br>
    <input type="text" name="username" required>
    <button type="submit">Cek</button>
  </form>

  <?php if ($status): ?>
    <h3>Hasil:</h3>
    <p>Nama: <?= $status['nama'] ?></p>
    <p>Status Kelulusan: <strong><?= $status['status_kelulusan'] ?></strong></p>
  <?php endif; ?>
</div>

<?php
$conn->close();
include '../footer.php';
?>
