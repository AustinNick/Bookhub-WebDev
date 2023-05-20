<?php
session_start();

$PageTitle = "Table Rating";
include_once("template.php");

function customPageHeader()
{
?>
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
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .buttonx {
            display: inline-block;
            padding: 10px 20px;
            background-color: white;
            color: black;
            text-decoration: none;
            border-radius: 4px;
            border: 1px black solid;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>

    <?php
    include_once("../../config/config.php");

    // Function to handle the delete action
    function deleteBuku($bukuId)
    {
        global $konek;
        $sql = "DELETE FROM buku WHERE buku_id = $bukuId";
        if ($konek->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Check if the bukuId parameter is provided in the URL
    if (isset($_GET['bukuId'])) {
        $bukuId = $_GET['bukuId'];

        // Check if the user confirmed the deletion
        if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
            $result = deleteBuku($bukuId);

            if ($result) {
                $message = "Book with ID $bukuId has been deleted successfully.";
            } else {
                $message = "Error deleting book: " . $konek->error;
            }

            // Redirect back to the previous page if available, otherwise redirect to index.php
            $previousPage = $_SESSION['previous_page'] ?? 'index.php';
            header("Location: $previousPage?message=" . urlencode($message));
            exit();
        } else {
            // Store the previous page URL in a session variable
            $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];
        }
    }

    // Close the database connection
    $konek->close();
    ?>

    <div class="message">
        <?php if (isset($message)) : ?>
            <h2>Delete Book</h2>
            <p><?= $message ?></p>
        <?php else : ?>
            <h2>Delete Confirmation</h2>
            <p>Are you sure you want to delete this book?</p>
            <a class="button" href="deleteBuku.php?bukuId=<?= $bukuId ?>&confirm=yes">Yes</a>
            <a class="buttonx" href="<?= $_SESSION['previous_page'] ?>">No</a>
        <?php endif; ?>
    </div>
<?php }
