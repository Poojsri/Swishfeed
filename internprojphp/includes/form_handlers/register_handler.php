<?php 

$fname = "";
$lname = "";
$em = "";
$em2 = "";
$pwd = "";
$pwd2 = "";
$date = "";
$error_array = array();

if(isset($_POST['register_button'])){
    //first name
    $fname = strip_tags($_POST['reg_fname']);
    $fname = str_replace(" ",'',$fname);
    $fname = ucfirst(strtolower($fname)); 
    $_SESSION['reg_fname'] = $fname;

    //last name
    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(" ",'',$lname);
    $lname = ucfirst(strtolower($lname)); 
    $_SESSION['reg_lname'] = $lname;

    //email
    $em = strip_tags($_POST['reg_email']);
    $em = str_replace(" ",'',$em);
    $em = ucfirst(strtolower($em)); 
    $_SESSION['reg_email'] = $em;

    //confirm Email
    $em2 = strip_tags($_POST['reg_email2']);
    $em2 = str_replace(" ",'',$em2);
    $em2 = ucfirst(strtolower($em2)); 
    $_SESSION['reg_email2'] = $em2;

    //pwd and confirm pwd
    $pwd = strip_tags($_POST['reg_password']);
    $pwd2 = strip_tags($_POST['reg_password2']);

    $date = date("Y-m-d");

    if($em == $em2){
        if(filter_var($em,FILTER_VALIDATE_EMAIL)){
            $em = filter_var($em,FILTER_VALIDATE_EMAIL);

            //if email exists
            $e_check = mysqli_query($con,"SELECT email FROM users WHERE email='$em'");

            //count no of rows
            $num_rows = mysqli_num_rows($e_check);

            if($num_rows>0){
                echo array_push($error_array,"Email already used<br>");
            }

        }else{
            echo array_push($error_array,"Invalid email format<br>") ;
        }

    }else{
        echo array_push($error_array,"Emails don't match<br>");
    }

    if(strlen($fname)>25 || strlen($fname)<2){
        echo array_push($error_array,"First name should be between 2 and 25 characters<br>");
    }
    if(strlen($lname)>25 || strlen($lname)<2){
        echo array_push($error_array,"Last name should be between 2 and 25 characters<br>");
    }
    if($pwd != $pwd2){
        echo array_push($error_array,"Passwords don't match<br>");
    }else{
        if(preg_match('/[^A-Za-z0-9]/',$pwd)){
            echo array_push($error_array,"Password should contain only alphanumeric characters<br>");
        }
    }
    if(strlen($pwd) > 30 || strlen($pwd)<5){
        echo array_push($error_array,"Password length should be between 5 and 30 characters<br>");

    }
    if(empty($error_array)){
        $pwd = md5($pwd);

        //username generate by concat
        $username = strtolower($fname."_".$lname);
        $check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");

        $i = 0;
        while(mysqli_num_rows($check_username_query)!=0){
            $i++;
            $username = $username + "_" + $i;
            $check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");
        }

        $rand = rand(1,2);
        if($rand==1){
        $profile_pic = 'assets/images/profile_pics/defaults/head_deep_blue.png';
        }
        else if ($rand==2){
            $profile_pic = 'assets/images/profile_pics/defaults/head_emerald.png';
        }
        $query = mysqli_query($con,"INSERT INTO users VALUES('','$fname','$lname','$username','$em','$pwd','$date','$profile_pic','0','0','no',',') ");

        array_push($error_array,"<span style='color: #14C800;'>You are all set! go ahead and login!</span><br>");

        //clear
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";

    }
     
}
?>