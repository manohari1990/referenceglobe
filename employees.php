<?php
    require_once('DbOperations.php');

    if(isset($_POST['id']) && !empty($_POST['id'])){
        $obj = new DbOperations();
        $result = $obj->UpdateEmployee($_POST, $_FILES);
        die();
    } 

    if(isset($_GET['search'])){
        $obj = new DbOperations();
        $result = $obj->getEmployees($_REQUEST['search'], $_REQUEST['page']);
        die();
    }
    if(isset($_POST['submit'])){
        $obj = new DbOperations();
        $result = $obj->SaveEmployee($_POST, $_FILES);
        die();
    }

    if(isset($_GET['id']) && $_GET['action'] == 'edit'){
        $obj = new DbOperations();
        $result = $obj->getEmployeeDetail($_GET['id']);
        die();
    } 
    if(isset($_GET['id']) && $_GET['action'] == 'delete'){
        $obj = new DbOperations();
        $result = $obj->deleteEmployee($_GET['id']);
        die();
    } 

    if(isset($_FILES['identity_file_path'])){
        $uploadOk = 1;
        $target_dir = "assets/uploads/";
        $target_file = $target_dir . basename($_FILES['identity_file_path']["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $_FILES['identity_file_path']["size"] < 20000000) {
            $responseMesg['fileerror'] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            $responseMesg['fileerror'] =  "Sorry, your file was not uploaded.";
        } else {
            $customFileName = $target_dir . 'tempfile.'.$imageFileType;
            if (move_uploaded_file($_FILES['identity_file_path']["tmp_name"], $customFileName)) {
                $responseMesg['fileerror'] = '';
                $uploadOk == 1;
            } else {
                $uploadOk == 0;
                $responseMesg['fileerror'] =  "Sorry, your file was not uploaded.";
            }
        }
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/referenceglobe/";
        $customFileName = (!empty($customFileName)) ? $actual_link.$customFileName : '';

        if(@move_uploaded_file($_FILES['identity_file_path']['tmp_name'], $customFileName)) {
            $uploadOk = 1;
        }
        echo json_encode(['result'=>$uploadOk, 'imageFileType'=>$imageFileType, 'file_path' => $customFileName]);
        sleep(1);
        die();
    }
    
        

?>