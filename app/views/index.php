  <?php
  $PageTitle = "Index";
  include_once("includes/header.php");
  function customPageHeader()
  {
  ?>

    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link rel="stylesheet" href="../../dist/css/index.css">
    <div class="container">
      <div id="nav" class="top-nav">
        <div class="logo">
          BookHub
        </div>
        <div class="search-bar">
          <form action="index.php" method="get">
            <!-- <input type="text" name="search" placeholder="Search for books"> -->
            <span class="search-button"><i class="fa fa-search"></i></span>
          </form>
        </div>
        <div>
          <span class="search-button"><i class="fa fa-heart"></i></span>
        </div>

        <div>
          <?php if (isset($_SESSION['username'])) { ?>
            <div class="user-profile">
              <div class="dropdown">
                <span><i class="fa fa-user"></i> Welcome, <b><?= $_SESSION['username'] ?></b></span>
                <div class="dropdown-content">
                  <p><a href="../actions/action_user.php?action=logout">Logout <i class="fa fa-sign-out-alt"></i></a></p>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>

      <div class="content-header">
        <div class="penjelasan-buku">
          <?php
          include
            "../config/config.php";

          $query = "SELECT * FROM tbbuku ORDER BY RAND() LIMIT 1";
          $result = mysqli_query($konek, $query);
          $row = mysqli_fetch_assoc($result);
          ?>
          <p class="genre"><?= $row['kategori'] ?></p>
          <p class="judul-buku"><?= $row['judul'] ?></p>
          <p class="author"><?= $row['penulis'] ?></p>

          <p class="deskripsi"><?= $row['sinopsis'] ?></p>

          <div>
            <a href="favorite.php?action=add&id=<?= $row['buku_id'] ?>">
              <button class="button-header"><i class="fa fa-heart"></i> Add to Favorite</button>
            </a>
          </div>
        </div>
        <div class="image">
          <img src="../../dist/img/book/<?= $row['image'] ?>" alt="">
        </div>
      </div>
    </div>

    <!-- kategori -->
    <div class="categories">
      <div class="top-text-div">
        <p class="text-div">Kategori</p>
        <a href=""><i class="fa fa-plus"></i> View All</a>
      </div>

      <div class="wrapp">
        <div>
          <button id="slideLeft"><i class="fa fa-arrow-left"></i></button>
        </div>
        <div id="categories" class="categories-place">
          <div>Sci-fi</div>
          <div>Horror</div>
          <div>Comedy</div>
          <div>Thriller</div>
          <div>Adventure</div>
          <div>Biography</div>
          <div>History</div>
          <div>Science</div>
          <div>Science</div>
          <div>Science</div>
          <div>Science</div>
        </div>
        <div>
          <button id="slideRight"> <i class="fa fa-arrow-right"></i> </button>
        </div>
      </div>
    </div>

    <div class="new-release">
      <div class="top-text-div">
        <p class="text-div">New Release</p>
        <a href=""><i class="fa fa-plus"></i> View All</a>
      </div>
      <div class="new-release-book-wrap">
        <?php
        $sql = "SELECT * FROM tbbuku ORDER BY tahun_terbit DESC LIMIT 6";
        $result = mysqli_query($konek, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <div class="book">
            <img src="../../dist/img/book/<?= $row['image'] ?>" alt="">
            <p class="judul-book"><?= $row['judul'] ?></p>
            <p class="genre-book"><?= $row['kategori'] ?></p>
          </div>
        <?php } ?>
      </div>
    </div>

    <script>
      // untuk categori
      const buttonRight = document.getElementById('slideRight');
      const buttonLeft = document.getElementById('slideLeft');

      buttonRight.onclick = function() {
        document.getElementById('categories').scrollLeft += 190;
      };
      buttonLeft.onclick = function() {
        document.getElementById('categories').scrollLeft -= 190;
      };

      // untuk scroll navbar
      window.onscroll = function() {
        scrollFunction()
      };

      function scrollFunction() {
        if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
          document.getElementById("nav").style.background = "white";
          document.getElementById("nav").style.color = "black";
          document.getElementById("nav").style.transform = "translateY(0px)";
          // document.getElementById("nav").style.padding = "30px 0";
          // document.getElementById("logo").style.fontSize = "25px";
        } else {
          document.getElementById("nav").style.background = "transparent";
          document.getElementById("nav").style.color = "white";
          document.getElementById("nav").style.transform = "translateY(-10px)";
          // document.getElementById("nav").style.padding = "40px 0";
          // document.getElementById("logo").style.fontSize = "35px";
        }
      }
    </script>

  <?php }
