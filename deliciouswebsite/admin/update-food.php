<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <?php

        //check whether the id is set or not
        if (isset($_GET['id'])) {
            //get the id and all other details
            $id = $_GET['id'];
            //Create SQl query to get all other details
            $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);
            //Count the Rows to check whether the id is valid or not
            $row2 = mysqli_fetch_assoc($res2);


            //get all data 
            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        } else {
            //redirect to manage food
            header('location:' . SITEURL . 'admin/manage-food.php');
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>

                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>

                <tr>

                    <td>Description: </td>

                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>

                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            //image not available
                            echo "<div class='error'>Image not available.</div>";
                        } else {
                            //image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
                        <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            //create php code to display categories from database
                            //1. create sql to get all active categories from database

                            $sql = "SELECT*FROM tbl_category WHERE active='YES'";

                            //Executing query

                            $res = mysqli_query($conn, $sql);

                            //Count Rows to check whether we have categories or not

                            $count = mysqli_num_rows($res);

                            // IF count is greater than zero, we have categories else we donot have categories
                            if ($count > 0) {

                                //WE have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //get the details of categories
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                                }
                            } else {
                                //WE do not have category
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            //2. Display on Drpopdown
                            ?>

                        </select>
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

                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
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
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category  = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];


            //2. updating new image if selected


            $image_name = $current_image;

            //3. update the database
            $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active ='$active'
                    WHERE id=$id";

            //execute the query
            $res3 = mysqli_query($conn, $sql3);

            //4.redirect to manage food with message

            if ($res3 == true) {
                //query executed and admin updated
                $_SESSION['update'] = "<div class='success'>food updated successfully.</div>";
                //reidrect to manage admin page
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                //failed to update admin
                $_SESSION['update'] = "<div class='error'>Failed to update Admin.</div>";
                //reidrect to manage admin page
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }
        ?>



    </div>
</div>

<?php include('partials/footer.php'); ?>