<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="../../dist/css/style.css">
</head>
<style>
    .form {
        flex: 1;
        max-width: 400px;
        margin-right: 100px;
        background-color: #fff;
        padding: 28px 30px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
    }
</style>

<body>
    <div class="form-container">
        <div class="image">
            <img src="../../dist/img/index.jpg">
        </div>
        <div class="form">
            <h2>Register</h2>
            <form method="post" action="../actions/action_user.php?action=register">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>

                <button type="submit">Register</button>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</body>

</html>