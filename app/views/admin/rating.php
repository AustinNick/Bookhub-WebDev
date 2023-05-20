<?php
$PageTitle = "Table Rating";
include_once("template.php");

function customPageHeader()
{
?>
    <?php
    // Database connection settings
    include_once("../../config/config.php");

        // Query to fetch data from the Rating table
        $sql = "SELECT rating_id, user_id, buku_id, nilai_rating FROM Rating";
        $result = $conn->query($sql);

        // Check if any ratings are found
        if ($result->rowCount() > 0) {
            echo "<table>";
            echo "<tr><th>Rating ID</th><th>User ID</th><th>Buku ID</th><th>Nilai Rating</th></tr>";

            // Output data of each row
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["rating_id"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["buku_id"] . "</td>";
            echo "<td>" . $row["nilai_rating"] . "</td>";
            echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No ratings found.";
        }
        
        $conn = null;
        ?>

<?php }
