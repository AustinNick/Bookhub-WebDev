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

// Function to handle the delete action
function deleteUser($userId)
{
    global $conn;
    $sql = "DELETE FROM register WHERE id = $userId";
    if ($conn->query($sql) === TRUE) {
        $message = "User with ID $userId has been deleted successfully.";
        header("Location: user.php?message=" . urlencode($message));
        exit();
    } else {
        $error = "Error deleting user: " . $conn->error;
        header("Location: user.php?error=" . urlencode($error));
        exit();
    }
}

// Check if the userId parameter is provided in the URL
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    // Check if the user confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        deleteUser($userId);
    } else {
        // Store the previous page URL in a session variable
        $_SESSION['user.php'] = $_SERVER['HTTP_REFERER'];

        // Display confirmation message
        $message = "Are you sure you want to delete this user?";
        $confirmUrl = "deleteUser.php?userId=$userId&confirm=yes";
        $cancelUrl = $_SESSION['user.php'];
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Delete User</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    margin-top: 50px;
                }

                .message {
                    padding: 20px;
                    background-color: #f8f8f8;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    max-width: 400px;
                    margin: 0 auto;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                .message h2 {
                    margin-top: 0;
                }

                .message p {
                    margin-bottom: 20px;
                }

                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    font-size: 16px;
                    background-color: #4CAF50;
                    color: #fff;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    text-decoration: none;
                    margin-right: 10px;
                }

                .button.cancel {
                    background-color: #ccc;
                }
            </style>
        </head>

        <body>
            <div class="message">
                <h2>Delete User</h2>
                <p><?= $message ?></p>
                <a class="button" href="<?= $confirmUrl ?>">Yes</a>
                <a class="button cancel" href="<?= $cancelUrl ?>">No</a>
            </div>
        </body>

        </html>

        <?php
    }
}

// Close the database connection
$conn->close();
?>
