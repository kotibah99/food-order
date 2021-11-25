<?php  include('partials/menu.php');  ?>


<div class=" main-content">
<div class="wrapper">
<h1> Change Password</h1>
<br>
<br>
<?php 
if(isset($_GET['id']))
{
    $id=$_GET['id'];
}

?>
<form action="" method="POST"> 
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td> 
                    <input type="password" name="current_password"placeholder="Current Password">
                     </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password"placeholder="New Password">
                    </td>
                </tr>
 
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password"name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                <tr>
                <td colspan="2">
                <input type="hidden"name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Change Password"class="btn-secondary">
                </td>
                </tr>

            </table>
        </form>

</div>
</div>
<?php

 //check whether athe submit Buttin is Clicked or not
 if(isset($_POST['submit']))
 {
     //echo "Button Clicked";
     //1.Get the data from form
     $id = $_POST['id'];
     $current_password = md5($_POST['current_password']);
     $new_password = md5($_POST['new_password']);
     $confirm_password =md5($_POST['confirm_password']);

     //2.check wehther the user Current Id and Currnet password exists or not
     $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password ='$current_password'";

     //Exucute the Query
     $res  = mysqli_query($conn,$sql);
     if($res==TRUE)
     {
         //Check whether the data is available or not
         $count = mysqli_num_rows($res);
         if($count==1)
         {
             //user Exists and password can be changed
            //echo "user Found";

            //check wheter the new password and confirm match or not
                if($new_password ==$confirm_password)
                {
                    //Update the password
              
                    $sql2 = "UPDATE tbl_admin SET
                    password = '$new_password',
                    WHERE id=$id
                    ";
                    //Excute the query
                    $res2 = mysqli_query($conn,$sql2);
                    //check whether the query executed or not
                    if($res2==TRUE)
                    {
                        //Display success message 
                         //redirect to manage admin page with error message
                    $_SESSION['change-pwd'] = " <div class='success'> password change successfuly.</div>";
                    //redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    
                   
                    }
                         else{
                            //Display Error message
                            $_SESSION['change-pwd'] =  " <div class='error'> password change failed.</div>";
                            //redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');
                            
                          
                               
                         }

                    
                }
                    else{
                    //redirect to manage admin page with error message
                    $_SESSION['pwd-not-match'] =  " <div class='error'> password did not match</div>";
                    //redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

         }else{
             //user not Exists set message and redirect
             $_SESSION['user-not-found'] =  " <div class='error'> user not found.</div>";
             //redirect the user
             header('location:'.SITEURL.'admin/manage-admin.php');
         }
     }

    // 3.check whether the new password and confirm_password Match or not

    //4.change the password if all above is true

     }
 
?>





<?php  include('partials/footer.php');  ?>
