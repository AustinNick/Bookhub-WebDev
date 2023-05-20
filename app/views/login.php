<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../../dist/css/style.css">
</head>

<body>
    <style>
        .error {
            border: 1px solid #f00;
            background-color: #ffecec;
            color: #f00;
            padding: 10px;
            margin-bottom: 10px;
            font-weight: bold;
            border-radius: 4px;
        }
    </style>
    <div class="form-container">
        <div class="image">
            <img src="../../dist/img/index.jpg">
        </div>
        <div class="form">
            <h2>Login</h2>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?= $_GET['error'] ?></p>
            <?php } ?>

            <form action="../actions/action_user.php?action=login" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <button type="submit">Login</button>
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </form>
        </div>
    </div>
</body>

</html>