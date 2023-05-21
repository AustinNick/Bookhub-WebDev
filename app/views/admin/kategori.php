<?php
$PageTitle = "Table Kategori";
include_once("template.php");

function customPageHeader()
{
?>
    <table>
        <tr>
            <th>No</th>
            <th>Kategori ID</th>
            <th>Nama Kategori</th>
            <th colspan="2">Action</th>
            <th>
                <a href="tambah_kategori.php">+</a>
            </th>
        </tr>
        <?php
        // Database connection settings
        include_once("config/config.php");

        // Query to fetch data from the Rating table
        $sql = "SELECT * FROM tbkategori";
        $result = $konek->query($sql);

        // Check if any ratings are found
        if ($result->num_rows > 0) {
            // Output data of each row
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row["id_kategori"] ?></td>
                    <td><?= $row["nama_kategori"] ?></td>
                    <td>
                        <a href="edit_kategori.php?id=<?= $row["id_kategori"] ?>">Edit</a>
                    </td>
                    <td>
                        <a href="action_kategori.php?action=delete&id=<?= $row["id_kategori"] ?>">Delete</a>
                    </td>
                </tr>
        <?php
                $no++;
            }
        } else {
            echo "<tr><td colspan='4'><center>No ratings found!</center></td></tr>";
        }

        $konek = null;
        ?>
    </table>

<?php }
