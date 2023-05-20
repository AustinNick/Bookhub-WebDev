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
      <li><a href="daftarBuku.php">Daftar Buku</a></li>
      <li><a href="#">Rating</a></li>
      <li><a href="favorite.php">Favorite</a></li>
    </ul>
  </nav>

  <div class="content">
    <?php
    // Database connection settings
    include_once("../../config/config.php");

    // Query to fetch data from the Rating table
    $sql = "SELECT rating_id, user_id, buku_id, nilai_rating FROM tbrating";
    $result = $konek->query($sql);

    // Check if any ratings are found
    if ($result->num_rows > 0) {
      echo "<table>";
      echo "<tr><th>Rating ID</th><th>User ID</th><th>Buku ID</th><th>Nilai Rating</th></tr>";

      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["rating_id"] . "</td>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["buku_id"] . "</td>";
        echo "<td>" . $row["nilai_rating"] . "</td>";
        echo "</tr>";
      }

      echo "</table>";
    } else {
      echo "<tr><td colspan='4'>No rating found.</td></tr>";
    }

    // Close the database connection
    $konek = null;
    ?>

  </div>

  <footer class="footer">
    <p>&copy; 2023 Admin Page</p>
  </footer>

</body>

</html>