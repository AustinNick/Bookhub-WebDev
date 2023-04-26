<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'register_library';
$conn = mysqli_connect($host, $user, $password, $dbname);

// cek koneksi
if (mysqli_connect_errno()) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

// Menghandle form registrasi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];

    // Memeriksa kesamaan password
    if ($password != $confirm_password) {
        echo "Konfirmasi password tidak sesuai";
    } else {
        // Menyimpan data ke dalam tabel pelanggan
        $sql = "INSERT INTO register (username, email, password, confirm_password) VALUES ('$username', '$email', '$password',
        '$confirm_password')";
        if (mysqli_query($conn, $sql)) {
            echo "Registrasi berhasil";
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .form {
        flex: 1;
        max-width: 400px;
        margin-right: 100px;
        background-color: #fff;
        padding: 16px 30px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
    }
        </style>
<body>
    <div class="form-container">
        <div class="image"></div>
        <div class="form">
            <h2>Register</h2>
            <form method="post">
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
