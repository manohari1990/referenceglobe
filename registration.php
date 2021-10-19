<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Reference Globe - Sign Up</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <header>
            <h1 class="site-heading text-center text-faded d-none d-lg-block">
                <span class="site-heading-lower">User Sign Up</span>
            </h1>
        </header>
        
        <section class="page-section cta register-page">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-upper">Sign Up Form</span>
                            </h2>
                            <div class="col-xl-6 mx-auto">
                                <form autocomplete="off" action="users.php" method="POST" enctype="multipart/form-data" id="userForm" >
                                    <input type="hidden" id="status" name="status" value='0'>
                                    <div class="md-form mb-4">
                                        <input type="text" id="first_name" name="first_name" placeholder="First Name" class="form-control" onkeypress="return onlyAlphabets(event,this);" required>
                                    </div>
                                    <div class="md-form mb-4">
                                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="form-control" onkeypress="return onlyAlphabets(event,this);" required>
                                    </div>
                                    <div class="md-form mb-4">
                                        <input type="text" id="dob" name="dob" placeholder="Date of Birth" class="form-control" required>
                                    </div>
                                    <div class="md-form mb-4" style="position:relative">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="female" name="gender" required>Female
                                        </label>
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="male" name="gender">Male
                                        </label>
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="other" name="gender">Other
                                        </label>
                                    </div>
                                    <div class="md-form mb-4">
                                        <input type="phone" maxlength=10 id="phone_number" name="phone_number" placeholder="Phone Number" class="form-control" onkeypress="return isNumberKey(event)">
                                    </div>
                                    <div class="md-form mb-4">
                                        <input autocomplete="false" type="text" id="email_id" name="email_id" placeholder="Email ID" class="form-control" required>
                                    </div>
                                    <div class="md-form mb-4">
                                        <input autocomplete="off" type="text" id="username" name="username" placeholder="Username" class="form-control" required>
                                    </div>
                                    <div class="md-form mb-4">
                                        <input autocomplete="off" type="password" id="user_password" name="user_password" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="md-form mb-4">
                                        <input type="hidden" id="user_roll" name="user_roll" value="user">
                                        <!-- <select name="user_roll" id="user_roll" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                            <option value="sadmin">Super Admin</option>
                                        </select> -->
                                    </div>
                                    <div class="md-form mb-4">
                                        <input type="text" id="user_signature" name="user_signature" placeholder="Signature" class="form-control">
                                    </div>
                                    <div class="md-form mb-4" style="position:relative;">
                                        <input type="file" id="profile_pic" name="profile_pic" placeholder="Profile Pic" class="form-control">
                                    </div>
                                    <div class="md-form mb-4">
                                        <textarea name="address" id="address" class="form-control" rows="5" placeholder="Address"></textarea>
                                    </div>
                                    <button type="submit" name="submit" name="submit" class="btn btn-primary">Sign Up</button>
                                    <a href="javascript:void(0)" onclick="history.back(0)" class="btn btn-danger">Back</a>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
        <!-- Core theme JS-->
        <script src='js/common.js'></script>
    </body>
</html>
