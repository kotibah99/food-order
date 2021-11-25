<?php  include('partials/menu.php');  ?>
<div class="wrapper">
<h1>Update category</h1>
    <br>
    <br>
    <?php
        //check whether the id set or not
        if(isset($_GET['id']))
        {
            //GET the id all other data
       // echo "Getting the Data";
       $id = $_GET['id'];
       //Crate sql query to get all other the details
       $sql  = "SELECT * FROM tbl_category WHERE id=$id";
       //Execute the quety
       $res = mysqli_query($conn , $sql);
       //count the rows to check whether the id is valid or not
       $count = mysqli_num_rows($res);
       if($count==1)
       {
           //Get all the data
           $row = mysqli_fetch_assoc($res);
           $title = $row['title'];
           $current_image=$row['image_name'];
           $featured = $row['featured'];
           $active = $row['active']; 

       }else{
           //redirect to manage category with session message
           $_SESSION['no-category-found'] = "<div class='error'> Category not Found. </div>";
           header('location:'.SITEURL.'admin/manage-category.php');

       }
        }
        else{
            ////redirect to manage category
   header('location:'.SITEURL.'admin/manage-category.php');

        }
    ?>
    <form action=""method="POST"enctype="multipart/form-data">
            <table class="tbl-30">
                        <tr>
                            <td>Title:</td>
                            <td> <input type="text" name="title"value="<?php echo $title; ?>"> </td>
                        </tr>
                        <tr>
                        <td>Current image:</td>
                        <td>
                            <?php 
                                if($current_image!="")
                                {
                                    //Display the image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>"width="150px"> 
                                    <?php

                                }else{
                                    //Display Message
                                    echo "<div class=' error ' > Image not Added. </div>";
                                }
                            ?>
                        
                        </td>
                        <tr>
                            <td>New Image:</td>
                            <td>
                                <input type="file"name="image" value="">
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Featured: </td>
                            <td>
                                <input <?php if($featured=="Yes"){echo"checked";} ?> type="radio" name="featured"value="Yes">Yes
                                <input <?php if($featured=="No"){echo" checked";}?> type="radio" name="featured"value="No">No
                            </td>
                        </tr>

                        <tr>
                            <td>Active: </td>
                            <td>
                                <input <?php if($active=="Yes"){echo"checked";} ?>  type="radio" name="active"value="Yes">Yes

                                <input <?php if($active=="No"){echo"checked";} ?> type="radio" name="active"value="No">No
                            </td>
                        </tr>
                        <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="update Category" class="btn-secondary">
                            </td>
                        </tr>

                    </table>
            </form>
            <?php
        //ckeck whether tje submit button is cliced or not
        if(isset($_POST['submit']))
        {
            //echo "Clicked";
            //1.Get the value from category form 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image=$_POST['current_image'];
            $featured= $_POST['featured'];
            $active=$_POST['active'];
          
        //2.updating new image if selected
        
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
                $image_name = "Food_Category_".rand(000,999).'.'.$ext;//e.g. food_category_874.jpg

                

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$image_name;

                //finally upload the image
                $upload = move_uploaded_file($source_path,$destination_path);
                //check whether the image is uploded or not
                //And if thr image is not uploded then will stop the proccess and redirect with error message
                if($upload==false)
                {
                    //SET message 
                    $_SESSION['upload']="<div class='error'> failed upload image.  </div>";
                    //redirect to Add category
                    header('location:'.SITEURL.'admin/manage-category.php');
                    //Stop the process
                    die();
                }
               //remove cuurent image
               if($current_image!="")
               {
                $remove_path = "../images/category/".$current_image;

                $remove = unlink($remove_path);
 
                //image is removed
                //if failed to remove then display message and stop the procces
                if($remove==false)
                {
                    //failed to remove
                    $_SESSION['failed-remove'] = "<div class= 'error'>Failed to remove current image  </div> ";
                    header('location:'.SITEURL.'admin/manage-category.php');
                     die();//stop the procces
                }
               }
            

           }else{
            $image_name = $current_image;

           }
          
        }
        //3.update the DataBase
        $sql2="UPDATE tbl_category SET
         title = '$title',
         image_name = '$image_name',
         featured = '$featured',
           
            active = '$active'
            WHERE id=$id
        ";
        //execute the query
        $res2  = mysqli_query($conn , $sql2);


            //4/redirect manage-category
            if($res2==true)
            {
                //create update
                $_SESSION['update'] = "<div class='success'> Category Updated successfuly. </div> ";
                header('location:'.SITEURL.'admin/manage-category.php');

            }else{
                //failed update
                $_SESSION['update'] = "<div class='error'> Category Updated failed. </div> ";
                header('location:'.SITEURL.'admin/manage-category.php');


            }
         
        }
           
        ?>
   
</div>

</div>
<?php  include('partials/footer.php');  ?>
