<?php
include '../koneksi.php';

// Pastikan koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_GET['verifikasi'])) {
    $username = $_GET['verifikasi'];
    mysqli_query($conn, "UPDATE pendaftar SET status_pembayaran='sudah' WHERE username='$username'");
    echo "<script>alert('Pembayaran diverifikasi!'); window.location='verifikasi_pembayaran.php';</script>";
}

$result = mysqli_query($conn, "SELECT * FROM pendaftar WHERE bukti_pembayaran IS NOT NULL");
?>

<h2>Verifikasi Bukti Pembayaran</h2>
<table border="1">
    <tr>
        <th>Username</th><th>Nama</th><th>Bukti Pembayaran</th><th>Status</th><th>Aksi</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['username'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><a href="../assets/<?= $row['bukti_pembayaran'] ?>" target="_blank">Lihat</a></td>
        <td><?= $row['status_pembayaran'] ?></td>
        <td>
            <?php if ($row['status_pembayaran'] == 'belum') { ?>
                <a href="?verifikasi=<?= $row['username'] ?>" onclick="return confirm('Verifikasi pembayaran ini?')">Verifikasi</a>
            <?php } else { echo 'Sudah Diverifikasi'; } ?>
        </td>
    </tr>
    <?php } ?>
</table>
