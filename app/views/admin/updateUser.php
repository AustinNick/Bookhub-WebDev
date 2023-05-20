<?php
session_start();

include_once("../../config/config.php");

// Function to handle the update action
function updateUser($userId, $username, $email)
{
    global $conn;
    $sql = "UPDATE register SET username = '$username', email = '$email' WHERE id = $userId";
    if ($conn->query($sql) === TRUE) {
        echo "User with ID $userId has been updated successfully.";
    } else {
        echo "Error updating user: " . $conn->error;
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
        updateUser($userId, $username, $email);

        // Redirect back to the previous page if available, otherwise redirect to index.php
        $previousPage = $_SESSION['previous_page'] ?? 'user.php';
        header("Location: $previousPage");
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

            // Display the update form
            echo "<form method='post'>";
            echo "<label for='username'>Username:</label>";
            echo "<input type='text' id='username' name='username' value='$username'><br>";
            echo "<label for='email'>Email:</label>";
            echo "<input type='email' id='email' name='email' value='$email'><br>";
            echo "<input type='submit' value='Update'>";
            echo "</form>";
        } else {
            echo "User not found.";
        }
    }
}

// Close the database connection
$conn->close();
