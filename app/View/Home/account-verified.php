<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <!-- LINK Start-->
    <link rel="stylesheet" href="<?= ROOT?>/css/aos.css" />
    <link rel="stylesheet" href="<?= ROOT?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= ROOT?>/css/line-awesome.min.css" />
    <link rel="stylesheet" href="<?= ROOT?>/css/loginstyle.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" /> -->
    <!-- LINK END -->
  </head>
  <body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
      <div class="row-md border rounded-5 p-3 bg-white shadow box-area">
        <div class="col-md">
          <div class="row align-items-center">
            <div class="header-text mt-4 mb-4">
              <h3><?= $response['massage']?></h3>
            </div>
            <?php if(isset($response['succses'])) {?>
            <div class="header-text mb-4">
              <p class="text-color-highlight text-center"><?= $response['email']?></p>
            </div>
            <div class="header-text mb-4">
              <p class="text-color-base text-center">Your E-Mail Has Been Verified, Click <a href="/login">Login</a> If You Want To Login</p>
            </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>

    <!-- JS Script Start -->
    <script src="<?= ROOT?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ROOT?>/js/aos.js"></script>
    <script src="<?= ROOT?>/js/main.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    <!-- JS Script End -->
  </body>
</html>
