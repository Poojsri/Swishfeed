<?php 
class User{
    private $user;
    private $con;

    public function __construct($con,$user){
        $this->con = $con;
        $user_details_query = mysqli_query($con,"SELECT * FROM users WHERE username='$user'");
        $this->user = mysqli_fetch_array($user_details_query);

    }
    public function getUserName(){
        return $this->user['username'];
    } 

    public function getNumPost(){
        $username = $this->user['username'];
        $query = mysqli_query($this->con,"SELECT num_posts FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['num_posts'];

    }

    public function getFirstAndLastName(){
        $username = $this->user['username'];
        $query= mysqli_query($this->con,"SELECT first_name,last_name FROM users WHERE username = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['first_name']. " ". $row['last_name'];
    }

    public function getProfilePic(){
        $username = $this->user['username'];
        $query= mysqli_query($this->con,"SELECT profile_pic FROM users WHERE username = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['profile_pic'];
    }

    public function isClosed(){
        if(isset($this->user['username'])){
            $username = $this->user['username'];
        }else{
            return;
        }
        
        $query = mysqli_query($this->con,"SELECT user_closed FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        if($row['user_closed']=='yes'){
            return true;
        }else{
            return false;
        }

    }

    public function isFriend($username_to_check){
        //returns true if the logged in user is friends with the user they are checking. Returns false otherwise.
        $usernameComma = ",". $username_to_check . ",";
        if(strstr($this->user['friend_array'],$usernameComma) || $username_to_check == $this->user['username']){
            return true;
        }else{ return false;}
         
    }

    public function didReceiveRequest($user_to){
        $user_from = $this->user['username'];
        $check_request_query = mysqli_query($this->con,"SELECT * FROM friend_requests WHERE user_to='$user_to' AND user_from='$user_from'");
        if(mysqli_num_rows($check_request_query)>0){
            return true;
        }else{
            return false;
        }
        
    }

    public function didSendRequest($user_from){
        $user_to = $this->user['username'];
        $check_request_query = mysqli_query($this->con,"SELECT * FROM friend_requests WHERE user_to='$user_to' AND user_from='$user_from'");
        if(mysqli_num_rows($check_request_query)>0){
            return true;
        }else{
            return false;
        }
        
    }

    public function removeFriend($user_to_remove){
        $logged_in_user = $this->user['username'];
        $query = mysqli_query($this->con,"SELECT friend_array FROM users WHERE username='$user_to_remove'");
        $row = mysqli_fetch_array($query);
        $friend_array_username = $row['friend_array'];

        $new_friend_array = str_replace($user_to_remove . ",","",$this->user['friend_array']);
        $remove_friend = mysqli_query($this->con,"UPDATE users SET friend_array='$new_friend_array' WHERE username='$logged_in_user'");

        $new_friend_array = str_replace($this->user['friend_array'] . ",","",$friend_array_username);
        $remove_friend = mysqli_query($this->con,"UPDATE users SET friend_array='$new_friend_array' WHERE username='$user_to_remove'");
        
    }

    public function sendRequest($user_to){
        $user_from = $this->user['username'];
        $query = mysqli_query($this->con,"INSERT INTO friend_requests VALUES('','$user_to','$user_from')");
        
    }
}

?>