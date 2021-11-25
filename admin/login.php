
<?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html>
<head>
  
    <title> Login food-order system</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/admin.css">

</head>
<body>
<div class="login">
<h1 class="text-center">login</h1>
<br><br>
<?php if(isset($_SESSION['login']))
{
    echo $_SESSION['login'];
    unset($_SESSION['login']);
} 
if(isset($_SESSION['no-login-message']))
{
    echo $_SESSION['no-login-message'];
    unset($_SESSION['no-login-message']);

}
?>
<br>
<br>
<!-- login form starts Here -->
<form action="" method="POST" class="text-center">
 Username:
 <br>
 <input type="text"name="username" placeholder="Enter username"><br><br>
 password:
 <br>
 <input type="password" name="password" placeholder="Enter password"><br>
 <br>
 <input type="submit"name="submit" value="login" class="btn-primary">
 <br><br>
</form>
<!-- login form end Here -->

<p class="text-center">Create By - <a href="www.kotibahMohamad.com"> kotibahMohamad </a></p>
</div>
    
</body>
</html>
<?php
//ckeck whether the submit Button is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //1.Get the data from login form
     $username = $_POST['username'];
    $password = md5($_POST['password']);
    //2. sql to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username'AND password ='$password'";

    //3. execute query
    $res = mysqli_query($conn , $sql);

    //4. count rows to check whether exists or not
    $count = mysqli_num_rows($res);
    if($count==1)
    {
        //User  Available AND success
        $_SESSION['login']="<div class='success'> Login Successfuly. </div>";
        $_SESSION['user'] = $username;//to check user the user is logged or not and loggout will unset it
        //redirect to Home
        header('location:'.SITEURL.'admin/');


    }else
    {
        //User not Available
        $_SESSION['login']="<div class='error text-center'>username or password not Match </div>";
        header('location:'.SITEURL.'admin/login.php');

    }
}
?>