<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?
        if (isset($_SESSION['add'])) //checking whether the session is set or not
        {
            echo $_SESSION['add']; //displaying session message if set
            unset($_SESSION['add']); //remove session messsage
        }
        if (isset($_SESSION['upload'])) //checking whether the session is set or not
        {
            echo $_SESSION['upload']; //displaying session message if set
            unset($_SESSION['upload']); //remove session messsage
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">

                    </td>
                </tr>
            </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>



<?php
//Process the value from form and save it in database

//check whether the button is clicked or not 

if (isset($_POST['submit'])) {

    //echo "Button clicked";
    //1.Get the value from category form 

    $title = $_POST['title'];

    //for radio input, we need to check whether the button is selected or not
    if (isset($_POST['featured'])) {
        //get value from the form
        $featured = $_POST['featured'];
    } else {
        //set the default value
        $featured = "No";
    }
    if (isset($_POST['active'])) {
        //get value from the form
        $active = $_POST['active'];
    } else {
        //set the default value
        $active = "No";
    }

    //check whether the image is selcted or not and set the value for the image accordingly
    //print_r($_FILES['image']);

    //die(); //break the code here
    //upload the image
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/category/" . $image_name;
            //finally upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check whether the image is uploaded or not
            if ($upload == false) {
                //set message
                $_SESSION['upload'] = "<div class='error'>failed to upload the image. </div>";
                //redirect to add category page
                header('location:' . SITEURL . 'admin/add-category.php');
                //stop proccess
                die();
            }
        }
    } else {
        $image_name = "";
    }

    //2.create sql query to insert category into database
    $sql = "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
        ";

    //3. EXecuting Query and saving Data into Database
    $res = mysqli_query($conn, $sql);

    //4. Check Whether the (query is executed) data is inserted or not and display appropriate message
    if ($res == True) {
        //query executed and category added
        $_session['add'] = "<div class='success'>category added successfully.</div>";
        //redirect page to manage category
        header("location:" . SITEURL . 'admin/manage-category.php');
    } else {
        //query executed and category added
        $_session['add'] = "<div class='error'>failed to add category.</div>";
        //redirect page to manage category
        header("location:" . SITEURL . 'admin/add-category.php');
    }
}
?>