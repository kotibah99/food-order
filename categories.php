<?php include('partials-front/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
                    //create sql query to disply Category from DB
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                    //Execute the Query
                    $res = mysqli_query($conn , $sql);
                    //Count rows
                    $count = mysqli_num_rows($res);
                    if($count>0)
                    {
                        //Categories Available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get value id , title, image_name
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            ?>
                               <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php
                                    //check whether image is avaiable
                                        if($image_name=="")
                                        {
                                            //Display message
                                            echo "<div class= 'error'>Image not Available</div> ";
                                        } else
                                        {
                                            //Image Available
                                            ?>
                                                <img src= "<?php echo SITEURL;?>images/category/<?php echo $image_name; ?> "  alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?> 
                                    

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                                </a>

                            <?php
                        }

                    }
                    else{
                        //Categories no Available
                        echo "<div class = 'error'> Category not Added  </div> ";

                    }

                ?>
          
            <a href="category-foods.html">
            <div class="box-3 float-container">
                <img src="images/pizza.jpg" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white">Pizza</h3>
            </div>
            </a>

            

            <div class="clearfix"></div>
        </div>
    </section>
 
    <?php include('partials-front/footer.php'); ?>



