  <?php
  $PageTitle = "Index";
  if (!isset($_SESSION['username'])) {
    header("Location: app/views/login.php");
  }
  include_once("includes/header.php");

  function customPageHeader()
  {
  ?>
    <link rel="stylesheet" href="dist/css/index.css">

    <!-- Content -->
    <div class="container">
      <!-- search bar and user profile beside -->
      <div class="search-bar">
        <form action="index.php" method="get">
          <input type="text" name="search" placeholder="Search for books">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>

      <!-- show username from session for logout -->
      <?php if (isset($_SESSION['username'])) { ?>
        <div class="user-profile">
          <a href="profile.php"><i class="fa fa-user"></i> <?= $_SESSION['username'] ?></a>
        </div>
      <?php } ?>

      <!-- kategori -->
      <div class="categories">
        <button>Sci-fi</button>
        <button>Horror</button>
        <button>Comedy</button>
        <button>Thriller</button>
        <button>Adventure</button>
        <button>Biography</button>
        <button>History</button>
        <button>Science</button>
        <button>Religion</button>
        <button>Politics</button>
        <button>Business</button>
        <button>Health</button>
        <button>Art</button>
        <button>Travel</button>
        <button>Children</button>
      </div>

    </div>

  <?php }
