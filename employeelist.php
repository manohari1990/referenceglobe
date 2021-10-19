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
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="admindashboard.php">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="admindashboard.php">Dashboard</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="listusers.php">Users</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="employeelist.php">Employees</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="<?php echo $_SERVER['PHP_SELF']; ?>?actionid=logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <section class="page-section cta">
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
                    <div class="col-sm-12">
                        <div class="col-sm-4 mb-4 float-left">
                            <input class="form-control" type="text" name="searchKey" id="searchKey" placeholder="Search by Name or Designation"> 
                        </div>
                        <div class="col-sm-2 mb-4 float-left">
                            <button class="btn btn-success" onclick="loadEmployees()">Search</button>
                        </div>
                        <div class="col-sm-2 mb-4 float-right">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add User</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Designation</th>
                            <th>Date Of Birth</th>
                            <th>Date Of Joining</th>
                            <th>Blood Group</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Identity</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="dataRows"> <!-- Populate Dynamically --> </tbody>
                    </table>
                    <div id="pagination"></div>
                </div>
            </div>
        </section>
        <footer class="footer text-faded text-center py-5">
            <div class="container"></div>
        </footer>

        <!-- New User Popup -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title align-center">New Employee</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form autocomplete="off" action="employees.php" method="POST" enctype="multipart/form-data" id="userForm" >
                            <input type="hidden" id="id" name="id">
                            <div class="md-form mb-4">
                                <input type="text" id="emp_name" name="emp_name" placeholder="Employee Name" class="form-control" onkeypress="return onlyAlphabets(event,this);" required>
                            </div>
                            <div class="md-form mb-4">
                                <input type="text" id="emp_designation" name="emp_designation" placeholder="Employee Designation" class="form-control" onkeypress="return onlyAlphabets(event,this);" required>
                            </div>
                            
                            <div class="md-form mb-4">
                                <input type="text" id="dob" name="dob" placeholder="Date of Birth" class="form-control" required>
                            </div>
                            <div class="md-form mb-4">
                                <input type="text" id="doj" name="doj" placeholder="Date of Join" class="form-control" required>
                            </div>
                            <div class="md-form mb-4">
                                <input type="text" id="blood_group" name="blood_group" placeholder="Employee Blood Group" class="form-control" maxlength=2 onkeypress="return onlyAlphabets(event,this);" required>
                            </div>
                            
                            <div class="md-form mb-4">
                                <input type="phone" maxlength=10 id="mobile" name="mobile" placeholder="Mobile Number" class="form-control" onkeypress="return isNumberKey(event)">
                            </div>
                            <div class="md-form mb-4" style="position:relative;">
                                <input type="file" id="identity_file_path" name="identity_file_path" placeholder="Profile Pic" class="form-control" onchange="checkUpload(this)">
                                <input type="hidden" id="identity_file" name="identity_file">
                                <input type="hidden" id="file_type" name="file_type">
                                <iframe id="iframe_file" src="" style="display:none;margin-top:15px;" width="100%" height="200"></iframe>
                            </div>
                            <div class="md-form mb-4">
                                <textarea name="emp_address" id="emp_address" class="form-control" rows="5" placeholder="Address"></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- The Modal -->
        <div id="fileViewer" class="modal">

        <!-- The Close Button -->
        <span class="close" onclick="closeFileViewer('fileViewer')">&times;</span>

        <!-- Modal Content (The Image) -->
        <iframe class="modal-content" id="fileView" src="" style="width: 800px; height: 800px" ></iframe>

        </div>

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            let userRole = '<?php echo $_SESSION['user_roll']; ?>';
        </script>
        <script src="js/common.js"></script>
    </body>
</html>