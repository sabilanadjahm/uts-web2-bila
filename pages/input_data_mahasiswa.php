<?php
include '../header.php';

$conn = new mysqli("localhost", "root", "", "pmb");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'] ?? '';
$editMode = false;
$data = [];

if ($id) {
  $editMode = true;
  $sql = "SELECT * FROM pendaftar WHERE id=$id";
  $result = $conn->query($sql);
  if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $nama = $_POST['nama'];
  $whatsapp = $_POST['whatsapp'];
  $asal_sekolah = $_POST['asal_sekolah'];
  $tahun_lulus = $_POST['tahun_lulus'];
  $prodi = $_POST['prodi'];

  if ($editMode) {
    $sql = "UPDATE pendaftar SET 
              username='$username', nama='$nama', whatsapp='$whatsapp',
              asal_sekolah='$asal_sekolah', tahun_lulus='$tahun_lulus', prodi='$prodi'
            WHERE id=$id";
  } else {
    $sql = "INSERT INTO pendaftar (username, nama, whatsapp, asal_sekolah, tahun_lulus, prodi, created_at) 
            VALUES ('$username', '$nama', '$whatsapp', '$asal_sekolah', '$tahun_lulus', '$prodi', NOW())";
  }

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data berhasil disimpan'); window.location='data_pendaftaran.php';</script>";
  } else {
    echo "Error: " . $conn->error;
  }
}
?>

<div class="container">
  <h2><?= $editMode ? 'Edit' : 'Input' ?> Data Mahasiswa</h2>
  <form method="post">
    <label>Username:</label><br>
    <input type="text" name="username" value="<?= $data['username'] ?? '' ?>" required><br><br>

    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $data['nama'] ?? '' ?>" required><br><br>

    <label>Whatsapp:</label><br>
    <input type="text" name="whatsapp" value="<?= $data['whatsapp'] ?? '' ?>" required><br><br>

    <label>Asal Sekolah:</label><br>
    <input type="text" name="asal_sekolah" value="<?= $data['asal_sekolah'] ?? '' ?>" required><br><br>

    <label>Tahun Lulus:</label><br>
    <input type="number" name="tahun_lulus" value="<?= $data['tahun_lulus'] ?? '' ?>" required><br><br>

    <label>Prodi Pilihan:</label><br>
    <select name="prodi" required>
      <option value="">-- Pilih Prodi --</option>
      <?php
      $prodi_list = [
        "Teknik Mesin", "Teknik Informatika", "Sistem Informasi",
        "Manajemen", "Akuntansi", "Hukum", "Ilmu Komunikasi",
        "Pendidikan Bahasa Inggris", "Agroteknologi", "Farmasi", "Kesehatan Masyarakat"
      ];
      foreach ($prodi_list as $p) {
        $selected = ($data['prodi'] ?? '') === $p ? 'selected' : '';
        echo "<option value=\"$p\" $selected>$p</option>";
      }
      ?>
    </select><br><br>

    <button type="submit">Simpan</button>
  </form>
</div>

<?php
$conn->close();
include '../footer.php';
?>
