<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <!-- LINK Start-->
    <link rel="stylesheet" href="<?= ROOT?>/css/aos.css" />
    <link rel="stylesheet" href="<?= ROOT?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= ROOT?>/css/line-awesome.min.css" />
    <link rel="stylesheet" href="<?= ROOT?>/css/registerstyle.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" /> -->
    <!-- LINK END -->
  </head>
  <body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
      <div class="row-md border rounded-5 p-3 bg-white shadow box-area">
        <div class="col-md">
          <div class="row align-items-center">
            <div class="header-text py-4">
              <h1>Create An Account</h1>
              <?php if(isset($response['error'])){?>
              <p class="text-center"><?= $response['error'] ?></p>
              <?php }?>
            </div>
            <form method="post" name="form" id="form" onsubmit="return validated()">
              <div class="form-floating mb-3">
                <input type="text" id="nama" name="fullname" class="form-control" placeholder="Nama" value="<?php if(isset($_POST['fullname'])) echo $_POST['fullname']?>" />
                <label for="floatingInput" class="text-color-base"> Full Name </label>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Please Fill In</small>
              </div>
              <div class="form-floating mb-3">
                <input type="email" id="email" name="email" class="form-control" placeholder=" Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>"/>
                <label for="floatingInput" class="text-color-base"> Email </label>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Please Fill In</small>
              </div>
              <div class="form-floating mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder=" Password" />
                <label for="floatingPassword" class="text-color-base"> Password </label>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Please Fill In</small>
              </div>
              <div class="form-floating mb-5">
                <input type="password" id="password2" name="repassword" class="form-control" placeholder=" Password" />
                <label for="floatingPassword" class="text-color-base"> Re-Password </label>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Please Fill In</small>
              </div>
              <div class="input-group mb-5 mt-5">
                <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Register</button>
              </div>
            </form>
            <div class="row">
              <a class="text-color-base" href="/login">Back To Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JS Script Start -->
    <script src="<?= ROOT?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ROOT?>/js/aos.js"></script>
    <script src="<?= ROOT?>/js/main.js"></script>
    <script src="<?= ROOT?>/js/registerValidation.js"></script>
    <script src="https://kit.fontawesome.com/75d934ac69.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    <!-- JS Script End -->
  </body>
</html>
