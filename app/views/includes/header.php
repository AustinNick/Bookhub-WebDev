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
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo"><img src="../../dist/img/library.png" alt="Logo" width="35"> BookHub</div>
        <div class="sidebar-section">
            <a href="index.php" class="active">Home</a>
            <a href="#">Favorite</a>
            <?php if (isset($_SESSION['username'])) { ?>
                <a href="../../actions/action_user.php?action=logout">Logout <i class="fa fa-sign-out"></i></a>
            <?php } ?>
        </div>
    </div>

    <div class="content">
        <?php if (function_exists('customPageHeader')) {
            customPageHeader();
        } ?>
    </div>
</body>

</html>