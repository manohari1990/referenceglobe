<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
include("users.php");
//print_r($result); exit;
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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.php">Dashboard</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="profile.php?profileId=<?php echo $_SESSION['username'] ?>">Profile</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="<?php echo $_SERVER['PHP_SELF']; ?>?actionid=logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <section class="page-section cta profile-page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center"><p style="color:#e8f0fe; font-size:19px;">
                        <?php
                            if(isset($_SESSION['UserInsertRecord'])){
                                $response = json_decode($_SESSION['UserInsertRecord']);
                                echo $response->dataresponse; 
                                unset($_SESSION['UserInsertRecord']);
                            }
                        ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                            <form autocomplete="off" action="users.php" method="POST" enctype="multipart/form-data" id="userForm" >
                                <input type="hidden" id="status" name="status" value="<?php echo $result->status ?>">
                                <input type="hidden" id="id" name="id" value="<?php echo $result->id ?>">
                                <div class="md-form mb-4">
                                    <input type="text" id="first_name" name="first_name" placeholder="First Name" class="form-control" value="<?php echo $result->first_name ?>" onkeypress="return onlyAlphabets(event,this);" required>
                                </div>
                                <div class="md-form mb-4">
                                    <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="form-control" value="<?php echo $result->last_name ?>" onkeypress="return onlyAlphabets(event,this);" required>
                                </div>
                                <div class="md-form mb-4">
                                    <input type="text" id="dob" name="dob" placeholder="Date of Birth" class="form-control" value="<?php echo $result->dob ?>" required>
                                </div>
                                <div class="md-form mb-4" style="position:relative">
                                <?php 
                                    $gender = ['female', 'male', 'other'];
                                    foreach($gender as $index => $value){ ?>
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="<?php echo $value; ?>" name="gender" <?php echo ($value == $result->gender) ? 'checked' : ''; ?>><?php echo ucfirst($value); ?>
                                        </label>
                                <?php } ?>                                    
                                </div>
                                <div class="md-form mb-4">
                                    <input type="phone" maxlength=10 id="phone_number" name="phone_number" placeholder="Phone Number" value="<?php echo $result->phone_number ?>" class="form-control" onkeypress="return isNumberKey(event)">
                                </div>
                                <div class="md-form mb-4">
                                    <input autocomplete="off" type="text" id="email_id" name="email_id" placeholder="Email ID" class="form-control" value="<?php echo $result->email_id ?>" required>
                                </div>
                                <div class="md-form mb-4">
                                    <input autocomplete="off" type="text" id="username" name="username" placeholder="Username" class="form-control" value="<?php echo $result->username ?>" required>
                                </div>
                                <div class="md-form mb-4">
                                    <input autocomplete="false" type="password" id="user_password" name="user_password" placeholder="Password" class="form-control" style="display:none" disabled="true">
                                    <a class="updatePassword" href="javascript:void(0)" onclick="changePassword()">Update Password</a>
                                </div>
                                <div class="md-form mb-4">
                                    <input type="hidden" id="user_roll" name="user_roll" value="user">
                                </div>
                                <div class="md-form mb-4">
                                    <input type="text" id="user_signature" name="user_signature" placeholder="Signature" value="<?php echo $result->user_signature ?>" class="form-control">
                                </div>
                                <div class="md-form mb-4" style="position:relative;">
                                    <input type="file" id="profile_pic" name="profile_pic" placeholder="Profile Pic" class="form-control" style="display:none;">
                                    <input type="hidden" id="profile_pic_path" name="profile_pic_path" value="<?php echo $result->profile_pic ?>">
                                    <img class="updateProfilePic" src="<?php echo $result->profile_pic ?>" width="200"><span class="removeImage"  onclick="removeImage(this)">x</span>
                                </div>
                                <div class="md-form mb-4">
                                    <textarea name="address" id="address" class="form-control" rows="5"  placeholder="Address"><?php echo $result->address ?></textarea>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                
                            </form>
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
        <script>
            $(document).ready(function(){
                $('#user_password').val('');
            })
        </script>
        <script src="js/common.js"></script>
        
    </body>
</html>