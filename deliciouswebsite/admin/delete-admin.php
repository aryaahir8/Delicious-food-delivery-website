<?php

//include constants.php file here
include('../config/constants.php');

//1.get the ID of admin to be deleted 
$id = $_GET['id'];

//2.create sql quey to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

//check the query executed sucessfully or not
if ($res == true) {
    //query executed successfully and admin deleted
    //echo "Admin Deleted";
    //create session variable to display message
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
    //Redirect to manage admin page 
    header('location:' . SITEURL . 'admin/manage-admin.php');
} else {
    //falied to delete admin
    //echo "Failed to delete admin";

    $_SESSION['delete'] = "<div class='error'>Failed to delete admin.Try again later.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
}

//3.redirect to manage admin page with message (success/error)
