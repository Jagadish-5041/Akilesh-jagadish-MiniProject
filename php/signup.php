<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn , $_POST['fname']);
    $lname = mysqli_real_escape_string($conn , $_POST['lname']);
    $email = mysqli_real_escape_string($conn , $_POST['email']);
    $password = mysqli_real_escape_string($conn , $_POST['password']);

    if((!empty($fname)) && (!empty($lname)) && (!empty($email)) && (!empty($password))){
        // let's check user email is valid or not
        if(filter_var($email , FILTER_VALIDATE_EMAIL)){
            // let's check that email already exist in the database or not
            $sql = mysqli_query($conn , "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                // email already exists then
                echo "$email - Exists Already !";
            }else{
                // Check for file uploading
                if(isset($_FILES['image'])){ // if the image file is uploaded 
                    $img_name = $_FILES['image']['name']; // user uploaded image's name
                    $tmp_name = $_FILES['image']['tmp_name']; // user uploaded image's temporary name which is used to save (or) move file in our folder
                    $img_explode = explode('.' , $img_name);
                    $img_ext = end($img_explode); // The extension of the user uploaded img is caught here
                    $extensions = ['png' , 'jpeg' , 'jpg']; // All The Valid Image Extensions are stored in this Array
                    if(in_array($img_ext , $extensions) === true){ // if user uploaded the image with a valid extension like the uploaded image's extension has been found in the "extension" array !
                        $time = time(); // it will return the current time
                                        // with this current time we rename the uploaded image file with this current time cuz it'll help the file have an unique name
                                        // so all the image file with an unique name (image uploaded time)
                        $new_img_name = $time.$img_name; // The current time is prepended with the user uploaded image's name even though if the user uploads same image the time will be different ,
                                                         // which is prepended with the file name which makes it unique
                        
                        if(move_uploaded_file($tmp_name , "images/".$new_img_name)){ // if the user uploaded image is moved to our images folder successfully
                            $status = "Online"; // once user signed up then his status will be Active Now
                            $random_id = rand(time() , 10000000); // creating random ID for user

                            // Now insert all the user data into the Database - (chat) -> Table - (users)
                            $sql2 = mysqli_query($conn , "INSERT INTO users (unique_id , fname , lname , email , password , img , status) VALUES ('{$random_id}' , '{$fname}' , '{$lname}' , '{$email}' , '{$password}' , '{$new_img_name}' , '{$status}')");
                            if($sql2){ // if data inserted into Database - (chat) successfully
                                $sql3 = mysqli_query($conn , "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique_id in other php file
                                    echo "Success";
                                }
                            }else{
                                echo "Something Went Wrong ... ! ";
                            }
                        }
                    }else{
                        echo "Please Upload An Image File ... With Valid Extensions Like jpeg , jpg , png !";
                    }
                }else{
                    echo "Please Select An Image File ... ";
                }
            }
        }else{
            echo "$email - This is not a valid email";
        }
    }else{
        echo "All Input Fields Are Required !...";
    }
?>