<?php
include '../header.php';

$conn = new mysqli("localhost", "root", "", "pmb");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $tanggal_tes = $_POST['tanggal_tes'];
  $jam_tes = $_POST['jam_tes'];
  $jenis_tes = $_POST['jenis_tes'];
  $lokasi = $_POST['lokasi'];

  $sql = "INSERT INTO jadwal_tes (username, tanggal_tes, jam_tes, jenis_tes, lokasi)
          VALUES ('$username', '$tanggal_tes', '$jam_tes', '$jenis_tes', '$lokasi')";
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Jadwal tes berhasil disimpan'); window.location='jadwal_tes.php';</script>";
  } else {
    echo "Gagal menyimpan: " . $conn->error;
  }
}

$pendaftar = $conn->query("SELECT * FROM pendaftar ORDER BY nama ASC");
?>

<div class="container">
  <h2>Jadwalkan Tes / Wawancara</h2>
  <form method="post">
    <label>Pilih Pendaftar:</label><br>
    <select name="username" required>
      <option value="">-- Pilih --</option>
      <?php while ($p = $pendaftar->fetch_assoc()): ?>
        <option value="<?= $p['username'] ?>">
          <?= $p['nama'] ?> (<?= $p['username'] ?>) - <?= $p['prodi'] ?? 'Prodi Belum Dipilih' ?>
        </option>
      <?php endwhile; ?>
    </select><br><br>

    <label>Tanggal Tes:</label><br>
    <input type="date" name="tanggal_tes" required><br><br>

    <label>Jam Tes:</label><br>
    <input type="time" name="jam_tes" required><br><br>

    <label>Jenis Tes:</label><br>
    <select name="jenis_tes" required>
      <option value="Tulis">Tulis</option>
      <option value="Wawancara">Wawancara</option>
    </select><br><br>

    <label>Lokasi:</label><br>
    <input type="text" name="lokasi" required><br><br>

    <button type="submit">Simpan Jadwal</button>
  </form>
</div>

<?php
$conn->close();
include '../footer.php';
?>
