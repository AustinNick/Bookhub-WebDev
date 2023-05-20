<?php
$PageTitle = "Table Buku";
include_once("template.php");

function customPageHeader()
{
?>
  <style>
    /* style.css */
    table {
      border-collapse: collapse;
      margin: 0 auto;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 8px 8px;
    }

    a {
      text-decoration: none;
    }

    .update-button,
    .delete-button {
      display: inline-block;
      padding: 5px 10px;
      background-color: gray;
      color: white;
      border: none;
      border-radius: 3px;
      transition: box-shadow 0.3s ease;
    }

    .update-button:hover,
    .delete-button:hover {
      box-shadow: 0 0 5px 5px rgba(0, 0, 0, 0.5);
    }

    .update-button {
      background-color: yellow;
      color: black;
    }

    .delete-button {
      background-color: red;
      color: white;
    }

    .content {
      padding: 20px;
      font-size: 15px
    }

    .pagination {
      margin: 10px 0;
      text-align: center;
    }
  </style>
  <table>
    <tr>
      <th>ID</th>
      <th>Judul</th>
      <th>Penulis</th>
      <th>Kategori</th>
      <th>Sinopsis</th>
      <th>Jumlah Halaman</th>
      <th>Penerbit</th>
      <th>Tahun Terbit</th>
      <th>Cover</th>
      <th>Action</th>
    </tr>
    <?php
    // Database connection settings
    include_once("../../config/config.php");

    $batas = 5;
    $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
    $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

    $previous = $halaman - 1;
    $next = $halaman + 1;

    // Query to fetch books from the buku table
    $sql = "SELECT * FROM tbbuku";
    $sql2 = "SELECT * FROM tbbuku LIMIT $halaman_awal, $batas";
    $result = $konek->query($sql);
    $result2 = $konek->query($sql2);

    $jumlah_data = mysqli_num_rows($result);
    $total_halaman = ceil($jumlah_data / $batas);
    $nomor = $halaman_awal + 1;

    // Check if any books are found
    if ($result2->num_rows > 0) {
      // Output data of each row
      while ($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["buku_id"] . "</td>";
        echo "<td>" . $row["judul"] . "</td>";
        echo "<td>" . $row["penulis"] . "</td>";
        echo "<td>" . $row["kategori"] . "</td>";
        echo "<td>" . $row["sinopsis"] . "</td>";
        echo "<td>" . $row["jumlah_halaman"] . "</td>";
        echo "<td>" . $row["penerbit"] . "</td>";
        echo "<td>" . $row["tahun_terbit"] . "</td>";
        echo "<td>" . $row["image"] . "</td>";
        echo "<td>";
        echo "<a class='update-button' href='updateBuku.php?bukuId=" . $row["buku_id"] . "'>Update</a> ";
        echo "<a class='delete-button' href='deleteBuku.php?bukuId=" . $row["buku_id"] . "'>Delete</a>";
        echo "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='10'>No book found.</td></tr>";
    }
    ?>
  </table>

  <div class="pagination">
    <a class="page-link" <?= ($halaman > 1) ? "href='?halaman=$previous'" : '' ?>>Previous</a>
    <?php
    for ($x = 1; $x <= $total_halaman; $x++) {
      if ($halaman == $x) {
    ?>
        <a class="page-link"><?= $x; ?></a></li>
      <?php } else { ?>
        <a class="page-link" href="?halaman=<?= $x ?>"><?= $x; ?></a></li>
      <?php } ?>
    <?php } ?>
    <a class="page-link" <?= ($halaman < $total_halaman) ? "href='?halaman=$next'" : 'aa' ?>>Next</a>

    <p>Total data = <?= $jumlah_data; ?></p>
  </div>
<?php }
