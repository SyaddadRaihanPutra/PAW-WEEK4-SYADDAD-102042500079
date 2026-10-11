<?php
require_once "config/database.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = mysqli_prepare($conn, "SELECT * FROM mahasiswa WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$mahasiswa = mysqli_fetch_assoc($result);

if (!$mahasiswa) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Data Mahasiswa</title>
</head>

<body>
    <h1>Edit Data Mahasiswa</h1>

    <p><a href="index.php">Kembali</a></p>

    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($mahasiswa['id']) ?>">
        <label for="nim">NIM</label>
        <br>
        <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($mahasiswa['nim']) ?>" required>
        <br>
        <br>
        <label for="nama">Nama</label>
        <br>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($mahasiswa['nama']) ?>" required>
        <br>
        <br>
        <label for="jurusan">Jurusan</label>
        <br>
        <input type="text" id="jurusan" name="jurusan" value="<?= htmlspecialchars($mahasiswa['jurusan']) ?>" required>
        <br>
        <br>
        <label for="alamat">Alamat</label>
        <br>
        <textarea id="alamat" name="alamat" rows="3"
            cols="30"><?= htmlspecialchars($mahasiswa['alamat']) ?></textarea>
        <br>
        <br>
        <button type="submit" name="update">Update</button>
        <button type="reset">Reset</button>
    </form>
</body>

</html>
