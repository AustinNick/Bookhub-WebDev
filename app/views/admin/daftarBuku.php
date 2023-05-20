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

        th, td {
        border: 1px solid #000;
        padding: 8px 8px;
        }

        a{
        text-decoration: none;
        }

        .update-button, .delete-button {
        display: inline-block;
        padding: 5px 10px;
        background-color: gray;
        color: white;
        border: none;
        border-radius: 3px;
        transition: box-shadow 0.3s ease;
        }

        .update-button:hover,
        .delete-button:hover{
          box-shadow: 0 0 5px 5px rgba(0, 0, 0, 0.5);
        }
        
        .update-button{
          background-color: yellow;
          color: black;
        }

        .delete-button{
          background-color: red;
          color: white;
        }

        .content {
          margin: 50px 0 0 350px;
          padding: 20px;
          font-size: 15px
        }
  </style>
</head>

<body>
  <header class="header">
  <a href="admin.html" style="color: white;" ><h1>Admin</h1></a>
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
        <?php
        // Database connection settings
        $host = 'localhost'; // Replace with your database host
        $db = 'librarydb'; // Replace with your database name
        $user = 'root'; // Replace with your database username
        $password = ''; // Replace with your database password

        // Create a database connection
        $conn = new mysqli($host, $user, $password, $db);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to fetch books from the buku table
        $sql = "SELECT * FROM buku";
        $result = $conn->query($sql);

        // Check if any books are found
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Judul</th><th>Penulis</th><th>Kategori</th><th>Sinopsis</th><th>Jumlah Halaman</th><th>Penerbit</th><th>Tahun Terbit</th><th>Cover</th><th>Action</th></tr>";

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
            echo "<td>" . $row["cover"] . "</td>";
            echo "<td>";
            echo "<a class='update-button' href='updateBuku.php?bukuId=" . $row["buku_id"] . "'>Update</a> ";
            echo "<a class='delete-button' href='deleteBuku.php?bukuId=" . $row["buku_id"] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No books found.";
        }

        // Close the database connection
        $conn->close();
        ?>

  </div>

  <footer class="footer">
    <p>&copy; 2023 Admin Page</p>
  </footer>

</body>

</html>