<?php include('partials-front/menu.php'); ?>


<!-- CAtegories Section Starts Here -->

<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //create sql query to display categories from database
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //count rows to check whether category is available or not
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //categories available
            while ($row = mysqli_fetch_assoc($res)) {
                //get the values like id,title,image_name
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>

                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        //check whether image name is available or not
                        if ($image_name == "") {
                            //display message
                            echo "<div class='error'>image not available</div>";
                        } else {
                            //image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>

        <?php
            }
        } else {
            //category not available
            echo "<div class='error'>category not found.</div>";
        }

        ?>

        <div class="clearfix"></div>
    </div>
</section>



<div class="clearfix"></div>
</div>
</section>
<!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>