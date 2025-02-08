<?php
    include_once "config.php";

    if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password'])){
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){ 

                $sql = mysqli_query($conn, "SELECT email FROM candidate WHERE email = '{$email}'");
                if(mysqli_num_rows($sql) > 0){
                    echo "Email already exists";
                } else { 
                    if(isset($_FILES['image'])){ 
                        $img_name = $_FILES['image']['name']; 
                        $tmp_name = $_FILES['image']['tmp_name'];

                        $img_explode = explode(".", $img_name);
                        $img_extension = strtolower(end($img_explode));

                        $extension = ['png', 'jpg', 'jpeg']; 
                        if(in_array($img_extension, $extension) === true){ 
                            $time = time(); 
                            $new_img_name = $time.$img_name;
                            
                            if(move_uploaded_file($tmp_name, "images/".$new_img_name)){
                                $random_id = rand(time(), 10000000);
                                
                                $sql2 = mysqli_query($conn, "INSERT INTO `candidate` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`) VALUES (NULL, '{$random_id}', '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}')");
                                if($sql2){ 
                                    $sql3 = mysqli_query($conn, "SELECT * FROM candidate WHERE email = '{$email}'");
                                    if(mysqli_num_rows($sql3) > 0){
                                        $row = mysqli_fetch_assoc($sql3);
                                        $_SESSION['unique_id'] = $row['unique_id'];
                                        echo "success";
                                    }
                                } else {
                                    echo "Something went wrong";
                                }   
                            }
                        } else {
                            echo "Please select an image file - png, jpg, jpeg!";
                        }
                    } else {
                        echo "Please upload an image file";
                    }
                }
            } else {
                echo "Invalid Email Address";
            }
        } else {
            echo "All input fields are required";
        }
    } else {
        echo "Form submission failed";
    }
?>
