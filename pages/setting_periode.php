<?php include '../header.php'; include '../koneksi.php'; ?>

<div class="container">
    <h2>Setting Periode dan Gelombang Pendaftaran</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tahun = $_POST['tahun'];
        $gelombang = $_POST['gelombang'];
        $mulai = $_POST['mulai'];
        $akhir = $_POST['akhir'];

        $query = "INSERT INTO periode_pendaftaran (tahun_pmb, nama_gelombang, tanggal_mulai, tanggal_berakhir)
                  VALUES ('$tahun', '$gelombang', '$mulai', '$akhir')";
        mysqli_query($koneksi, $query);
        echo "<p>✅ Data berhasil disimpan.</p>";
    }
    ?>

    <form method="post">
        <label>Tahun PMB:</label><br>
        <input type="text" name="tahun" value="2025" required><br><br>

        <label>Nama Gelombang:</label><br>
        <input type="text" name="gelombang" required><br><br>

        <label>Tanggal Mulai:</label><br>
        <input type="date" name="mulai" required><br><br>

        <label>Tanggal Berakhir:</label><br>
        <input type="date" name="akhir" required><br><br>

        <button type="submit">Simpan</button>
    </form>

    <hr>

    <h3>Data Periode Aktif</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>#</th>
            <th>Tahun</th>
            <th>Gelombang</th>
            <th>Mulai</th>
            <th>Berakhir</th>
        </tr>
        <?php
        $result = mysqli_query($koneksi, "SELECT * FROM periode_pendaftaran ORDER BY tahun_pmb DESC");
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>$no</td>
                <td>{$row['tahun_pmb']}</td>
                <td>{$row['nama_gelombang']}</td>
                <td>{$row['tanggal_mulai']}</td>
                <td>{$row['tanggal_berakhir']}</td>
            </tr>";
            $no++;
        }
        ?>
    </table>
</div>

<?php include '../footer.php'; ?>
