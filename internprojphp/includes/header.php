<?php 
require 'config/config.php';
if (isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username']; 
    $user_details_query = mysqli_query($con,"SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}else{
    header("Location:register.php");
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://kit.fontawesome.com/894765f1bb.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="top_bar">
        <div class = "logo">
            <a href ="index.php">SwishFeed</a>
        </div>
        <nav>
            <a href="<?php echo $userLoggedIn;?>">
                <?php
                echo $user['first_name'];
                ?>
            </a>
            <a href="#"><i class="fa-solid fa-house"></i></a>
            <a href="#"><i class="fa-regular fa-envelope"></i></a>
            <a href="#"><i class="fa-solid fa-bell"></i></a>
            <a href="#"><i class="fa-solid fa-users-line"></i></a>
            <a href="#"><i class="fa-solid fa-gear"></i></a>
            <a href="includes/handlers/logout.php"><i class="fa-solid fa-right-to-bracket"></i></a>
            
        </nav>
    </div>
     <div class="wrapper">
