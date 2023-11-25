<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php

        //check whether the id is set or not
        if (isset($_GET['id'])) {
            //get the id and all other details
            $id = $_GET['id'];
            //Create SQl query to get all other details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count the Rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //get all data 
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                //redirect to manage category with session message
                $_SESSION['no-category-found'] = "<div class='error>Category not found.</div>";
            }
        } else {
            //redirect to manage category
            header('location:' . SITEURL . 'admin/manage-category.php');
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //Display image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                        <?php
                        } else {
                            //display message
                            echo "<div class='error'>Image not added.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">

                    </td>
                </tr>
            </table>

        </form>

        <?php

        //check whether the submit button is clicked or not 


        if (isset($_POST['submit'])) {
            //echo "Button Clicked";
            //1. get all the values from form to update 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];


            //2. updating new image if selected


            //3. update the database
            $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    featured = '$featured',
                    active ='$active'
                    WHERE id=$id
                    ";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            //4.redirect to manage category with message

            if ($res2 == true) {
                //query executed and admin updated
                $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                //reidrect to manage admin page
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                //failed to update admin
                $_SESSION['update'] = "<div class='error'>Failed to update Admin.</div>";
                //reidrect to manage admin page
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }
        ?>



    </div>
</div>

<?php include('partials/footer.php'); ?>