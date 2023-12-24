<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Swishfeed!</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
    <?php

    if(isset($_POST['register_button'])){
        echo '
        <script>
        $(document).ready(function(){
            $("#first").hide();
            $("#second").hide();
            
        });
        </script>
        ';
    }
     ?>


    <div class="wrapper">
        
        <div class="login_box">
            <div class="login_header">
                <h1>SwishFeed</h1>
                Login or sign up below
            </div>

            <div id="first">
                <form action="register.php" method="POST">
                <input type="text" name="log_email" placeholder="Email address" value="<?php if(isset($_SESSION['log_email'])){
                echo $_SESSION['log_email'];
                } ?>" required>
                <br>
                <input type="password" name="log_password" placeholder="Password" value="<?php if(isset($_SESSION['log_password'])){
                echo $_SESSION['log_password'];
                } ?>" required>
                <br>
                <input type="submit" name ="login_button" value="Login"><br>
                <?php if(in_array("Either email or password is incorrect<br>",$error_array)){ echo "Either email or password is incorrect<br>";} ?>
                <a href="#" id="signup" class="signup">Need an account,Register Here!</a>
                </form>

            </div>
        

        <br>
        <div id="second">
            <form action="register.php" method="POST">
            
            <input type="text" name="reg_fname" placeholder="First Name" value="<?php if(isset($_SESSION['reg_fname'])){
                echo $_SESSION['reg_fname'];
            } ?>" required>
            <br/>
            <?php if(in_array("First name should be between 2 and 25 characters<br>",$error_array)){ echo "First name should be between 2 and 25 characters<br>";} ?>



            <input type="text" name="reg_lname" placeholder="Last Name" value="<?php if(isset($_SESSION['reg_lname'])){
                echo $_SESSION['reg_lname'];
            } ?>" required>
            <br/>
            <?php if(in_array("Last name should be between 2 and 25 characters<br>",$error_array)){ echo "Last name should be between 2 and 25 characters<br>";} ?>



            <input type="email" name="reg_email" placeholder="Email" value="<?php if(isset($_SESSION['reg_email'])){
                echo $_SESSION['reg_email'];
            } ?>" required>
            <br/>
            
            <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php if(isset($_SESSION['reg_email2'])){
                echo $_SESSION['reg_email2'];
            } ?>" required>
            <br/>
            <?php if(in_array("Email already used<br>",$error_array)){ echo "Email already used<br>";} 
            else if(in_array("Invalid email format<br>",$error_array)){ echo "Invalid email format<br>";} 
            else if(in_array("Emails don't match<br>",$error_array)){ echo "Emails don't match<br>";} ?>
            


            <input type="password" name="reg_password" placeholder="Password" required>
            <br/>
            <input type="password" name="reg_password2" placeholder="Confirm Password" required>
            <br/>
            <?php if(in_array("Passwords don't match<br>",$error_array)){ echo "Passwords don't match<br>";} 
            else if(in_array("Password should contain only alphanumeric characters<br>",$error_array)){ echo "Password should contain only alphanumeric characters<br>";} 
            else if(in_array("Password length should be between 5 and 30 characters<br>",$error_array)){ echo "Password length should be between 5 and 30 characters<br>";} ?>
            
            <input type="submit" name="register_button" value="Register">
            <br>
            <?php if(in_array("<span style='color: #14C800;'>You are all set! go ahead and login!</span><br>",$error_array)){ echo "<span style='color: #14C800;'>You are all set! go ahead and login!</span><br>";} ?>

            <a href="#" id="signin" class="signin">Already having an account,Sign Here!</a>
        </form>
       

        </div>
         </div>
    </div>
    
</body>
</html>