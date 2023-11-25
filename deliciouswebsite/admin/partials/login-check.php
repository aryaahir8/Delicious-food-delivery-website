<?php

//Authorization-acces control
//check whether the user is logged in or not 
if (!isset($_SESSION['user'])) // id user is not set
{
    //user is not logged in
    //redierct to login page with message
    $_SESSION['no-login-messsage'] = "<div class='error text-center'>PLease login to access Admin Panel.</div>";
    //redirect to login page 
    header('location' . SITEURL . 'admin/login.php');
}
