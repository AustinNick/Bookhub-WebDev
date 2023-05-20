<?php
$PageTitle = "Table Rating";
include_once("template.php");

function customPageHeader()
{
?>
    <table>
        <tr>
            <th>Rating ID</th>
            <th>User ID</th>
            <th>Buku ID</th>
            <th>Nilai Rating</th>
        </tr>
        <?php
        // Database connection settings
        include_once("../../config/config.php");

        // Query to fetch data from the Rating table
        $sql = "SELECT rating_id, user_id, buku_id, nilai_rating FROM tbrating";
        $result = $konek->query($sql);

        // Check if any ratings are found
        if ($result->num_rows > 0) {
            echo "";
            echo "";

            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["rating_id"] . "</td>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["buku_id"] . "</td>";
                echo "<td>" . $row["nilai_rating"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'><center>No ratings found!</center></td></tr>";
        }

        $konek = null;
        ?>
    </table>

<?php }
