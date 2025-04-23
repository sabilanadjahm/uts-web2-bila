<?php
include '../header.php';

$conn = new mysqli("localhost", "root", "", "pmb");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$query = "
  SELECT j.*, p.nama, p.whatsapp
  FROM jadwal_tes j
  JOIN pendaftar p ON j.username = p.username
  ORDER BY j.tanggal_tes, j.jam_tes
";

$result = $conn->query($query);
?>

<div class="container">
  <h2>Jadwal Tes & Peserta</h2>
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Whatsapp</th>
      <th>Jenis Tes</th>
      <th>Tanggal</th>
      <th>Jam</th>
      <th>Lokasi</th>
    </tr>
    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $row['nama'] ?></td>
      <td><?= $row['whatsapp'] ?></td>
      <td><?= $row['jenis_tes'] ?></td>
      <td><?= $row['tanggal_tes'] ?></td>
      <td><?= $row['jam_tes'] ?></td>
      <td><?= $row['lokasi'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<?php
$conn->close();
include '../footer.php';
?>
