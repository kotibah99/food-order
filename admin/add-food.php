<?php include('partials/menu.php'); ?>


<div class="main-content">

    <div class="wrapper">
    <h1>Add Food  </h1>
        <br><br>
        <?php
        if(isset($_SESSION['upload']))//checking whether theSession is set of not
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
            <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td> <input type="text" name="title"placeholder="titel of the food"> </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>    
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Description of the food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr> 
                     <td>Select Image :</td>
                    <td >
                        <input type="file" name="image" >
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
                                        $id=$row['id'];
                                        $title=$row['title'];

                                        ?>
                                         <option value="<?php echo $id; ?>"><?php echo $title;  ?></option>
                                        

                                        <?php


                                    }
                                }
                                else
                                {

                                    //we dont have category 
                                    ?>
                                   <option value="0">no category found</option>

                                    <?php
                                }

                                //2.display in dropdown
                            
                            ?>

                        
                        
                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

            </form>

            <?php 
                //check whether the button is clicked or not 
                if(isset($_POST['submit']))
                {
                    //Add the food in databse 
               //     echo "clicked";
                    
                    //1.get the data from form 
                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];
                    $category=$_POST['category'];

                    //check whether eadio featured and active checked or not
                    if(isset($_POST['featured']))
                    {
                        $featured =$_POST['featured'];

                    }
                    else
                    {
                        $featured="No";
                    }
                    if(isset($_POST['active']))
                    {
                        $active =$_POST['active'];

                    }
                    else
                    {
                        $active="No";
                    }


                    //2.upload the image if select
                    if(isset($_FILES['image']['name']))
                    {
                        //get the details of the selected image
                        $image_name=$_FILES['image']['name'];
                        if($image_name!="")
                        {
                            //image is selected 
                            //A.REname the image
                               //Get the Existation of our image (jpg, png .....)
                $ext = end(explode('.',$image_name));
                 //Rename the image
                 $image_name = "Food-Name-".rand(0000,9999).".".$ext;//e.g. food_category_874.jpg

                            //B.Upload the image
                            $src= $_FILES['image']['tmp_name'];
                             $dst= "../images/food/".$image_name;

                             //finally upload the ffod image
                             $upload = move_uploaded_file($src,$dst);
                             if($upload==false)
                {
                    //SET message 
                    $_SESSION['upload']="<div class='error'> failed upload image.  </div>";
                    //redirect to Add food
                    header('location:'.SITEURL.'admin/add-food.php');
                    //Stop the process
                    die();
                }
                            

                        }



                    }
                    else{
                        $image_name="";

                    }

                    //3. insert into database
                    //create a sql query
                    //for numerical donot ned pass value inside '' but string value it is to add '' 
                    $sql2 = "INSERT INTO tbl_food SET 
                        title = '$title',
                        description = '$description',

                        price = $price,
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'

                        
                    ";
                    //execute the query
                    $res2 = mysqli_query($conn,$sql2);
                    if($res2==true)
                    {
                        //data inserted success
                        $_SESSION['add']= "<div class= 'success' > Food Added successfully. </div>";
                    header('location:'.SITEURL.'admin/manage-food.php');


                    }else
                    {
                        //data failed
                        $_SESSION['add']= "<div class= 'error' > Food Added failed. </div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    
                    //4.redirecte wirh message to managefood


            
                }
            
            ?>



    </div>
</div>

<?php include('partials/footer.php'); ?>
