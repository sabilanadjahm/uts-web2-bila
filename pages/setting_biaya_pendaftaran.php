<?php
include '../koneksi.php';

// Pastikan koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $tahun = $_POST['tahun_pmb'];
    $nominal = $_POST['nominal'];
    $keterangan = $_POST['keterangan'];

    $query = "INSERT INTO biaya_pendaftaran (tahun_pmb, nominal, keterangan) 
              VALUES ('$tahun', '$nominal', '$keterangan')";
    mysqli_query($conn, $query);
    echo "<script>alert('Biaya pendaftaran berhasil disimpan');</script>";
}

$result = mysqli_query($conn, "SELECT * FROM biaya_pendaftaran ORDER BY tahun_pmb DESC");
?>

<h2>Setting Biaya Pendaftaran</h2>
<form method="POST">
    Tahun PMB: <input type="text" name="tahun_pmb" required><br>
    Nominal (Rp): <input type="number" name="nominal" required><br>
    Keterangan: <input type="text" name="keterangan"><br>
    <button type="submit" name="submit">Simpan</button>
</form>

<h3>Riwayat Biaya Pendaftaran</h3>
<table border="1">
    <tr>
        <th>Tahun</th><th>Nominal</th><th>Keterangan</th><th>Update Terakhir</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['tahun_pmb'] ?></td>
        <td>Rp<?= number_format($row['nominal'], 0, ',', '.') ?></td>
        <td><?= $row['keterangan'] ?></td>
        <td><?= $row['updated_at'] ?></td>
    </tr>
    <?php } ?>
</table>
