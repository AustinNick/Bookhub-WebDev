<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <link rel="stylesheet" href="../../../dist/css/style-admin.css">

  <style>
    /* style.css */
    table {
      border-collapse: collapse;
      margin-left: 50px;
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
    }

    .update-button:hover {
      background-color: yellow;
      color: black;
    }

    .delete-button:hover {
      background-color: red;
    }
  </style>
</head>

<body>
  <header class="header">
    <a href="admin.html" style="color: white;">
      <h1>Admin</h1>
    </a>
    <div>
      <span class="header__admin-name">John Doe</span>
      <button class="header__logout-button">Logout</button>
    </div>
  </header>

  <nav class="navbar">
    <ul>
      <li><a href="user.php">User</a></li>
      <li><a href="buku.php">Buku</a></li>
      <li><a href="#">Daftar Buku</a></li>
      <li><a href="rating.php">Rating</a></li>
      <li><a href="favorite.php">Favorite</a></li>
    </ul>
  </nav>

  <div class="content">
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

      // Query to fetch books from the buku table
      $sql = "SELECT * FROM tbbuku";
      $result = $konek->query($sql);

      // Check if any books are found
      if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
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

      // Close the database connection
      $konek->close();
      ?>
    </table>
  </div>

  <footer class="footer">
    <p>&copy; 2023 Admin Page</p>
  </footer>

</body>

</html>