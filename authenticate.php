<?php
require_once('DbOperations.php'); 
if(isset($_POST)){
    $obj = new DbOperations();
    $obj->authentication($_REQUEST['username'], $_REQUEST['password']);
}