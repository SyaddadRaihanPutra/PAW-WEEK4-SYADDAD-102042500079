<?php
require_once "config/database.php";

if (!isset($_POST['update'])) {
    header("Location: index.php");
    exit;
}

$id     = (int) $_POST['id'];
$nim     = trim($_POST['nim']);
$nama    = trim($_POST['nama']);
$jurusan = trim($_POST['jurusan']);
$alamat  = trim($_POST['alamat']);

if ($id <= 0 || $nim === "" || $nama === "" || $jurusan === "") {
    header("Location: edit.php?id=" . $id);
    exit;
}

$stmt = mysqli_prepare($conn, "UPDATE mahasiswa SET nim = ?, nama = ?, jurusan = ?, alamat = ? WHERE id = ?");
mysqli_stmt_bind_param($stmt, "ssssi", $nim, $nama, $jurusan, $alamat, $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: index.php");
exit;
?>
