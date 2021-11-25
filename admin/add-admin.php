<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <br>
        <?php 
        if(isset($_SESSION['add']))//checking whether theSession is set of not
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="POST"> 
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td> <input type="text" name="full_name"placeholder="Enter Your Name"> </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username"placeholder="Your username">
                    </td>
                </tr>

                <tr>
                    <td>password: </td>
                    <td>
                        <input type="password" name="password"placeholder="Your password">
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





<?php include('partials/footer.php');?>


<?php 
    //process the value from Form and save it in DataBase

    if(isset($_POST['submit']))
    {
        //Button Clicked 
       // echo "Button Clicked";
       
       //1.Get the Data from Form
        $full_name = $_POST['full_name'];
        $username  = $_POST['username'];
       $password = md5($_POST['password']);//password Encryption with md5
       
       //2. sql query to save the data into DataBase
       $sql = "INSERT INTO tbl_admin SET
       full_name='$full_name',
       username='$username',
       password='$password'
       ";
       
  
//3. execute Query and save data in dataBase
       $res = mysqli_query($conn , $sql) or die(mysqli_error());
      //4.Check whether the (Query is Executed) Data is inserted or not and display message
      if($res == TRUE)
      {
          //data insert
          //echo "Data Inserted";
          //create a session var to Display message
            $_SESSION['add'] = "Admin Added Successfully";
            //redirect page to manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');


      } else
      {
          //Failed to insert Data
         // echo "No";
             //create a session var to Display message
             $_SESSION['add'] = "Failed to Add Admin";
             //redirect page to Add Admin
             header("location:".SITEURL.'admin/add-admin.php');
      }


    }
    

?>
