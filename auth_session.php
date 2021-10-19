<?php

include_once('DbOperations.php');
session_start();
if(!isset($_SESSION["username"])) {
    header("location:login.php");
    exit();
}

if(isset($_GET['actionid'])){
    if($_GET['actionid'] == 'logout'){
        $obj = new DbOperations();
        $obj->logout();
    }
}
