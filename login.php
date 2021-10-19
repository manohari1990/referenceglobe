<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Reference Globe - Login</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <header>
            <h1 class="site-heading text-center text-faded d-none d-lg-block">
                <span class="site-heading-lower">Login</span>
            </h1>
        </header>
        
        <section class="page-section cta">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center"><p style="color:#e8f0fe; font-size:19px;">
                        <?php
                            echo (isset($_COOKIE['loginError'])) ? $_COOKIE['loginError'] : '';
                            echo (isset($_COOKIE['signupStatus'])) ? $_COOKIE['signupStatus'] : '';
                            setcookie("loginError", "", time() - 3600);
                            setcookie("signupStatus", "", time() - 3600);
                        ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-upper">Login Form</span>
                            </h2>
                            <div class="col-xl-6 mx-auto">
                                <form method="POST" action="authenticate.php">
                                    <input type="text" id="username" name="username" class="form-control mb-2" placeholder="USERNAME" autocomplete="off" required>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="PASSWORD" autocomplete="off" required>
                                    <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
                                    <a title="register" href="registration.php" class="btn btn-primary mt-3">Sign Up</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer text-faded text-center py-5">
            <div class="container"></div>
        </footer>
        <!-- Bootstrap core JS-->
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
        <!-- Core theme JS-->
    </body>
</html>
