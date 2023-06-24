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
            <div class="header-text mt-4">
              <h3>Hi, Welcome Back</h3>
            </div>
            <div class="header-text mb-1">
              <p class="text-color-base text-center">It's Good To See You Again</p>
              <?php if(isset($response['error'])){?>
              <p class="text-center"><?= $response['error'] ?></p>
              <?php }?>
            </div>
            <form method="post" name="form" onsubmit="return validated()" class="py-5">
              <div class="form-floating mb-3">
                <input autocomplete="off" type="email" name="email" class="form-control" id="floatingInput" placeholder=" Email" />
                <label for="floatingInput" class="text-color-base"> Email address </label>
                <div class="email_error" id="email_error">Silahkan isi email terlebih dahulu</div>
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder=" Password" />
                <label for="floatingPassword" class="text-color-base"> Password </label>
                <div class="password_error" id="password_error">Silahkan isi password terlebih dahulu</div>
              </div>
              <div class="input-group mt-3 d-flex gap-2 justify-content-start">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">remember me</label>
              </div>
              <div class="input-group mt-3 mb-3 d-flex justify-content-end">
                <div class="forgot">
                  <small><a href="#">Forgot Password?</a></small>
                </div>
              </div>
              <div class="input-group mb-3 justify-content-center my-5">
                <button type="submit" class="btn btn-lg btn-primary w-50 fs-6 shadow">Login</button>
              </div>
            </form>

            <div class="row">
              <small>Not a member? <a href="/register">Register</a></small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JS Script Start -->
    <script src="<?= ROOT?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ROOT?>/js/aos.js"></script>
    <script src="<?= ROOT?>/js/main.js"></script>
    <script src="<?= ROOT?>/js/loginValidation.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    <!-- JS Script End -->
  </body>
</html>
