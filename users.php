<?php
    require_once('DbOperations.php');
    $searchKey = null;
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $obj = new DbOperations();
        $result = $obj->UpdateUser($_POST, $_FILES);
        die();
    } 

    if(isset($_POST['submit'])){
        $obj = new DbOperations();
        $response = $obj->Save($_POST, $_FILES);
        die();
    }

    if(isset($_GET['search'])){
        $searchKey = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';
        $obj = new DbOperations();
        $result = $obj->getUsers($searchKey);
        die();
    } 
    if(isset($_GET['id']) && $_GET['action'] == 'edit'){
        $obj = new DbOperations();
        $result = $obj->getUserDetail($_GET['id']);
        die();
    } 
    if(isset($_GET['id']) && $_GET['action'] == 'delete'){
        $obj = new DbOperations();
        $result = $obj->deleteUser($_GET['id']);
        die();
    } 
    if(isset($_GET['id']) && $_GET['action'] == 'approved'){
        $obj = new DbOperations();
        $result = $obj->UserApproval($_GET['id']);
        die();
    } 

    if(isset($_GET['profileId'])){
        $obj = new DbOperations();
        $result = $obj->getUserByUsername($_GET['profileId']);
        $result = json_decode($result);
        //die();
    } 
?>