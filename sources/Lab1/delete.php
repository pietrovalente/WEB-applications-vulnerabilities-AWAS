<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['Access']) && $_SESSION['Access'] == "admin") {
    echo header("Location: home.php");
}

include_once "connections/connection.php";
include_once "connections/connection.php";
include "validation/validation.php";
include "errorhandler/errorhandler.php";
include "errorhandler/sql_logging.php";

$con = connection();

if(isset($_POST['deleteUser'])) {
    $id = $_POST['ID'];
    $sqldeletepost = "DELETE FROM posts WHERE userID = '$id'";
    $sql = "DELETE FROM users WHERE userID = '$id'";
    $con->query($sqldeletepost) or die ($con->error);
    $con->query($sql) or die ($con->error);
    insertLog("WARNING", 1, " User ID ".$_SESSION['ID']." deleted an account with an ID of ".$id);

    echo header("Location: accounts.php");
}

if(isset($_POST['deletePost'])) {
    $id = $_POST['ID'];
    $sql = "DELETE FROM posts WHERE postID = '$id'";
    $con->query($sql) or die ($con->error);
    insertLog("WARNING", 1, " User ID ".$_SESSION['ID']." deleted a post with an ID of ".$id);
    echo header("Location: myPosts.php");
}
?>
