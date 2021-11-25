<?php  include('partials/menu.php');  ?>

<!-- main content section start -->
<div class=" main-content">
<div class="wrapper">

<h1> Manage Admin </h1>
<br>

<?php 
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];//displaying session messsage
    unset($_SESSION['add']);//Removing session message
}
if(isset($_SESSION['delete']))
{
    echo $_SESSION['delete'];//displaying session messsage
    unset($_SESSION['delete']);//Removing session message
}
if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];//displaying session messsage
    unset($_SESSION['update']);//Removing session message
}
if(isset($_SESSION['user-not-found']))
{
    echo $_SESSION['user-not-found'];//displaying session messsage
    unset($_SESSION['user-not-found']);//Removing session message
}
if(isset($_SESSION['pwd-not-match']))
{
    echo $_SESSION['pwd-not-match'];//displaying session messsage
    unset($_SESSION['pwd-not-match']);//Removing session message
}

if(isset($_SESSION['change-pwd']))
{
    echo $_SESSION['change-pwd'];//displaying session messsage
    unset($_SESSION['change-pwd']);//Removing session message
}
?>
<br>
<br>
<br>
<!-- Button to add Admin -->
<a href="add-admin.php" class="btn-primary">  Add Admin </a>
<br>
<br>
<br>
<table class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Full Name</th>
        <th>username</th>
        <th>Actions</th>
    </tr>
    <?php
    //Query to Get All Admin
        $sql = "SELECT * FROM tbl_admin";
        //Execute the Query
        $res = mysqli_query($conn,$sql);
        //check whether the Query is Executed of not
        if($res==TRUE)
        {
            // count rows 
            $count = mysqli_num_rows($res); // function to get all the rows
            $sn =1; // create the value and assign the value
            //check the num of rows
            if($count>0)
            {
                //we Have data in dataBase
                while($rows=mysqli_fetch_assoc($res))
                {
                    //using while loop to get all the data from DataBase
                    //And while will run as long as we have data
                    //GET individual Data
                    $id = $rows['id'];
                    $full_name=$rows['full_name'];
                    $username=$rows['username'];

                    //displa the value in our table
                    ?>
                     <tr>
                            <td> <?php echo $sn++; ?> </td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id= <?php echo $id; ?>" class="btn-primary"> Change Password </a>
                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id= <?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            
                            </td>
                        </tr>

                    <?php
                }

            }else
            {
                //we don't have to dataBase
            }
        }
    ?>
   
   
    
    

</table>


</div>
</div>


<!-- main content section end -->

<?php include('partials/footer.php'); ?>






</body>


</html>
