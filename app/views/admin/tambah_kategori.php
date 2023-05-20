<?php
$PageTitle = "Tambah Kategori";
include_once("template.php");

function customPageHeader()
{
?>

    <form method="post" action="action_kategori.php?action=insert">
        <table>
            <tr>
                <td>Nama Kategori</td>
                <td><input type="text" name="nama_kategori"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Insert"></td>
            </tr>
        </table>
    </form>

<?php }
