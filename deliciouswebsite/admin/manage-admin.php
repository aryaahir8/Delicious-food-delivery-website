<?php include('partials/menu.php'); ?>

<!-- Main contetn section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //displaying session message
            unset($_SESSION['add']); //displaying session messsage
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }

        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        ?>
        <br><br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br /><br /><br /><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>


            <?php
            //Query to get all admin 
            $sql = "SELECT * FROM tbl_admin";
            //execute the query
            $res = mysqli_query($conn, $sql);

            //check whether the query is executed or not
            if ($res == TRUE) {
                //count rows to check whether we have in database or not 
                $count = mysqli_num_rows($res); //function to get all the rows in database

                $sn = 1; //create a variable and assign the value

                //check the sum of rows
                if ($count > 0) {
                    //we have data in database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //using while loops to get all the data from database.
                        //and while loop will run as long as we have dada in database

                        //get individual data 
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //display the values in our table
            ?>

                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $full_name; ?></td>
                            <td>
                                <<?php echo $username; ?>< /td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete admin</a>
                            </td>
                        </tr>

            <?php

                    }
                } else {
                    //we do not have data in database
                }
            }
            ?>



        </table>

    </div>
</div>
<!-- Main content section Ends -->

<?php include('partials/footer.php'); ?>