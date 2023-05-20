  <?php
  $PageTitle = "Index";
  include_once("includes/header.php");

  function customPageHeader()
  {
  ?>

    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link rel="stylesheet" href="../../dist/css/index.css">
    <div class="container">
      <div class="top-nav">
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
          <p class="genre">Fiction</p>
          <p class="judul-buku">Judul Buku</p>
          <p class="author">by Austin</p>

          <p class="deskripsi">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim vitae quas a, doloribus quos natus voluptatem at accusantium nesciunt mollitia illo corrupti ab quaerat consectetur aliquam reiciendis? Minus, odio quo?</p>

          <div>
            <button class="button-header"><i class="fa fa-heart"></i> Add to Favorite</button>
          </div>
        </div>
        <div class="image">
          <img src="../../dist/img/book/book.jpg" alt="">
        </div>
      </div>
    </div>

    <div class="new-release">
      <p class="text-div">New Release</p>
      <div class="new-release-book-wrap">
        <div class="book">
          <img src="../../dist/img/book/book.jpg" alt="">
          <p class="judul-book">Judul Buku</p>
          <p class="genre-book">Fiction</p>
        </div>

        <div class="book">
          <img src="../../dist/img/book/book.jpg" alt="">
          <p class="judul-book">Judul Buku</p>
          <p class="genre-book">Fiction</p>
        </div>

        <div class="book">
          <img src="../../dist/img/book/book.jpg" alt="">
          <p class="judul-book">Judul Buku</p>
          <p class="genre-book">Fiction</p>
        </div>

        <div class="book">
          <img src="../../dist/img/book/book.jpg" alt="">
          <p class="judul-book">Judul Buku</p>
          <p class="genre-book">Fiction</p>
        </div>

        <div class="book">
          <img src="../../dist/img/book/book.jpg" alt="">
          <p class="judul-book">Judul Buku</p>
          <p class="genre-book">Fiction</p>
        </div>

        <div class="book">
          <img src="../../dist/img/book/book.jpg" alt="">
          <p class="judul-book">Judul Buku</p>
          <p class="genre-book">Fiction</p>
        </div>
      </div>
    </div>

    <div></div>

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

    <script>
      const buttonRight = document.getElementById('slideRight');
      const buttonLeft = document.getElementById('slideLeft');

      buttonRight.onclick = function() {
        document.getElementById('categories').scrollLeft += 190;
      };
      buttonLeft.onclick = function() {
        document.getElementById('categories').scrollLeft -= 190;
      };
    </script>

  <?php }
