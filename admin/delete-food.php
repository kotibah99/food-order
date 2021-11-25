<?php 
//Include constants php
include('../config/constants.php');
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //process to delete
   // echo "process to Delete";



   //1.Get id and image name
  $id = $_GET['id'];
  $image_name = $_GET['image_name']; 


   //2.Remove the image if avaliable
   if($image_name!="")
{
    $path = "../images/food/".$image_name;
    //remove the image from folder
    $remove = unlink($path);
    if($remove==false)
    {
        //set the session message
        $_SESSION['remove']= "<div class='error'>failed to remove image file.</div>";
        //redirect manage category page
header('location:'.SITEURL.'admin/manage-food.php');

        //stop the process 
        die();

    }

}
   //3.Delete from dB
  $sql = "DELETE FROM tbl_food WHERE id=$id";
  //execute the query
  $res = mysqli_query($conn,$sql);
  if($res==TRUE)
{
  //food deleted
  $_SESSION['delete']="<div class='success'> Food Delete successfuly. </div>";
         //redirect manage category page
         header('location:'.SITEURL.'admin/manage-food.php');

} 
else
{
      //set faile message and redirect 
  $_SESSION['delete']="<div class='error'> failed to Food Delete. </div>";
  header('location:'.SITEURL.'admin/manage-food.php');


}

   


}else{
 //rediirect to manage-food
// echo "redirect";
$_SESSION['Unautihorize']= "<div class='error'> Unautihorized Access </div>" ;
header('location:'.SITEURL.'admin/manage-food.php');

 
}
?>
