<?php
require_once "config/database.php";

$pesan = "";

if (isset($_POST['simpan'])) {
    $nim = trim($_POST['nim']);
    $nama = trim($_POST['nama']);
    $jurusan = trim($_POST['jurusan']);
    $alamat = trim($_POST['alamat']);

    if ($nim === "" || $nama === "" || $jurusan === "") {
        $pesan = "NIM, Nama, dan Jurusan wajib diisi.";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO mahasiswa (nim, nama, jurusan, alamat) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $nim, $nama, $jurusan, $alamat);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit;
        } else {
            $pesan = "Gagal menyimpan data: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Data Mahasiswa</title>
</head>

<body>
    <h1>Tambah Data Mahasiswa</h1>

    <?php if ($pesan !== ""): ?>
        <p><?= htmlspecialchars($pesan) ?></p>
    <?php endif; ?>

    <p><a href="index.php">Kembali</a></p>

    <form action="tambah.php" method="post">
        <label for="nim">NIM</label>
        <br>
        <input type="text" id="nim" name="nim"
            value="<?= isset($_POST['nim']) ? htmlspecialchars($_POST['nim']) : "" ?>" required>
        <br>
        <br>
        <label for="nama">Nama</label>
        <br>
        <input type="text" id="nama" name="nama"
            value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : "" ?>" required>
        <br>
        <br>
        <label for="jurusan">Jurusan</label>
        <br>
        <input type="text" id="jurusan" name="jurusan"
            value="<?= isset($_POST['jurusan']) ? htmlspecialchars($_POST['jurusan']) : "" ?>" required>
        <br>
        <br>
        <label for="alamat">Alamat</label>
        <br>
        <textarea id="alamat" name="alamat" rows="3"
            cols="30"><?= isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : "" ?></textarea>
        <br>
        <br>
        <button type="submit" name="simpan">Simpan</button>
        <button type="reset">Reset</button>
    </form>
</body>

</html>