<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?
        if (isset($_SESSION['add'])) //checking whether the session is set or not
        {
            echo $_SESSION['add']; //displaying session message if set
            unset($_SESSION['add']); //remove session messsage
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">

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
    //1.Get the data from the form 

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password Encryption with MD5

    //2.sql query to save the data into the database
    $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

    //3. EXecuting Query and saving Data into Database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //4. Check Whether the (query is executed) data is inserted or not and display appropriate message
    if ($res == True) {
        //Data inserted
        //echo "Data inserted";
        //Create a session variable to display message
        $_session['add'] = "Admin added successfully";
        //redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //Failed to Insert data
        //echo "Faile to Insert Data";
        //Create a session variable to display message
        $_session['add'] = "Failed to add admin";
        //redirect page to add admin
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}
?>