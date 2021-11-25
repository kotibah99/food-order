
<?php
//Include constants php
include('../config/constants.php');
//1. Get the Id of Admin to be delete

    $id = $_GET['id'];



//2.create SQL QUERY to delete Admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";


//Execute the Query
$res = mysqli_query($conn,$sql);
//check whether the query executed succsess or not
if($res==TRUE)
{
    //Query Executed sucsess and DELETE ADMIN
   // echo "Admin Deleted";

   //create session var to display message
   $_SESSION['delete']="<div class='success'>Admin Deleted succesfully.</div>";
   //redirect to manage Admin
    header('location:'.SITEURL.'admin/manage-admin.php');


}
else
{
    //falied Delete
    //echo "Failed Deleted Admin";
   $_SESSION['delete']=" <div class='erorr'> Admin Deleted failed.</div>";
   header('location:'.SITEURL.'admin/manage-admin.php');


}
//3. redirect to manage admin page with message( succ / erorr)

?>