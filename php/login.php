<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn , $_POST['email']);
    $password = mysqli_real_escape_string($conn , $_POST['password']);
    
    if((!empty($email)) && (!empty($password))){
        // check for the match of given email & it's password is as same as in Database - (chat)
        $sql = mysqli_query($conn , "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
        $status = "Online";
        // set the status in database - (chat) in table - (users) in column - (status) as ("OffLine ... !")
        $sql2 = mysqli_query($conn , "UPDATE  users SET status = '{$status}' WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){ // if the given email & password is matched with the email & password in Database - (chat)
            $row = mysqli_fetch_assoc($sql);
            $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique_id in other php file
            echo "Success";
        }else{
            echo "Email or Password is Incorrect ... !";
        }
    }else{
        echo "All Input Fields Are Required !...";
    }
?>