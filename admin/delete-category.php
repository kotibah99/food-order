<?php 
//Include constants php
include('../config/constants.php');
  //  echo "Delete page";
//check whether  the id and image_name is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //GET the value and Delete
  //  echo "GET value and delete";
  $id = $_GET['id'];
  $image_name = $_GET['image_name']; 
  //Remove the physical image file is available
    if($image_name!="")
    {
        //image is available so remove it
        $path = "../images/category/".$image_name;
        //remove the image
        $remove = unlink($path);
        //if failed remove image then add an error messge and stop the process
        if($remove==false)
        {
            //set the session message
            $_SESSION['upload']= "<div class='error'>failed to remove category image.</div>";
            //redirect manage category page
    header('location:'.SITEURL.'admin/manage-category.php');

            //stop the process 
            die();

        }
    }

  //Delete Data from dataBase
  //sql query to delete data from dataBase
  $sql = "DELETE FROM tbl_category WHERE id=$id";
  //execute the query
  $res = mysqli_query($conn,$sql);
  // check whether the data delete from data base or not
if($res==TRUE)
{
  //set success message and redirect 
  $_SESSION['delete']="<div class='success'> Category Delete successfuly. </div>";
         //redirect manage category page
         header('location:'.SITEURL.'admin/manage-category.php');

}
else {
  //set faile message and redirect 
  $_SESSION['delete']="<div class='error'> Category Delete failed. </div>";
         //redirect manage category page
         header('location:'.SITEURL.'admin/manage-category.php');

  
}

  

}else {
    //redirct to manage Category page
    header('location:'.SITEURL.'admin/manage-category.php');
 
}
?>