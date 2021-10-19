<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Reference Globe - Dashboard</title>
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
            <h4 class="text-center text-faded d-none d-lg-block mt-5 mb-5">
                <span class="site-heading-lower">Hi, <?php echo $_SESSION['first_name'] ." ". $_SESSION['last_name'] ?></span>
            </h4>
        </header>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.php">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <?php
                            if(strtolower($_SESSION['user_roll']) == 'sadmin'):
                        ?>
                            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.php">Dashboard</a></li>
                            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="listusers.php">Users</a></li>
                            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="employeelist.php">Employees</a></li>
                            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="<?php echo $_SERVER['PHP_SELF']; ?>?actionid=logout">Logout</a></li>
                        <?php
                            elseif(strtolower($_SESSION['user_roll']) == 'admin'):
                        ?>
                            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.php">Dashboard</a></li>
                            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="listusers.php">Users</a></li>
                            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="employeelist.php">Employees</a></li>
                            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="<?php echo $_SERVER['PHP_SELF']; ?>?actionid=logout">Logout</a></li>
                        <?php
                            endif;
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        
        <section class="page-section cta">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-upper">Dashboard</span>
                            </h2>
                            <div class="col-xl-6 mx-auto">
                                Welcome to Dashboard!!
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

        <script src="js/common.js"></script>
    </body>
</html>