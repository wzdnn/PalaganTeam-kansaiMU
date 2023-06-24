<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Muhammadiyah Kansai</title>
    <!-- LINK Start-->
    <link rel="stylesheet" href="<?= ROOT?>/css/aos.css" />
    <link rel="stylesheet" href="<?= ROOT?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= ROOT?>/css/line-awesome.min.css" />
    <link rel="stylesheet" href="<?= ROOT?>/css/style.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" /> -->
    <!-- LINK END -->
  </head>
  <body>
    <!-- NavBar Start -->
    <nav class="navbar navbar-expand-lg shadow-sm fixed-top relative">
      <div class="container">
        <a class="navbar-brand" href="#"><span class="h3 fw-bold text-color-base">HIDAYAH</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar ms-auto">
            <a class="nav-link nav-link-grow-up text-color-base" href="#">Home</a>
            <a class="nav-link nav-link-grow-up text-color-base" href="#">News</a>
            <a class="nav-link nav-link-grow-up text-color-base" href="#">Today Activity</a>
            <a class="nav-link nav-link-grow-up text-color-base" href="#">About Muhammadiyah</a>
          </div>
          <div>
            <a class="nav-link nav-link-grow-up text-color-base" href="login.html">Login</a>
          </div>
        </div>
      </div>
    </nav>
    <!-- NavBar End -->

    <!-- Carousel Start -->
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?= ROOT?>/image/coret 18.jpg" width="200" class="d-block w-100" alt="display 1" />
        </div>
        <div class="carousel-item">
          <img src="<?= ROOT?>/image/coret 23.jpg" width="200" class="d-block w-100" alt="display 2" />
        </div>
        <div class="carousel-item">
          <img src="<?= ROOT?>/image/display 1.jpg" width="200" class="d-block w-100" alt="display 3" />
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- Carousel End -->

    <!-- Content Wrapper Start -->
    <div id="content-wrapper">
      <!-- Home Start -->
      <section id="home" class="px-lg-5 py-lg-5 mb-5">
        <div class="container">
          <div class="row text-center">
            <div class="justify-content-center">
              <img src="<?= ROOT?>/image/home-judul.png" width="35%" alt="display about" />
              <h1 class="display-4 fw-bold" style="color: #1e73be">Muhammadiyah Kansai</h1>
              <p class="lead fw-medium" style="color: #777777">Muslimah Muhammadiyah Organization For The Public Affiliated In Kansai, Japan</p>
            </div>
          </div>
        </div>
      </section>
      <!-- Home End -->

      <!-- VnM Start -->
      <section id="vnm" class="px-lg-5 py-5 bg-odds">
        <div class="container">
          <div class="row text-center">
            <div class="justify-content-center">
              <h1 class="display-4 fw-bold" style="color: white">Vision and Mission</h1>
            </div>
          </div>
          <div class="row justify-content-evenly my-5">
            <div class="col-md-4 mb-5">
              <div class="p-4 shadow rounded text-center bg-card">
                <h3 class="underlined">Vision</h3>
                <p>Participate In Creating A Real Islamic Society That Can Lead To The Gates Of Heaven "Jannatun Na'im" With The Pleasure Of Allah, The Rahman And Rahim.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-4 shadow rounded text-center bg-card">
                <h3>Mission</h3>
                <p>Participate In Implementing Progressive Islam Which Is Manifested In The Form Of Business In The Form Of Charitable Efforts, Programs And Activities In All Areas Of Life.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- VnM End -->

      <!-- News Start -->
      <section id="news" class="px-lg-5 py-5">
        <div class="container">
          <div class="row text-center mb-5">
            <h1 class="display-4 fw-bold" style="color: #1e73be">News</h1>
          </div>
          <div class="row justify-content-evenly">
            <div class="col-md-4 mb-5">
              <div class="card shadow-sm">
                <img src="<?= ROOT?>/image/news/news-2.jpg" alt="news-1" height="50%" />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-5">
              <div class="card shadow-sm">
                <img src="<?= ROOT?>/image/news/news-2.jpg" alt="news-1" height="50%" />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-5">
              <div class="card shadow-sm">
                <img src="<?= ROOT?>/image/news/news-2.jpg" alt="news-1" height="50%" />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-5">
              <div class="card shadow-sm">
                <img src="<?= ROOT?>/image/news/news-2.jpg" alt="news-1" height="50%" />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-5">
              <div class="card shadow-sm">
                <img src="<?= ROOT?>/image/news/news-2.jpg" alt="news-1" height="50%" />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- News End -->

      <!-- Activity Start -->
      <section id="activity" class="px-lg-5 py-5 bg-odds">
        <div class="container">
          <div class="row text-center">
            <h1 class="display-4 fw-bold mb-5" style="color: white">Activity</h1>
          </div>
          <div class="row justify-content-evenly">
            <div class="col-md-4 mb-5">
              <div class="card shadow-sm">
                <img src="<?= ROOT?>/image/news/news-2.jpg" alt="news-1" height="50%" />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-5">
              <div class="card shadow-sm">
                <img src="<?= ROOT?>/image/news/news-2.jpg" alt="news-1" height="50%" />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-5">
              <div class="card shadow-sm">
                <img src="<?= ROOT?>/image/news/news-2.jpg" alt="news-1" height="50%" />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-5">
              <div class="card shadow-sm">
                <img src="<?= ROOT?>/image/news/news-2.jpg" alt="news-1" height="50%" />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-5">
              <div class="card shadow-sm">
                <img src="<?= ROOT?>/image/news/news-2.jpg" alt="news-1" height="50%" />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Activity End -->

      <!-- Footer Start -->
      <footer></footer>
      <!-- Footer End -->
    </div>
    <!-- Content Wrapper End -->

    <!-- JS Script Start -->
    <script src="<?= ROOT?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ROOT?>/js/aos.js"></script>
    <script src="<?= ROOT?>/js/main.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    <!-- JS Script End -->
  </body>
</html>
