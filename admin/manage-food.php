<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1> manage food </h1>
    <br>
<br>
<!-- Button to add Admin -->
<a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">  Add food </a>
<br>
<br>
<br>
<?php
      if(isset($_SESSION['add']))
      {
          echo $_SESSION['add'];
          unset($_SESSION['add']);
      }


      if(isset($_SESSION['delete']))
      {
          echo $_SESSION['delete'];
          unset($_SESSION['delete']);
      }

      if(isset($_SESSION['upload']))
      {
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
      }
      
      if(isset($_SESSION['unautihorize']))
      {
          echo $_SESSION['unautihorize'];
          unset($_SESSION['unautihorize']);
      }
      if(isset($_SESSION['update']))
      {
          echo $_SESSION['update'];
          unset($_SESSION['update']);
      }
      
?>
<table class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action</th>
    </tr>
    <?php
        //create a sql query Get all the food
        $sql = "SELECT * FROM tbl_food";
        //Execute the query
        $res = mysqli_query($conn,$sql);
        //count rows to check whether we have foods or not
        $count = mysqli_num_rows($res);
        $sn=1;
        if($count > 0)
        {
            //we have food in dataBase
            //Get the foods from dataBase and Display
            while($row=mysqli_fetch_assoc($res))
            {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                
                $featured = $row['featured'];
                $active = $row['active'];
                ?>
                     <tr>
        <td><?php echo $sn++;?></td>
        <td><?php echo $title;?></td>
        <td>$<?php echo $price;?></td>
        <td><?php 
            if ($image_name=="")
            {
                echo "<div class = 'error'>Image not Added. </div>";
            }else {
                ?>
                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                <?php

            }
                
        
        ?></td>
        <td><?php echo $featured;?></td>
        <td><?php echo $active;?></td>
        <td>
        <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
        <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
        
        </td>
   </tr>
    
                <?php
            }

        }else {
            //food not added in dataBase
            echo "<tr> <td colspan='7' class='error'>Food not AddedYet.</td> </tr>";
        }
    ?>
   

</table>

</div>
</div>
<?php include('partials/footer.php'); ?>