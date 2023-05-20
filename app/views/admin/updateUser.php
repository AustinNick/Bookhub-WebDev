<?php
session_start();

$host = 'localhost';  // Replace with your database host
$db = 'register_library';   // Replace with your database name
$user = 'root';  // Replace with your database username
$password = '';  // Replace with your database password

// Create a database connection
$conn = new mysqli($host, $user, $password, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to handle the update action
function updateUser($userId, $username, $email) {
    global $conn;
    $sql = "UPDATE register SET username = '$username', email = '$email' WHERE id = $userId";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Check if the userId parameter is provided in the URL
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the updated username and email from the form
        $username = $_POST['username'];
        $email = $_POST['email'];

        // Update the user
        $result = updateUser($userId, $username, $email);

        if ($result) {
            $message = "User with ID $userId has been updated successfully.";
        } else {
            $message = "Error updating user: " . $conn->error;
        }

        // Redirect back to the previous page if available, otherwise redirect to index.php
        $previousPage = $_SESSION['previous_page'] ?? 'user.php';
        header("Location: $previousPage?message=" . urlencode($message));
        exit();
    } else {
        // Retrieve the user details from the database
        $sql = "SELECT * FROM register WHERE id = $userId";
        $result = $conn->query($sql);

        // Check if the user exists
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $email = $row['email'];

            // Store the previous page URL in a session variable
            $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];
        } else {
            echo "User not found.";
            exit();
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            background-color: #f9f9f9;
        }

        .message {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .message h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .message p {
            margin-bottom: 30px;
            font-size: 16px;
            color: #555;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: yellow;
            color: #000;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: white;
            color: black;
        }
    </style>
</head>

<body>
    <div class="message">
        <?php if (isset($message)) : ?>
            <h2>Update Status</h2>
            <p><?php echo $message; ?></p>
            <a class="button" href="<?php echo $_SESSION['previous_page']; ?>">Go Back</a>
        <?php else : ?>
            <h2>Update User</h2>
            <form method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $username; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                </div>
                <input class="button" type="submit" value="Update">
            </form>
        <?php endif; ?>
    </div>
</body>

</html>
