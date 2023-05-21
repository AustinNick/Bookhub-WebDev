<?php
$PageTitle = "Edit Kategori";
include_once("template.php");

function customPageHeader()
{
    $id = $_GET["id"];
    include_once("config/config.php");
    $sql = "SELECT * FROM tbkategori WHERE id_kategori = $id";
    $result = $konek->query($sql);
    $row = mysqli_fetch_assoc($result);
?>

    <form method="post" action="action_kategori.php?action=update&id=<?= $id ?>">
        <table>
            <tr>
                <td>Nama Kategori</td>
                <td><input type="text" name="nama_kategori" value="<?= $row["nama_kategori"] ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Update"></td>
            </tr>
        </table>
    </form>

<?php }
