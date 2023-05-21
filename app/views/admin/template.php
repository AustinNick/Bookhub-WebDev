<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($PageTitle) ? $PageTitle : "Default Title" ?></title>
    <link rel="stylesheet" href="../../../dist/css/style-admin.css">

    <style>
        /* style.css */
        table {
            border-collapse: collapse;
            margin: 0 auto;
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

        .content {
            padding: 20px;
            font-size: 15px
        }
    </style>
    </style>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    }
    ?>

    <header class="header">
        <h1><a href="index.php" class="admin">Admin</a></h1>
        <div>
            <span class="header__admin-name"><?= $_SESSION['username'] ?></span>
            <a href="actions/action_user.php?action=logout"><button class="header__logout-button">Logout</button></a>
        </div>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="user.php" <?= ($PageTitle == "Table User") ? "class='active'" : '' ?>>User</a></li>
            <li><a href="buku.php" <?= ($PageTitle == "Buku") ? "class='active'" : '' ?>>Buku</a></li>
            <li><a href="kategori.php" <?= ($PageTitle == "Table Kategori") ? "class='active'" : '' ?>>Kategori</a></li>
            <li><a href="daftarBuku.php" <?= ($PageTitle == "Table Buku") ? "class='active'" : '' ?>>Daftar Buku</a></li>
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