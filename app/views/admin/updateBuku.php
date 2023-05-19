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
function updateBuku($bukuId, $judul, $penulis, $kategori, $sinopsis, $jumlahHalaman, $penerbit, $tahunTerbit, $cover) {
    global $conn;
    $sql = "UPDATE buku SET judul = '$judul', penulis = '$penulis', kategori = '$kategori', sinopsis = '$sinopsis', jumlah_halaman = $jumlahHalaman, penerbit = '$penerbit', tahun_terbit = $tahunTerbit, cover = '$cover' WHERE buku_id = $bukuId";
    if ($conn->query($sql) === TRUE) {
        echo "Book with ID $bukuId has been updated successfully.";
    } else {
        echo "Error updating book: " . $conn->error;
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
            echo "<form method='post'>";
            echo "<label for='judul'>Judul:</label>";
            echo "<input type='text' id='judul' name='judul' value='$judul'><br>";
            echo "<label for='penulis'>Penulis:</label>";
            echo "<input type='text' id='penulis' name='penulis' value='$penulis'><br>";
            echo "<label for='kategori'>Kategori:</label>";
            echo "<input type='text' id='kategori' name='kategori' value='$kategori'><br>";
            echo "<label for='sinopsis'>Sinopsis:</label>";
            echo "<textarea id='sinopsis' name='sinopsis'>$sinopsis</textarea><br>";
            echo "<label for='jumlah_halaman'>Jumlah Halaman:</label>";
            echo "<input type='number' id='jumlah_halaman' name='jumlah_halaman' value='$jumlahHalaman'><br>";
            echo "<label for='penerbit'>Penerbit:</label>";
            echo "<input type='text' id='penerbit' name='penerbit' value='$penerbit'><br>";
            echo "<label for='tahun_terbit'>Tahun Terbit:</label>";
            echo "<input type='number' id='tahun_terbit' name='tahun_terbit' value='$tahunTerbit'><br>";
            echo "<label for='cover'>Cover:</label>";
            echo "<input type='text' id='cover' name='cover' value='$cover'><br>";
            echo "<input type='submit' value='Update'>";
            echo "</form>";
   
        } else {
            echo "Book not found.";
        }
    }
}

// Close the database connection
$conn->close();
?>
