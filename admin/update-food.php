<?php  include('partials/menu.php');  ?>
<?php
//id is set or not
if(isset($_GET['id']))
{
    //Get All detials
    $id  = $_GET['id'];
    //Sql Query selected food
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    //Execute the quety
    $res2 = mysqli_query($conn , $sql2);
    //count the rows to check whether the id is valid or not
   

    
        //Get all the data
        $row2 = mysqli_fetch_assoc($res2);
        $title = $row2['title'];
       
        $description = $row2['description'];
        $price = $row2['price'];

        $current_image=$row2['image_name'];
        $current_category=$row2['category_id'];

        $featured = $row2['featured'];
        $active = $row2['active']; 

   
     }


else
{
    //Redirect to manage Food
    header('location:'.SITEURL.'admin/manage-food.php');
  

}
?>

<div class="main-content">
<div class="wrapper">
<h1>Update Food  </h1>
<br>
<br>
<form action="" method="POST" enctype="multipart/form-data">

<table class="tbl-30">
    <tr>
        <td>Title :</td>
        <td> <input type="text" name="title"value="<?php echo $title; ?>"> </td>
    </tr>
    <tr>
        <td>Description: </td>
        <td>    
            <textarea name="description"  cols="30" rows="5"  > <?php echo $description; ?>  </textarea>
        </td>
    </tr>

    <tr>
        <td>Price: </td>
        <td>
            <input type="number" name="price" value=" <?php echo $price; ?>">
        </td>
    </tr>
    <tr> 
         <td>current Image :</td>
        <td >
            <?php
                if($current_image=="")
                {
                    //Image not available
                    echo " <div class = 'error'>Image not Available.</div> ";
                }else
                {
                   // Image Available
                   ?>
                   <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>"width="100px">
                   <?php
                }
            ?>
        </td>
    </tr>
    <tr>
        <td> Select New Image: </td>
        <td>
            <input type="file" name="image">
        </td>
    </tr>

    <tr>
        <td>Category: </td>
        <td>
            <select name="category" >
            <?php  
                                //create php code to display category from database
                                //1.create sql to get all active category from database 

                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                                //Executing query

                                $res=mysqli_query($conn,$sql);
                                //Count rows to check whether we have category or not
                                $count=mysqli_num_rows($res);

                                //If count is greater than zero,we have category else we dont have category 
                                if($count>0)
                                {

                                    //we have category
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the datails of categories
                                      $category_title = $row['title'];
                                      $category_id = $row['id'];
                                     // echo "<option value='$category_id'>$category_title</option> ";
                                     ?>
                                         <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title;  ?></option>

                                     <?php


                                    }
                                }
                                else
                                {

                                    //we dont have category 
                                    echo "<option value='0'>Category not Avalibal</option> ";

                                   
                                 

                                
                                }

                                //2.display in dropdown
                            
                            ?>

           
            </select>

              </td>
              </tr>
              <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "Checked";} ?> type="radio" name="featured"value="Yes">Yes
                        <input <?php if($featured=="No") {echo "Checked";} ?> type="radio" name="featured"value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes") {echo "Checked";} ?> type="radio" name="active"value="Yes">Yes
                        <input <?php if($active=="No") {echo "Checked";} ?> type="radio" name="active"value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>


</table>

</form>
<?php 
if (isset($_POST['submit']))
{
       //echo "Clicked";
            //1.Get the value from category form 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image=$_POST['current_image'];
            $featured= $_POST['featured'];
            $active=$_POST['active'];
            $price=$_POST['price'];
            $description=$_POST['description'];
            $category=$_POST['category'];

            if(isset($_FILES['image'] ['name'] ))
            {
            
               $image_name = $_FILES['image']['name'];
               if($image_name!="")
               {
                   //image available
                   //upload new image
                    //Auto rename our image
                    //Get the Existation of our image (jpg, png .....)
                    $ext = end(explode('.',$image_name));
    
                    //Rename the image
                    $image_name = "Food_Name_".rand(0000,9999).'.'.$ext;//e.g. food_category_874.jpg
    
                    
    
                    $src_path = $_FILES['image']['tmp_name'];
    
                    $dest_path = "../images/food/".$image_name;
    
                    //finally upload the image
                    $upload = move_uploaded_file($src_path,$dest_path);
                    //check whether the image is uploded or not
                    //And if thr image is not uploded then will stop the proccess and redirect with error message
                    if($upload==false)
                    {
                        //SET message 
                        $_SESSION['upload']="<div class='error'> failed upload new image.  </div>";
                        //redirect to Add category
                        header('location:'.SITEURL.'admin/manage-food.php');
                        //Stop the process
                        die();
                    }
                   //remove cuurent image
                   if($current_image!="")
                   {
                    $remove_path = "../images/food/".$current_image;
    
                    $remove = unlink($remove_path);
     
                    //image is removed
                    //if failed to remove then display message and stop the procces
                    if($remove==false)
                    {
                        //failed to remove
                        $_SESSION['remove-failed'] = "<div class= 'error'>Failed to remove current image  </div> ";
                        header('location:'.SITEURL.'admin/manage-food.php');
                         die();//stop the procces
                    }
                }
                
               }
               else
               {
                $image_name = $current_image;//Defult image when image not selected

               }
               }
               else{
                $image_name = $current_image;
    
               }
               $sql3 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = '$price',


         image_name = '$image_name',
         category_id = '$category',

         featured = '$featured',
           
            active = '$active'
            WHERE id=$id
               ";
                 $res3  = mysqli_query($conn , $sql3);


                 //4/redirect manage-category
                 if($res3==true)
                 {
                     //create update
                     $_SESSION['update'] = "<div class='success'> food Updated successfuly. </div> ";
                     header('location:'.SITEURL.'admin/manage-food.php');
     
                 }else{
                     //failed update
                     $_SESSION['update'] = "<div class='error'> food Updated failed. </div> ";
                     header('location:'.SITEURL.'admin/manage-food.php');
     
     
                 }
              
             
              
            

          
    
}
?>
</div>
</div>
<?php  include('partials/footer.php');  ?>
