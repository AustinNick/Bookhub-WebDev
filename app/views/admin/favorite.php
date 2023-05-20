<?php
$PageTitle = "Index";
include_once("template.php");

function customPageHeader()
{
?>
  <style>
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
  </style>
  <link rel="stylesheet" href="../../../dist/css/style-admin.css">
  <table>
    <tr>
      <th>Favorite ID</th>
      <th>User ID</th>
      <th>Buku ID</th>
    </tr>

    <!-- Content Here -->
    <?php
    // Database connection settings
    include_once("../../config/config.php");

    // Query to fetch data from the Favorite table
    $sql = "SELECT * FROM tbfavorite";
    $result = $konek->query($sql);

    // Check if any favorites are found
    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["favorite_id"] . "</td>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["buku_id"] . "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='3'>No favorites found.</td></tr>";
    }

    // Close the database connection
    $konek->close();
    ?>
  </table>
<?php }
