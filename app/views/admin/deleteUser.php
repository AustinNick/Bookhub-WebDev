<?php
$PageTitle = "Table Rating";
include_once("template.php");

function customPageHeader()
{
    include_once("../../config/config.php");

    // Function to handle the delete action
    function deleteUser($userId)
    {
        global $konek;
        $sql = "DELETE FROM register WHERE id = $userId";
        if ($konek->query($sql) === TRUE) {
            $message = "User with ID $userId has been deleted successfully.";
            header("Location: user.php?message=" . urlencode($message));
            exit();
        } else {
            $error = "Error deleting user: " . $konek->error;
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

            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                }

                .message {
                    padding: 20px;
                    background-color: #f8f8f8;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    max-width: 400px;
                    margin: 10% auto;
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

            <div class="message">
                <h2>Delete User</h2>
                <p><?= $message ?></p>
                <a class="button" href="<?= $confirmUrl ?>">Yes</a>
                <a class="button cancel" href="<?= $cancelUrl ?>">No</a>
            </div>


<?php
        }
    }

    // Close the database connection
    $konek->close();
}
?>