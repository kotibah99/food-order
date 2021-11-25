<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add categoty</h1>
        <br>
        <br>
        <?php 
        if(isset($_SESSION['add']))//checking whether theSession is set of not
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload']))//checking whether theSession is set of not
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br>
        <br>
        <!-- Add catogory from starts -->
        <form action="" method="POST" enctype="multipart/form-data"> 
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td> <input type="text" name="title"placeholder="Category Title"> </td>
                </tr>
                <tr>
                <td>select image:</td>
                <td>
                    <input type="file" name="image">
                </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured"value="Yes">Yes
                        <input type="radio" name="featured"value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active"value="Yes">Yes
                        <input type="radio" name="active"value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <!-- Add catogory from ends -->
        <?php
        //ckeck whether tje submit button is cliced or not
        if(isset($_POST['submit']))
        {
            //echo "Clicked";
            //1.Get the value from category form 
            $title = $_POST['title'];
            //For radio input we need to check whether the button is selected or not
            if(isset($_POST['featured']))
            {
                //Get the value from form 
                $featured = $_POST['featured'];
            }else{
                //SET the default value
                $featured = "NO";
            }
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else{
                $active = "No";
            }
            //check whether the image is selected or not and sent the value for image name accoridingly
           // print_r($_FILES['image']);
         //   die();//break the code HERE
         if(isset($_FILES['image'] ['name'] ))
         {
            // upload the image
            //To upload image we need image name,source path and destination path
            $image_name = $_FILES['image']['name'];
            //upload the image only image if selected
            if($image_name!="")
            {


            

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
                    header('location:'.SITEURL.'admin/add-category.php');
                    //Stop the process
                    die();
                }
            }
         } else{
             $image_name = "";
         }

            //2.create Sql query to INsert category dataBase
            $sql = "INSERT INTO tbl_category SET
            title = '$title',
            image_name='$image_name',
            featured = '$featured',
            active = '$active'
            ";
            //3.Execute the query and Save in dataBase
            $res = mysqli_query($conn,$sql);
            //4.check wherther the query execute or not and data added

            if($res==TRUE)
            {
                //Query execute and category added
                $_SESSION['add'] = "<div class='success'> Category Added successfuly. </div>";
                //Redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');

            }
            else
            {
                //failed to add category
                $_SESSION['add'] = "<div class='error'> Failed to Add Category  . </div>";
                //Redirect to manage category
                header('location:'.SITEURL.'admin/add-category.php');

            }

        }
        
        ?>
    </div>
</div>









<?php include('partials/footer.php');?>
