<?php
include_once("config/config.php");
$action = isset($_GET['action']) ? $_GET['action'] : "";
$id = $_GET["id"];

if ($action == "update") {
    $nama_kategori = $_POST["nama_kategori"];

    $sql = "UPDATE tbkategori SET nama_kategori = '$nama_kategori' WHERE id_kategori = $id";
    $result = $konek->query($sql);

    if ($result) {
        header("Location: kategori.php");
    } else {
        echo "Gagal update data";
    }
} else if ($action == "delete") {
    $sql = "DELETE FROM tbkategori WHERE id_kategori = $id";
    $result = $konek->query($sql);

    if ($result) {
        header("Location: kategori.php");
    } else {
        echo "Gagal delete data";
    }
} else if ($action == "insert") {
    $nama_kategori = $_POST["nama_kategori"];

    $sql = "INSERT INTO tbkategori (nama_kategori) VALUES ('$nama_kategori')";
    $result = $konek->query($sql);

    if ($result) {
        header("Location: kategori.php");
    } else {
        echo "Gagal insert data";
    }
}
