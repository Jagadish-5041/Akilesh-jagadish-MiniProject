<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php"; 
        $outgoing_id = mysqli_real_escape_string($conn , $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn , $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn , $_POST['message']);
        $output = "";

        $sql = "SELECT * FROM messages 
            LEFT JOIN users ON users.unique_id = messages.incoming_msg_id 
            WHERE ((outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (incoming_msg_id = {$outgoing_id} AND outgoing_msg_id = {$incoming_id})) ORDER BY msg_id";
        $query = mysqli_query($conn , $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){ // if it's true means it's for sure the MESSAGE SENDER
                    $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                </div>';
                }else{ // it's for sure the MESSAGE RECEIVER
                    $img_query = "SELECT * FROM users WHERE unique_id = {$incoming_id}";
                    $img_sql = mysqli_query($conn , $img_query);
                    $img_row = mysqli_fetch_assoc($img_sql); 
                    $output .= '<div class="chat incoming">
                                    <img src="php/images/'. $img_row['img'] . '" alt="">
                                    <div class="details">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                </div>';
                }
            }
            echo $output;
        }
    }else{
        header("../login.php");
    }
?>