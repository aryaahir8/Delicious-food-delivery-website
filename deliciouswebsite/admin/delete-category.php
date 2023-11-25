<?php
// Include Constants File
include('../config/constants.php');

//echo "Delete Page";
//Check whether the id and image name value is set or not
if (isset($_GET['id']) and isset($_GET['image_name'])) {


    //Get the value and Delete
    //echo "Get Value and Delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the physical image file is available
    if ($image_name != "") {
        // Image is Available. So remove it
        $path = "../images/category/" . $image_name;
        //REmove the Image
        $remove = unlink($path);

        // IF failed to remove
        if ($remove == false) {
            //Set the SEssion
            $_SESSION['remove'] = "<div class='error' >Fai1ed to Remove category Image.</div>";
            //REdirect to manage Category page
            header('location:' . SITEURL . 'admin/manage-category.php');
            //Stop the process
            die();
        }
    }

    //De1ete Data from Database
    //SQL Query to Delete Data from Database

    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the data is delete from database or not
    if ($res == true) {

        //SEt success MEssage and REdirect
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
        //Redirect to Manage category
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        //SEt Fail MEssage and Redirecs
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
        //Redirect to Manage category
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    // redirect to manage category page
    header('location:' . SITEURL . 'admin/manage-category.php');
}
