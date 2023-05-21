<?php
$PageTitle = "Table User";
include_once("template.php");

function customPageHeader()
{
?>
  <?php
  include_once("../../config/config.php");

  // Query to fetch users from the register table
  $sql = "SELECT * FROM tbuser";
  $result = $konek->query($sql);

  // Check if any users are found
  if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["user_id"] . "</td>";
      echo "<td>" . $row["username"] . "</td>";
      echo "<td>" . $row["email"] . "</td>";
      // echo "<td>";
      // echo "<a class='update-button' href='updateUser.php?userId=" . $row["user_id"] . "'>Update</a> ";
      // echo "<a class='delete-button' href='deleteUser.php?userId=" . $row["user_id"] . "'>Delete</a>";
      // echo "</td>";
      echo "</tr>";
    }

    echo "</table>";
  } else {
    echo "No users found.";
  }

  $konek->close();
  ?>
<?php }
