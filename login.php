<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>
.form {
    flex: 1;
    max-width: 400px;
    margin-right: 100px;
    background-color: #fff;
    padding: 94px 30px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
}
.error{
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
        <div class="image"></div>
        <div class="form">
            <h2>Login</h2>

            <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <form action="loginn.php" method="post">
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
