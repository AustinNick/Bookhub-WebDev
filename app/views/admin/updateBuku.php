<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            background-color: #f9f9f9;
            width: 50%;
            margin: 50px  auto;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
        }

        .form-input {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .form-textarea {
            width: 100%;
            height: 100px;
            padding: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .form-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            text-align: center;
            cursor: pointer;
        }

        .form-button:hover {
            background-color: #45a049;
        }

        .alert {
            padding: 10px;
            margin-bottom: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <?php
    session_start();

    $host = 'localhost';  // Replace with your database host
    $db = 'librarydb';   // Replace with your database name
    $user = 'root';  // Replace with your database username
    $password = '';  // Replace with your database password

    // Create a database connection
    $conn = new mysqli($host, $user, $password, $db);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to handle the update action
    function updateBuku($bukuId, $judul, $penulis, $kategori, $sinopsis, $jumlahHalaman, $penerbit, $tahunTerbit, $cover)
    {
        global $conn;
        $sql = "UPDATE buku SET judul = '$judul', penulis = '$penulis', kategori = '$kategori', sinopsis = '$sinopsis', jumlah_halaman = $jumlahHalaman, penerbit = '$penerbit', tahun_terbit = $tahunTerbit, cover = '$cover' WHERE buku_id = $bukuId";
        if ($conn->query($sql) === TRUE) {
            $message = "Book with ID $bukuId has been updated successfully.";
            echo "<div class='alert alert-success'>$message</div>";
        } else {
            $errorMessage = "Error updating book: " . $conn->error;
            echo "<div class='alert alert-error'>$errorMessage</div>";
        }
    }

    // Check if the bukuId parameter is provided in the URL
    if (isset($_GET['bukuId'])) {
        $bukuId = $_GET['bukuId'];

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the updated book details from the form
            $judul = $_POST['judul'];
            $penulis = $_POST['penulis'];
            $kategori = $_POST['kategori'];
            $sinopsis = $_POST['sinopsis'];
            $jumlahHalaman = $_POST['jumlah_halaman'];
            $penerbit = $_POST['penerbit'];
            $tahunTerbit = $_POST['tahun_terbit'];
            $cover = $_POST['cover'];

            // Update the book
            updateBuku($bukuId, $judul, $penulis, $kategori, $sinopsis, $jumlahHalaman, $penerbit, $tahunTerbit, $cover);

            // Redirect back to the previous page if available, otherwise redirect to index.php
            $previousPage = $_SESSION['previous_page'] ?? 'daftarBuku.php';
            header("Location: $previousPage");
            exit();
        } else {
            // Retrieve the book details from the database
            $sql = "SELECT * FROM buku WHERE buku_id = $bukuId";
            $result = $conn->query($sql);

            // Check if the book exists
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $judul = $row['judul'];
                $penulis = $row['penulis'];
                $kategori = $row['kategori'];
                $sinopsis = $row['sinopsis'];
                $jumlahHalaman = $row['jumlah_halaman'];
                $penerbit = $row['penerbit'];
                $tahunTerbit = $row['tahun_terbit'];
                $cover = $row['cover'];

                // Store the previous page URL in a session variable
                $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];

                // Display the update form
                ?>
                <form method="post">
                    <label for="judul">Judul:</label>
                    <input type="text" class="form-input" id="judul" name="judul" value="<?php echo $judul; ?>" placeholder="Judul" required><br>
                    <label for="penulis">Penulis:</label>
                    <input type="text" class="form-input" id="penulis" name="penulis" value="<?php echo $penulis; ?>" placeholder="Penulis" required><br>
                    <label for="kategori">Kategori:</label>
                    <input type="text" class="form-input" id="kategori" name="kategori" value="<?php echo $kategori; ?>" placeholder="Kategori" required><br>
                    <label for="sinopsis">Sinopsis:</label>
                    <textarea class="form-input" id="sinopsis" name="sinopsis" placeholder="Sinopsis" required><?php echo $sinopsis; ?></textarea><br>
                    <label for="jumlah_halaman">Jumlah Halaman:</label>
                    <input type="number" class="form-input" id="jumlah_halaman" name="jumlah_halaman" value="<?php echo $jumlahHalaman; ?>" placeholder="Jumlah Halaman" required><br>
                    <label for="penerbit">Penerbit:</label>
                    <input type="text" class="form-input" id="penerbit" name="penerbit" value="<?php echo $penerbit; ?>" placeholder="Penerbit" required><br>
                    <label for="tahun_terbit">Tahun Terbit:</label>
                    <input type="number" class="form-input" id="tahun_terbit" name="tahun_terbit" value="<?php echo $tahunTerbit; ?>" placeholder="Tahun Terbit" required><br>
                    <label for="cover">Cover:</label>
                    <input type="text" class="form-input" id="cover" name="cover" value="<?php echo $cover; ?>" placeholder="Cover" required><br>
                    <input type="submit" class="form-button" value="Update">
                </form>
                <?php
            } else {
                $errorMessage = "Book not found.";
                echo "<div class='alert alert-error'>$errorMessage</div>";
            }
        }
    }

    // Close the database connection
    $conn->close();
    ?>
</body>

</html>
