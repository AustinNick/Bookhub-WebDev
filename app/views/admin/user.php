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
      <li><a href="#">User</a></li>
      <li><a href="buku.php">Buku</a></li>
      <li><a href="daftarBuku.php">Daftar Buku</a></li>
      <li><a href="rating.php">Rating</a></li>
      <li><a href="favorite.php">Favorite</a></li>
    </ul>
  </nav>

  <div class="content">
    <?php
    include_once("../../config/config.php");

    // Query to fetch users from the register table
    $sql = "SELECT * FROM tbuser";
    $result = $konek->query($sql);

    // Check if any users are found
    if ($result->num_rows > 0) {
      echo "<table>";
      echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Action</th></tr>";

      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>";
        echo "<a class='update-button' href='updateUser.php?userId=" . $row["user_id"] . "'>Update</a> ";
        echo "<a class='delete-button' href='deleteUser.php?userId=" . $row["user_id"] . "'>Delete</a>";
        echo "</td>";
        echo "</tr>";
      }

      echo "</table>";
    } else {
      echo "No users found.";
    }

    $konek->close();
    ?>


  </div>

  <footer class="footer">
    <p>&copy; 2023 Admin Page</p>
  </footer>

</body>

</html>