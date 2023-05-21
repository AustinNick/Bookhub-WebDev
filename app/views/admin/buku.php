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
      width: 50%;
      margin: 0 auto;
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
      width: 100%;
      cursor: pointer;
      background-color: lightgreen;
      color: black;
      padding: 10px 20px;
      font-size: 20px;
      border: none;
      border-radius: 5px;
      transition: 0.2s ease;

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

    form input,
    form textarea,
    form select {
      width: 100%;
      padding: 7px 20px;
      border: 1px solid grey;
      border-radius: 10px;
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
    $image = $_FILES['image']['name'];

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO tbbuku (judul, penulis, kategori_id, sinopsis, jumlah_halaman, penerbit, tahun_terbit, image)
                VALUES ('$judul', '$penulis', '$kategori', '$sinopsis', '$jumlah_halaman', '$penerbit', '$tahun_terbit', '$image')";

    $result = mysqli_query($konek, $sql);

    move_uploaded_file($_FILES['image']['tmp_name'], "../../../dist/img/book/" . $_FILES['image']['name']);
    if ($result) {
      echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='daftarBuku.php';</script>";
    } else {
      echo "<script>alert('Data gagal ditambahkan');</script>";
    }
  }
  ?>
  <div class="container">
    <h2>Add Book</h2>
    <form method="POST" action="" enctype="multipart/form-data">
      <label for="judul">Judul:</label>
      <input type="text" name="judul" id="judul" required>

      <label for="penulis">Penulis:</label>
      <input type="text" name="penulis" id="penulis" required>

      <label for="kategori">Kategori:</label>
      <select name="kategori" id="kategori" required>
        <?php
        // Fetch all row = mysqli_fetch_array($re)
        $sql = "SELECT * FROM tbkategori";
        $result = mysqli_query($konek, $sql);

        while ($row = mysqli_fetch_array($result)) {
          echo "<option value='" . $row['id_kategori'] . "'>" . $row['nama_kategori'] . "</option>";
        }
        ?>
      </select>

      <label for="sinopsis">Sinopsis:</label>
      <textarea name="sinopsis" id="sinopsis" required></textarea>

      <label for="jumlah_halaman">Jumlah Halaman:</label>
      <input type="number" name="jumlah_halaman" id="jumlah_halaman" required>

      <label for="penerbit">Penerbit:</label>
      <input type="text" name="penerbit" id="penerbit" required>

      <label for="tahun_terbit">Tahun Terbit:</label>
      <input type="number" name="tahun_terbit" id="tahun_terbit" required>

      <label for="image">Image:</label>
      <input type="file" name="image" id="image" required>

      <input type="submit" value="Submit" class="button">

    </form>
  </div>
<?php }
