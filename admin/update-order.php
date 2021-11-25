<?php  include('partials/menu.php');  ?>
<div class="main content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <?php
            if(isset($_GET['id']))
            {
                //Get the order details
                $id = $_GET['id'];
                //get all other details based on this id
                //sql query to get the details
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn , $sql);
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //details Available
                    $row = mysqli_fetch_assoc($res);
                   // $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

                }
                else
                {
                    //details not Available
                    //redirect to manage order
                header('location:'.SITEURL.'admin/manage-order.php');

                    


                }
            }
            else
            {
                //redirect to manage order
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>
        <br>
        <br>
        <form action="" method="POST" >
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td> 
                    <b>
                $<?php echo $price;?>
                    </b>
                    </td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="on Delivery") ?> value="on Delivery">on Delivery</option>
                            <option <?php if($status=="Delivery") ?> value="Delivery">Delivered</option>
                            <option <?php if($status=="Cancelled") ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text"name = "customer_name"value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text"name = "customer_contact"value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text"name = "customer_email"value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address :</td>
                    <td>
                      <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden"name="id" value="<?php echo $id; ?>">
                        <input type="hidden"name="price" value="<?php echo $price; ?>">
                        <input type="submit"name ="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if (isset($_POST['submit']))
            {
               //  echo "clicked";
               //get all values from form
               
       $id = $_POST['id'];

       $price = $_POST['price'];
     
       $qty = $_POST['qty'];

       $total =$price * $qty; //totalt =price * qty الكمية *السعر

     $order_date = date("Y-m-d h:i:sa");
      
     $status = $_POST['status'];//ordered , on Delivery ,Delivery,cancelled
     $customer_name =$_POST['customer_name'];
     $customer_contact =$_POST['customer_contact'];
     $customer_email =$_POST['customer_email'];
     $customer_address=$_POST['customer_address'];

               //update the value
               $sql2 = "UPDATE tbl_order SET
              food = '$food',
             price = $price,
             qty = $qty,
             total = $total,
              order_date = '$order_date',
              status = '$status',
             customer_name ='$customer_name',
             customer_contact ='$customer_contact',
             customer_email ='$customer_email',
             customer_address ='$customer_address'
             WHERE id =$id
               ";
               $res2 = mysqli_query($conn , $sql2);
               if($res2==true)
               {
                //update
           
                  $_SESSION['update'] = "<div class ='success text-center'>  order updated successfuly. </div>";
                header('location:'.SITEURL.'admin/manage-order.php');
                  

               }
               else
               {
                //failed
                $_SESSION['update'] = "<div class ='error text-center'>  order failed updated . </div>";
                header('location:'.SITEURL.'admin/manage-order.php');
                
               }
               //redirect
            }
        ?>
    </div>
</div>
<?php  include('partials/footer.php');  ?>
