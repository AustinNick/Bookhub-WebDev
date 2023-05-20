<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= isset($PageTitle) ? $PageTitle : "Default Title" ?></title>
    <link rel="stylesheet" href="../../dist/css/style-header.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    }
    include_once("includes/header.php");
    ?>
    <!-- Sidebar -->

    <!-- <div class="sidebar">
        <div class="logo"><img src="../../dist/img/library.png" alt="Logo" width="35"> BookHub</div>
        <div class="sidebar-section">
            <a href="index.php" <?= ($PageTitle == "Index") ? "class='active'" : '' ?>>Home</a>
            <a href="favorite.php" <?= ($PageTitle == "Favorite") ? "class='active'" : '' ?>>Favorite</a>
        </div>
    </div> -->

    <div class="content">
        <?php if (function_exists('customPageHeader')) {
            customPageHeader();
        } ?>
    </div>

    <div class="footer">
        <p>BookHub &copy; 2021</p>
    </div>
</body>

</html>