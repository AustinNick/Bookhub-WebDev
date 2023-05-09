<?php
include "../config/config.php";
$action = isset($_GET['action']) ? $_GET['action'] : "";

if ($action == 'logout') {
    session_unset();
    session_destroy();
    header("Location: index.php");

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
            header("Location: login.php?error=User Name is required");
            exit();
        } else if (empty($pass)) {
            header("Location: login.php?error=Password is required");
            exit();
        } else {
            $sql = "SELECT * FROM register WHERE username='$uname' AND password='$pass'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);

                if ($row['username'] === $uname && $row['password'] === $pass) {
                    echo "Logged in!";
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];

                    header("Location: indexx.php");
                    exit();
                } else {
                    header("Location: login.php?error=Incorect User name or password");
                    exit();
                }
            } else {
                header("Location: login.php?error=Incorect User name or password");
                exit();
            }
        }
    } else {
        header("Location: indexx.php");
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
            if (mysqli_query($conn, $sql)) {
                echo "Registrasi berhasil";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}
