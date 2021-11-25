<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1> manage category </h1>
    <br>
<br>
<br>
<?php 
        if(isset($_SESSION['add']))//checking whether theSession is set of not
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['remove']))//checking whether theSession is set of not
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if(isset($_SESSION['delete']))//checking whether theSession is set of not
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-category-found']))//checking whether theSession is set of not
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if(isset($_SESSION['update']))//checking whether theSession is set of not
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload']))//checking whether theSession is set of not
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['failed-remove']))//checking whether theSession is set of not
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br><br>
<!-- Button to add Admin -->
<a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">  Add category </a>
<br>
<br>
<br>
<table class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Image</th>
        <th>featured</th>
        <th>Active</th>

        <th>Actions</th>
    </tr>
    <?php 
    //Query to get all categories from database
        $sql  ="SELECT * FROM tbl_category";
        //exeute query
        $res = mysqli_query($conn , $sql);
        //count Rows
        $count = mysqli_num_rows($res);
        //create seiral Number var
        $sn=1;
        if($count>0)
        { 
            while($row=mysqli_fetch_assoc($res))
            {
                $id =$row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active=$row['active'];
                ?>
                                <tr>
                        <td><?php echo $sn++ ?>.</td>
                        <td><?php echo $title ?></td>

                        <td>
                          <?php 
                          // check whether image name is avaliable or not
                          if($image_name!="")
                          {
                                //Display image
                                ?>

                                <img src="<?php echo SITEURL ; ?>images/category/<?php echo $image_name; ?>" width="100px">

                                <?php

                          }else
                          {
                            echo "<div class='error'>image not Added.</div>";

                          }
                       
                           ?>
                        </td>

                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        
                        <td>
                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update category</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete category</a>
                        
                        </td>
                    </tr>
                    
                    

                <?php
            }

        }else{
            ?>
            <tr>
            <td colspan="6"> <div class="error"> NO category Added. </div></td>
            </tr>
            <?php


        }
    ?>
  

</table>


</div>
</div>
<?php include('partials/footer.php'); ?>