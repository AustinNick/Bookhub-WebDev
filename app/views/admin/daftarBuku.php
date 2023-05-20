<?php
$PageTitle = "Table Buku";
include_once("template.php");

function customPageHeader()
{
?>
  <style>
    * {
      margin: 0;
      padding: 0;
    }

    .pagination {
      text-align: center;
      margin-top: 10px;
    }

    .pagination a {
      padding: 3px 8px;
      border: 1px solid #000;
      text-decoration: none;
      margin-bottom: 30px;
      color: black;
    }

    .pagination a.active {
      background-color: #4CAF50;
      color: white;
    }

    .pagination a:hover:not(.active) {
      background-color: #ddd;
    }

    .pagination a:first-child {
      border-top-left-radius: 5px;
      border-bottom-left-radius: 5px;
    }

    .pagination a:last-child {
      border-top-right-radius: 5px;
      border-bottom-right-radius: 5px;
    }

    .pagination a.active {
      background-color: #4CAF50;
      color: white;
      border: 1px solid #4CAF50;
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
