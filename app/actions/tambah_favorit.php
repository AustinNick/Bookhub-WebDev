<?php
include_once("../config/config.php");

session_start();
$id = $_SESSION['id'];
$id_produk = $_GET['id'];

$sql = "SELECT * FROM tbfavorite WHERE user_id = '$id' AND buku_id = '$id_produk'";
$result = $konek->query($sql);

if ($result->num_rows < 1) {
    $sql = "INSERT INTO tbfavorite (user_id, buku_id) VALUES ('$id', '$id_produk')";
    $result = $konek->query($sql);

    if ($result) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        echo "Gagal insert data";
    }
} else {
    // Delete from favorite
    $sql = "DELETE FROM tbfavorite WHERE user_id = '$id' AND buku_id = '$id_produk'";
    $result = $konek->query($sql);

    if ($result) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        echo "Gagal delete data";
    }
}
