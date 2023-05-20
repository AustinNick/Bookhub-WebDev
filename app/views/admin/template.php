<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($PageTitle) ? $PageTitle : "Default Title" ?></title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    }
    ?>

    <header class="header">
        <a href="admin.html" style="color: white;text-decoration: none;">
            <h1>Admin</h1>
        </a>
        <div>
            <span class="header__admin-name"><?= $_SESSION['username'] ?></span>
            <button class="header__logout-button">Logout</button>
        </div>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="user.php">User</a></li>
            <li><a href="buku.php">Buku</a></li>
            <li><a href="daftarBuku.php">Daftar Buku</a></li>
            <li><a href="rating.php">Rating</a></li>
            <li><a href="favorite.php">Favorite</a></li>
        </ul>
    </nav>

    <div class="content">
        <?php if (function_exists('customPageHeader')) {
            customPageHeader();
        } ?>
    </div>

    <footer class="footer">
        <p>&copy; 2023 Admin Page</p>
    </footer>
</body>

</html>