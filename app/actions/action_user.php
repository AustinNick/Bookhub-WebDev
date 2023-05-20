<?php
include "../config/config.php";
$action = isset($_GET['action']) ? $_GET['action'] : "";

if ($action == 'logout') {
    session_unset();
    session_destroy();
    header("Location: ../views/login.php");

    exit();
} else if ($action == 'login') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }
        $uname = validate($_POST['username']);
        $pass = validate($_POST['password']);

        if (empty($uname)) {
            header("Location: ../views/login.php?error=User Name is required");
            exit();
        } else if (empty($pass)) {
            header("Location: ../views/login.php?error=Password is required");
            exit();
        } else {
            $sql = "SELECT * FROM tbuser WHERE username='$uname' AND password='$pass'";
            $result = mysqli_query($konek, $sql);
            if (mysqli_num_rows($result) === 1) {
                session_start();
                $_SESSION['username'] = $uname;

                header("Location: ../views/index.php");
                exit();
            } else {
                header("Location: ../views/login.php?error=Incorrect User Name or Password");
                exit();
            }
        }
    } else {
        header("Location: ../views/index.php");
        exit();
    }
} else if ($action == 'register') {
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
            if (mysqli_query($konek, $sql)) {
                echo "Registrasi berhasil";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($konek);
            }
        }
    }
}
