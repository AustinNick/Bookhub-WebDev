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
function deleteUser($userId) {
    global $conn;
    $sql = "DELETE FROM register WHERE id = $userId";
    if ($conn->query($sql) === TRUE) {
        echo "User with ID $userId has been deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

// Check if the userId parameter is provided in the URL
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    // Check if the user confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        deleteUser($userId);

        // Redirect back to the previous page if available, otherwise redirect to index.php
        $previousPage = $_SESSION['previous_page'] ?? 'user.php';
        header("Location: $previousPage");
        exit();
    } else {
        // Store the previous page URL in a session variable
        $_SESSION['user.php'] = $_SERVER['HTTP_REFERER'];

        // Display confirmation message
        echo "Are you sure you want to delete this user? <br>";
        echo "<a href='deleteUser.php?userId=$userId&confirm=yes'>Yes</a> | ";
        echo "<a href='{$_SESSION['user.php']}'>No</a>";
    }
}

// Close the database connection
$conn->close();
?>
