<?php
$PageTitle = "Buku";
include_once("template.php");

function customPageHeader()
{
?>
  <style>
    /* style.css */
    table {
      border-collapse: collapse;
      margin-left: 100px;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 8px 30px;
    }

    a {
      text-decoration: none;
    }

    .container {
      width: 300px;
      margin-left: 700px;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    h2 {
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    .button {
      margin-top: 10px;
      display: block;
      background-color: lightgreen;
      color: black;
      padding: 5px 10px;
      border: none;
      border-radius: 3px;
    }

    .button:hover {
      color: white;
      background-color: black;
    }

    .content {
      margin: 0px 0 0 200px;
      padding: 30px;
      font-size: 30px;
    }
  </style>
  <?php
  // Database connection details
  include_once("../../config/config.php");


  // Check if the form was submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $kategori = $_POST['kategori'];
    $sinopsis = $_POST['sinopsis'];
    $jumlah_halaman = $_POST['jumlah_halaman'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $cover = $_POST['cover'];

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO buku (judul, penulis, kategori, sinopsis, jumlah_halaman, penerbit, tahun_terbit, cover)
                VALUES (:judul, :penulis, :kategori, :sinopsis, :jumlah_halaman, :penerbit, :tahun_terbit, :cover)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':judul', $judul);
    $stmt->bindParam(':penulis', $penulis);
    $stmt->bindParam(':kategori', $kategori);
    $stmt->bindParam(':sinopsis', $sinopsis);
    $stmt->bindParam(':jumlah_halaman', $jumlah_halaman);
    $stmt->bindParam(':penerbit', $penerbit);
    $stmt->bindParam(':tahun_terbit', $tahun_terbit);
    $stmt->bindParam(':cover', $cover);

    if ($stmt->execute()) {
      // Data inserted successfully
      echo "Data inserted successfully.";
    } else {
      // Error occurred
      echo "Error: " . $stmt->errorInfo()[2];
    }
  }
  ?>
  <div class="container">
    <h2>Add Book</h2>
    <form method="POST" action="">
      <label for="judul">Judul:</label>
      <input type="text" name="judul" id="judul" required>

      <label for="penulis">Penulis:</label>
      <input type="text" name="penulis" id="penulis" required>

      <label for="kategori">Kategori:</label>
      <input type="text" name="kategori" id="kategori" required>

      <label for="sinopsis">Sinopsis:</label>
      <textarea name="sinopsis" id="sinopsis" required></textarea>

      <label for="jumlah_halaman">Jumlah Halaman:</label>
      <input type="number" name="jumlah_halaman" id="jumlah_halaman" required>

      <label for="penerbit">Penerbit:</label>
      <input type="text" name="penerbit" id="penerbit" required>

      <label for="tahun_terbit">Tahun Terbit:</label>
      <input type="number" name="tahun_terbit" id="tahun_terbit" required>

      <label for="cover">Cover:</label>
      <input type="text" name="cover" id="cover" required>

      <input type="submit" value="Submit" class="button">

    </form>
  </div>
<?php }
