<?php
session_start();

// Database connection settings
$host = 'localhost'; // Replace with your database host
$db = 'librarydb'; // Replace with your database name
$user = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create a database connection
$conn = new mysqli($host, $user, $password, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to handle the delete action
function deleteBuku($bukuId)
{
    global $conn;
    $sql = "DELETE FROM buku WHERE buku_id = $bukuId";
    if ($conn->query($sql) === TRUE) {
        echo "Book with ID $bukuId has been deleted successfully.";
    } else {
        echo "Error deleting book: " . $conn->error;
    }
}

// Check if the bukuId parameter is provided in the URL
if (isset($_GET['bukuId'])) {
    $bukuId = $_GET['bukuId'];

    // Check if the user confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        deleteBuku($bukuId);

        // Redirect back to the previous page if available, otherwise redirect to index.php
        $previousPage = $_SESSION['previous_page'] ?? 'index.php';
        header("Location: $previousPage");
        exit();
    } else {
        // Store the previous page URL in a session variable
        $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];

        // Display confirmation message
        echo "Are you sure you want to delete this book? <br>";
        echo "<a href='deleteBuku.php?bukuId=$bukuId&confirm=yes'>Yes</a> | ";
        echo "<a href='{$_SESSION['previous_page']}'>No</a>";
    }
}

// Close the database connection
$conn->close();
?>
