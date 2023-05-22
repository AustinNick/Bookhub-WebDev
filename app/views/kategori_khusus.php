<?php
$PageTitle = "Favorite";
include_once("includes/header.php");
function customPageHeader()
{
?>

    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link rel="stylesheet" href="../../dist/css/index.css">
    <div class="container">
        <div id="nav" class="top-nav">
            <div class="logo">
                BookHub
            </div>
            <div class="search-bar">
                <!-- <form action="index.php" method="get"> -->
                <!-- <input type="text" name="search" placeholder="Search for books"> -->
                <!-- <span class="search-button"><i class="fa fa-search"></i></span> -->
                <!-- </form> -->
            </div>
            <div>
                <a href="favorite.php" id="hert"><i class="fa fa-heart"></i></a>
            </div>

            <div>
                <?php if (isset($_SESSION['username'])) { ?>
                    <div class="user-profile">
                        <div class="dropdown">
                            <span><i class="fa fa-user"></i> Welcome, <b><?= $_SESSION['username'] ?></b></span>
                            <div class="dropdown-content">
                                <p><a href="../actions/action_user.php?action=logout">Logout <i class="fa fa-sign-out-alt"></i></a></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <a href="index.php" class="back"><i class="fa fa-arrow-left"></i> Back</a>

        <div class="content-header">
            <?php
            include
                "../config/config.php";
            if (isset($_GET["id_buku"])) {
                $id_buku = $_GET["id_buku"];
                $query = "SELECT * FROM tbbuku LEFT JOIN tbkategori ON tbbuku.kategori_id = tbkategori.id_kategori WHERE buku_id = '$id_buku'";
            } else {
                $kategori = $_GET["kategori"];
                $query = "SELECT * FROM tbbuku LEFT JOIN tbkategori ON tbbuku.kategori_id = tbkategori.id_kategori WHERE nama_kategori = '$kategori' ORDER BY RAND() LIMIT 1";
            }
            $result = mysqli_query($konek, $query);
            if ($result->num_rows < 1) {
                echo "<div class='nulldata'><h1>No books yet!</h1></div>";
            } else {
                $row = mysqli_fetch_assoc($result);
            ?>
                <div class="penjelasan-buku">
                    <p class="genre"><?= $row['nama_kategori'] ?></p>
                    <p class="judul-buku"><?= $row['judul'] ?></p>
                    <p class="author">by <?= $row['penulis'] ?></p>
                    <p class="deskripsi"><?= $row['sinopsis'] ?></p>

                    <table class="wrap-detil">
                        <tr>
                            <td>Halaman</td>
                            <td>Tahun Terbit</td>
                            <td>Penerbit</td>
                        </tr>

                        <tr>
                            <td><?= $row['jumlah_halaman'] ?></td>
                            <td><?= $row['tahun_terbit'] ?></td>
                            <td><?= $row['penerbit'] ?></td>
                    </table>

                    <div>
                        <?php
                        $query2 = "SELECT * FROM tbfavorite WHERE buku_id = " . $row['buku_id'] . " AND user_id = " . $_SESSION['id'];
                        $result2 = mysqli_query($konek, $query2);
                        if ($result2->num_rows < 1) {
                        ?>
                            <a href="../actions/tambah_favorit.php?id=<?= $row['buku_id'] ?>">
                                <button class="button-header"><i class="fa fa-heart"></i> Add to Favorite</button>
                            </a>
                        <?php } else { ?>
                            <a href="../actions/tambah_favorit.php?id=<?= $row['buku_id'] ?>">
                                <button class="button-header favorited"><i class="fa fa-heart"></i> Favorited!</button>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="image">
                    <img src="../../dist/img/book/<?= $row['image'] ?>" alt="">
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="new-release">
        <div class="top-text-div">
            <p class="text-div">Kategori - <?= $kategori ?></p>
        </div>
        <div class="new-release-book-wrap">
            <?php
            $kategori = $_GET['kategori'];
            $sql = "SELECT * FROM tbbuku LEFT JOIN tbkategori ON tbbuku.kategori_id = tbkategori.id_kategori WHERE nama_kategori = '$kategori' ORDER BY tahun_terbit DESC";
            $result = mysqli_query($konek, $sql);
            if ($result->num_rows < 1) {
                echo "<p class='nobook-bwh'>No books yet!</p>";
            } else {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <div class="book">
                        <?php
                        if (isset($_SESSION['username'])) {
                            $id = $_SESSION['id'];
                            $id_buku = $row['buku_id'];
                            $sql = "SELECT * FROM tbfavorite WHERE user_id = '$id' AND buku_id = '$id_buku'";
                            $result2 = mysqli_query($konek, $sql);
                            $row2 = mysqli_fetch_array($result2);
                            if ($row2 > 0) {
                        ?>
                                <span class="favorite-mark"><i class="fa fa-heart"></i> Favorited!</span>
                        <?php }
                        } ?>
                        <img src="../../dist/img/book/<?= $row['image'] ?>" alt="">
                        <p class="judul-book"><a href="?kategori=<?= $kategori ?>&id_buku=<?= $row['buku_id'] ?>"><?= $row['judul'] ?></a></p>
                        <p class="genre-book"><?= $row['nama_kategori'] ?></p>
                    </div>
            <?php }
            } ?>
        </div>
    </div>

    <script>
        // untuk scroll navbar
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
                document.getElementById("nav").style.background = "white";
                document.getElementById("nav").style.color = "black";
                document.getElementById("hert").style.color = "black";
                document.getElementById("nav").style.transform = "translateY(0px)";
                document.getElementById("nav").style.boxShadow = "0 1px 10px black";
            } else {
                document.getElementById("nav").style.background = "transparent";
                document.getElementById("hert").style.color = "white";
                document.getElementById("nav").style.color = "white";
                document.getElementById("nav").style.transform = "translateY(-10px)";
                document.getElementById("nav").style.boxShadow = "none";
            }
        }
    </script>

<?php }
