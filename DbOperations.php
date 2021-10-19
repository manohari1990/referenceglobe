<?php 

class DbOperations{
    private $conn;
    private $dbname = 'systemtask';
    private $dbHost = 'localhost';
    private $dbUser = 'root';
    private $dbPass = '';
    private $host;
    private $uri;

    function __construct() {
        $this->conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbname) or die("Could not connect to the database:<br />" . mysql_error()); 
        
        if($this->conn->connect_errno) {
            printf("Connect failed: %s<br />", $this->conn->connect_error);
            exit();
        }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->host = $_SERVER['HTTP_HOST'];
        $this->uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    }

    /***
    * User DB Operations
    ***/
    public function Save($form_data, $file){
        $customFileName = null;
        $currentDT = new DateTime('NOW');
        $uploadOk = 1;
        $responseMesg = [];

        if(!$file["profile_pic"]["size"] == 0){
            $target_dir = "assets/uploads/";
            $target_file = $target_dir . basename($file["profile_pic"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $file["profile_pic"]["size"] < 2000) {
                $responseMesg['fileerror'] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                $responseMesg['fileerror'] =  "Sorry, your file was not uploaded.";
            } else {
                $customFileName = $target_dir . $form_data['first_name'].$currentDT->format('YmdHmi').'.'.$imageFileType;
                if (move_uploaded_file($file["profile_pic"]["tmp_name"], $customFileName)) {
                    $responseMesg['fileerror'] = '';
                    $uploadOk == 1;
                } else {
                    $uploadOk == 0;
                    $responseMesg['fileerror'] =  "Sorry, your file was not uploaded.";
                }
            }
        }
        if($uploadOk == 1 || $file["profile_pic"]["size"] == 0){
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/referenceglobe/";
            $customFileName = (!empty($customFileName)) ? $actual_link.$customFileName : '';
            //var_dump($customFileName); exit;
            $dateOfBirth = new DateTime($form_data['dob']);
            $dateOfBirth = $dateOfBirth->format('Y-m-d');
            $sql = "INSERT INTO users(first_name, last_name, email_id, username, user_password, phone_number, user_roll, address, gender, dob, profile_pic, user_signature, status) VALUES('".$form_data['first_name']."','".$form_data['last_name']."','".$form_data['email_id']."','".$form_data['username']."','".md5($form_data['user_password'])."','".$form_data['phone_number']."','".$form_data['user_roll']."','".$form_data['address']."','".$form_data['gender']."','".$dateOfBirth."','".$customFileName."','".$form_data['user_signature']."','".$form_data['status']."')";

            //echo "<pre>"; echo $sql; exit;

            try{
                if(!$this->conn->query($sql)){
                    throw new Exception($this->conn->error);
                }else{
                    $responseMesg['dataresponse'] = 'Record saved successfully!';
                    if($form_data['status'] == 0){
                        setcookie('signupStatus', "Your details are saved successfully! <br> You will be confirmed by Admin after registration approved.");
                    }
                }
            }catch(Exception $e){
                $responseMesg['dataresponse'] = $e->getMessage();
            }
        }
        //echo json_encode($responseMesg); exit;
        $this->conn->close();
        session_start();
        $_SESSION['UserInsertRecord'] = json_encode($responseMesg);
        header("location:http://$this->host$this->uri/listusers.php");
    }

    public function getUsers($searchKey){
        $resultArray = [];
        //if($searchKey == null)
            $sql = "SELECT id, first_name, last_name, email_id, username, address, dob, gender, phone_number, profile_pic FROM users WHERE user_roll NOT IN('sadmin','admin') ORDER BY id DESC";
        // else
        //     $sql = "SELECT id, first_name, last_name, email_id, username, address, dob, gender, phone_number, profile_pic FROM users";
        $result = $this->conn->query($sql);
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            array_push($resultArray, $row);
        }
        $result->free_result();
        $this->conn->close();
        //exit;
        echo json_encode($resultArray); 
    }

    public function getUserDetail($UserId){
        $sql = "SELECT first_name, last_name, email_id, phone_number, dob, user_signature, username, address, gender, user_roll, profile_pic, status FROM users WHERE id='{$UserId}'";
        $result = $this->conn->query($sql);
        $result = mysqli_fetch_assoc($result);
        echo json_encode($result);
        $this->conn->close();
        die();
    }
    public function getUserByUsername($Username){
        $sql = "SELECT id, first_name, last_name, email_id, phone_number, dob, user_signature, username, address, gender, user_roll, profile_pic, status FROM users WHERE username='{$Username}'";
        $result = $this->conn->query($sql);
        $result = mysqli_fetch_assoc($result);
        $this->conn->close();
        return json_encode($result);
    }

    public function UpdateUser($form_data, $file){
        //echo "<pre>"; print_r($form_data); exit;
        $customFileName = null;
        $currentDT = new DateTime('NOW');
        $uploadOk = 1;
        $responseMesg = [];

        if(!$file["profile_pic"]["size"] == 0){
            $target_dir = "assets/uploads/";
            $target_file = $target_dir . basename($file["profile_pic"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $file["profile_pic"]["size"] < 20000000) {
                $responseMesg['fileerror'] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                $responseMesg['fileerror'] =  "Sorry, your file was not uploaded.";
            } else {
                $customFileName = $target_dir . $form_data['first_name'].$currentDT->format('YmdHmi').'.'.$imageFileType;
                if (move_uploaded_file($file["profile_pic"]["tmp_name"], $customFileName)) {
                    $responseMesg['fileerror'] = '';
                    $uploadOk == 1;
                } else {
                    $uploadOk == 0;
                    $responseMesg['fileerror'] =  "Sorry, your file was not uploaded.";
                }
            }
        }

        if($uploadOk == 1 || $file["profile_pic"]["size"] == 0){
            $dateOfBirth = new DateTime($form_data['dob']);
            $dateOfBirth = $dateOfBirth->format('Y-m-d');
            $sql = "UPDATE users SET first_name='{$form_data['first_name']}', last_name='{$form_data['last_name']}', email_id='{$form_data['email_id']}', phone_number='{$form_data['phone_number']}', user_roll='{$form_data['user_roll']}', gender='{$form_data['gender']}', dob='{$dateOfBirth}', user_signature='{$form_data['user_signature']}', address='{$form_data['address']}'";
            if(isset($form_data['user_password']) && $form_data['user_password'] != ''){
                $pasword = md5($form_data['user_password']);
                $sql .= ", user_password='{$pasword}'";
            }
            if($form_data["profile_pic_path"] != ''){
                $sql .= ", profile_pic='{$form_data['profile_pic_path']}'";
            }elseif($file['profile_pic']["size"] > 0){
                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/referenceglobe/";
                $customFileName = $actual_link.$customFileName;
                $sql .= ", profile_pic='{$customFileName}'";
            }elseif($form_data["profile_pic_path"] == ''){
                $sql .= ", profile_pic=''";
            }
            $sql .= " WHERE id={$form_data['id']}";
            //echo $sql; exit;
            try{
                if(!$this->conn->query($sql)){
                    throw new Exception( $this->conn->error);
                }else{
                    $responseMesg['dataresponse'] = 'Record updated successfully!!';
                }
            }catch(Exception $e){
                $responseMesg['dataresponse'] = $e->getMessage();
            }
        }
        //echo json_encode($responseMesg); exit;
        $this->conn->close();
        session_start();
        $_SESSION['UserInsertRecord'] = json_encode($responseMesg);
        if($_SESSION['user_roll'] == 'user'){
            header("location:http://$this->host$this->uri/profile.php?profileId={$_SESSION['username']}");
        }else{
            header("location:http://$this->host$this->uri/listusers.php");
        }
    }
    public function UserApproval($id){
        $sql = "UPDATE users SET status=1 WHERE id={$id}";
        try{
            if(!$this->conn->query($sql)){
                throw new Exception($this->conn->error);
            }else{
                $responseMesg['dataresponse'] = 'User Approved successfully!';
            }
        }catch(Exception $e){
            $responseMesg['dataresponse'] = $e->getMessage();
        }
        $this->conn->close();
        session_start();
        $_SESSION['UserInsertRecord'] = json_encode($responseMesg);
        echo "success";
    }
    public function deleteUser($id){
        $sql = "DELETE FROM users WHERE id={$id}";
        
        try{
            if(!$this->conn->query($sql)){
                throw new Exception($this->conn->error);
            }else{
                $responseMesg['dataresponse'] = 'Record deleted successfully!';
            }
        }catch(Exception $e){
            $responseMesg['dataresponse'] = $e->getMessage();
        }
        $this->conn->close();
        session_start();
        $_SESSION['UserInsertRecord'] = json_encode($responseMesg);
        echo "success";
        // header("location:http://$this->host$this->uri/listusers.php");
    }

    public function authentication($username, $password){
        $password = md5($password);
        $sql = "SELECT first_name, last_name, user_roll, profile_pic FROM users WHERE username='{$username}' AND user_password='{$password}' AND status=1";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            session_start();
            $result = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $username;
            $_SESSION['first_name'] = $result['first_name'];
            $_SESSION['last_name'] = $result['last_name'];
            $_SESSION['user_roll'] = $result['user_roll'];
            $_SESSION['profile_pic'] = $result['profile_pic'];
            if(strtolower($result['user_roll']) == 'sadmin'){
                header("location:http://$this->host$this->uri/admindashboard.php");
            }elseif(strtolower($result['user_roll']) == 'admin'){
                header("location:http://$this->host$this->uri/admindashboard.php");
            }else{
                header("location:http://$this->host$this->uri/index.php");
            }
            $this->conn->close();
        }else{
            setcookie('loginError', "Invalid Username or Password");
            header("location:http://$this->host$this->uri/login.php");
        }
    }

    /***
    * Employee DB Operations
    ***/

    public function getEmployees($searchKey, $page){
        $resultArray['Result'] = [];
        $results_per_page = 10;  
        $page_first_result = ($page-1) * $results_per_page;  
        $sql = "SELECT * FROM employees ORDER BY id DESC";
        if($searchKey != ''){
            $sql = "SELECT * FROM employees WHERE emp_name LIKE '%{$searchKey}%' OR emp_designation LIKE '%{$searchKey}%' OR emp_address LIKE '%{$searchKey}%' OR blood_group LIKE '%{$searchKey}%' ORDER BY id DESC";
        }
        $result = $this->conn->query($sql);

        $number_of_result = $result->num_rows;
        $number_of_page = ceil($number_of_result / $results_per_page);  //determine the total number of pages available  
        $query = "SELECT * FROM employees ORDER BY id DESC LIMIT " . $page_first_result . ',' . $results_per_page;
        if($searchKey != ''){
            $query = "SELECT * FROM employees WHERE emp_name LIKE '%{$searchKey}%' OR emp_designation LIKE '%{$searchKey}%' OR emp_address LIKE '%{$searchKey}%' OR blood_group LIKE '%{$searchKey}%' ORDER BY id DESC LIMIT " . $page_first_result . ',' . $results_per_page;
        }
        $result = $this->conn->query($query);  
        
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {  //display the retrieved result on the webpage 
            array_push($resultArray['Result'], $row);
        }
        $result->free_result();
        $this->conn->close();
        $resultArray['pagination'] = $number_of_page;
        echo json_encode($resultArray);
    }

    public function SaveEmployee($form_data, $file){
        $customFileName = '';
        $currentDT = new DateTime('NOW');
        $responseMesg = [];
        $newFileName = $form_data['emp_name'].$currentDT->format('YmdHmi').'.'.$form_data['file_type'];
        $existing_target_file = getcwd().DIRECTORY_SEPARATOR.'assets\uploads\tempfile.'.$form_data['file_type']; 
        if(file_exists($existing_target_file)){
            $new_target_file = getcwd().DIRECTORY_SEPARATOR.'assets\uploads\\'. $newFileName; 
            rename($existing_target_file, $new_target_file);
    
            $target_dir = "assets/uploads/";
            $customFileName = $target_dir.$newFileName;
            
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/referenceglobe/";
            $customFileName = (!empty($customFileName)) ? $actual_link.$customFileName : '';
        }
        
        
        $dateOfBirth = new DateTime($form_data['dob']);
        $dateOfBirth = $dateOfBirth->format('Y-m-d');
        $dateOfJoin = new DateTime($form_data['doj']);
        $dateOfJoin = $dateOfJoin->format('Y-m-d');
        $sql = "INSERT INTO employees(emp_name, emp_designation, emp_dob, emp_doj, blood_group, mobile, emp_address, identity_file) VALUES('".$form_data['emp_name']."', '".$form_data['emp_designation']."', '".$dateOfBirth."', '".$dateOfJoin."', '".$form_data['blood_group']."', '".$form_data['mobile']."', '".$form_data['emp_address']."', '".$customFileName."')";

        //echo "<pre>"; echo $sql; exit;

        try{
            if(!$this->conn->query($sql)){
                throw new Exception($this->conn->error);
            }else{
                $responseMesg['dataresponse'] = 'Record saved successfully!';
                if($form_data['status'] == 0){
                    setcookie('signupStatus', "Your details are saved successfully! <br> You will be confirmed by Admin after registration approved.");
                }
            }
        }catch(Exception $e){
            $responseMesg['dataresponse'] = $e->getMessage();
        }
        
        //echo json_encode($responseMesg); exit;
        $this->conn->close();
        session_start();
        $_SESSION['UserInsertRecord'] = json_encode($responseMesg);
        header("location:http://$this->host$this->uri/employeelist.php");
    }

    public function getEmployeeDetail($EmpId){
        $sql = "SELECT * FROM employees WHERE id='{$EmpId}'";
        $result = $this->conn->query($sql);
        $result = mysqli_fetch_assoc($result);
        echo json_encode($result);
        $this->conn->close();
        die();
    }

    public function UpdateEmployee($form_data, $file){
        $customFileName = '';
        $currentDT = new DateTime('NOW');
        $responseMesg = [];
        $newFileName = $form_data['emp_name'].$currentDT->format('YmdHmi').'.'.$form_data['file_type'];
        $existing_target_file = getcwd().DIRECTORY_SEPARATOR.'assets\uploads\tempfile.'.$form_data['file_type']; 

        if(file_exists($existing_target_file)){
            $new_target_file = getcwd().DIRECTORY_SEPARATOR.'assets\uploads\\'. $newFileName; 
            rename($existing_target_file, $new_target_file);
    
            $target_dir = "assets/uploads/";
            $customFileName = $target_dir.$newFileName;
            
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/referenceglobe/";
            $customFileName = (!empty($customFileName)) ? $actual_link.$customFileName : '';
        }
        
        $dateOfBirth = new DateTime($form_data['dob']);
        $dateOfBirth = $dateOfBirth->format('Y-m-d');
        $dateOfJoin = new DateTime($form_data['doj']);
        $dateOfJoin = $dateOfJoin->format('Y-m-d');

        $sql = "UPDATE employees SET emp_name='{$form_data['emp_name']}', emp_designation='{$form_data['emp_designation']}', emp_dob='{$dateOfBirth}', mobile='{$form_data['mobile']}', blood_group='{$form_data['blood_group']}', emp_dob='{$dateOfBirth}', emp_address='{$form_data['emp_address']}', identity_file='{$customFileName}'";

        $sql .= " WHERE id={$form_data['id']}";
        //echo $sql; exit;
        try{
            if(!$this->conn->query($sql)){
                throw new Exception( $this->conn->error);
            }else{
                $responseMesg['dataresponse'] = 'Record updated successfully!!';
            }
        }catch(Exception $e){
            $responseMesg['dataresponse'] = $e->getMessage();
        }
        //echo json_encode($responseMesg); exit;
        $this->conn->close();
        session_start();
        $_SESSION['UserInsertRecord'] = json_encode($responseMesg);
        header("location:http://$this->host$this->uri/employeelist.php");
    }

    public function deleteEmployee($id){
        $sql = "DELETE FROM employees WHERE id={$id}";
        
        try{
            if(!$this->conn->query($sql)){
                throw new Exception($this->conn->error);
            }else{
                $responseMesg['dataresponse'] = 'Record deleted successfully!';
            }
        }catch(Exception $e){
            $responseMesg['dataresponse'] = $e->getMessage();
        }
        $this->conn->close();
        session_start();
        $_SESSION['UserInsertRecord'] = json_encode($responseMesg);
        echo "success";
        // header("location:http://$this->host$this->uri/listusers.php");
    }


    public function logout(){
        if(session_destroy()) {
            header("location:http://$this->host$this->uri/login.php");
        }
        $this->conn->close();
    }
}

?>