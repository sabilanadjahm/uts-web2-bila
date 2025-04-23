<?php include '../header.php'; include '../koneksi.php'; ?>

<div class="container">
    <h2>Manajemen Akun Petugas dan Role</h2>

    <?php
    // Hapus user
    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        mysqli_query($koneksi, "DELETE FROM users WHERE id=$id");
        echo "<p>❌ Akun berhasil dihapus.</p>";
    }

    // Tambah user
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $role = $_POST['role'];
        $password = password_hash("123456", PASSWORD_DEFAULT); // default dummy password

        $query = "INSERT INTO users (nama, username, password, role, status) VALUES 
                  ('$nama', '$username', '$password', '$role', 'Aktif')";
        mysqli_query($koneksi, $query);
        echo "<p>✅ Akun berhasil ditambahkan.</p>";
    }
    ?>

    <form method="post">
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Role:</label><br>
        <select name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="Petugas PMB">Petugas PMB</option>
            <option value="Kepala PMB">Kepala PMB</option>
            <option value="Keuangan">Keuangan</option>
            <option value="Sarana">Sarana</option>
            <option value="Pimpinan">Pimpinan</option>
            <option value="Operator Tes">Operator Tes</option>
        </select><br><br>

        <button type="submit">Tambah Akun</button>
    </form>

    <hr>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $result = mysqli_query($koneksi, "SELECT * FROM users");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>$no</td>
                <td>{$row['nama']}</td>
                <td>{$row['username']}</td>
                <td>{$row['role']}</td>
                <td>{$row['status']}</td>
                <td>
                    <button disabled>Edit</button>
                    <a href='manajemen_akun.php?hapus={$row['id']}' onclick='return confirm(\"Yakin hapus?\")'>
                        <button>Nonaktifkan</button>
                    </a>
                </td>
            </tr>";
            $no++;
        }
        ?>
        </tbody>
    </table>
</div>

<?php include '../footer.php'; ?>
