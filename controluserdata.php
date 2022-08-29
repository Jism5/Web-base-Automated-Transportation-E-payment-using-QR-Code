<?php
session_start();
require "config.php";
$email = "";
$name = "";
$contact = "";
$address = "";
$errors = array();


//if rider sign up button
if(isset($_REQUEST['submit'])){

    $name = ($_POST['name']);
    $email = ($_POST['email']);
    $contact = ($_POST['contact']);
    $address = ($_POST['address']);
    $plate = ($_POST['plate']);
    $license = ($_POST['license']);
    $password = ($_POST['password']);
    $cpassword = ($_POST['cpassword']);
    date_default_timezone_set('Asia/Manila');
    $date = date('y-m-d');
    

    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }
    // check email
    $email_check = "SELECT * FROM userdata WHERE email = '$email'";
    $res = mysqli_query($conn, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $type = "rider";
         

        $insert_data = "INSERT INTO userdata (role, email,password,code, status) 
                        values('$type', '$email','$encpass','$code', '$status')";
        $data_check = mysqli_query($conn, $insert_data);

        $getid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM userdata WHERE email = '$email'"));
        $id11 = $getid['id'];
        $info = "INSERT INTO rider_info(name, riders_id, contact,address, plate, license,created, storage, cashout_status, image_url, license_url, verify_status, time_in, time_out) 
        values('$name','$id11', '$contact', '$address', '$plate', '$license', $date,0,'','','','','','')";
        $datacheck1 = mysqli_query($conn, $info);

        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: arendatoda@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
            echo mysqli_error($conn);
        }
    }

}



            //if user click verification code submit button
            if(isset($_POST['check'])){
                $_SESSION['info'] = "";
                $otp_code = ($_POST['otp']);
                $check_code = "SELECT * FROM userdata WHERE code = $otp_code";
                $code_res = mysqli_query($conn, $check_code);
                if(mysqli_num_rows($code_res) > 0){
                    $fetch_data = mysqli_fetch_assoc($code_res);
                    $fetch_code = $fetch_data['code'];
                    $email = $fetch_data['email'];
                    $code = 0;
                    $status = 'verified';
                    $update_otp = "UPDATE userdata SET code = $code, status = '$status' WHERE code = $fetch_code";
                    $update_res = mysqli_query($conn, $update_otp);
                    if($update_res){
                        $_SESSION['name'] = $name;
                        $_SESSION['email'] = $email;
                        header('location: Login.php');
                        exit();
                    }else{
                        $errors['otp-error'] = "Failed while updating code!";
                    }
                }else{
                    $errors['otp-error'] = "You've entered incorrect code!";
                }
            }

            
            
    //if user click login button
    if(isset($_POST['login'])){
        $email = ($_POST['email']);
        $password = ($_POST['password']);
        $check_email = "SELECT * FROM userdata WHERE email = '$email'";
        $res = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                  $role = $fetch['role'];
                  // for user
                  if($role == 'user' ){  
                            if(!empty($_POST['remember_me'])){
                            setcookie("email", $email, time()+ (10*365*24*60*60) );
                            setcookie("password", $password, time()+ (10*365*24*60*60) );
                            header('location: index.php');       
                    }else{
                        header('location: index.php');       
                    }                                    
                    }elseif($role == 'rider'){
                        header("location: Rider.php");
                    }elseif($role == 'admin'){
                        header("location: Admin.php");
                    }
                   
                }else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }else{
                $errors['email'] = "Incorrect email or password!";
            }
        }else{
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = ( $_POST['email']);
        $check_email = "SELECT * FROM userdata WHERE email='$email'";
        $run_sql = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE userdata SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($conn, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: arendatoda@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = ($_POST['otp']);
        $check_code = "SELECT * FROM userdata WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = ($_POST['password']);
        $cpassword = ($_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE userdata SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($conn, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: Login.php');
    }


    // scanner process
    if(isset($_POST['text'])){
        $text = $_POST['text'];
        // get the variable of the qr code
        $email = $_SESSION['email'];
        $select = "SELECT * FROM passenger_info WHERE  passenger_id ='$text'";
        $result = mysqli_query($conn, $select);
        $catch = mysqli_fetch_assoc($result);
        

        // // get commuter table
        $row = $catch['passenger_id'];
        $qry1 = mysqli_query($conn,"SELECT * FROM passenger_info WHERE passenger_id = '$row'");
        $row1 = mysqli_fetch_assoc($qry1);
        $current = $row1['balance'];
        $fare1 = $row1['fare'];

        // get rider's table
        $crider = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM userdata WHERE email = '$email'"));
        $criderid = $crider['id'];
        $qry2 = mysqli_query($conn,"SELECT * FROM rider_info WHERE riders_id = '$criderid'");
        $row2 = mysqli_fetch_assoc($qry2);
        $storage = $row2['storage'];
        $id = $row2['riders_id'];

         // check commuter's balance if enough
       if($current < $fare1 or $fare1 == 0){
           header("location: nobal.php?pid=$row");
       }
       else{
           // proceed to deduction from rider to commuter
            $subtotal = $current - $fare1;
           //update the balance of commuter
            $usernew = mysqli_query($conn, "UPDATE passenger_info SET balance='$subtotal' WHERE  passenger_id = '$row'");
            // proceed to addition from commuter to rider
            $ridertotal = $storage + $fare1; 
            //update rider's balance
            $ridernew = mysqli_query($conn, "UPDATE rider_info SET storage ='$ridertotal' WHERE riders_id = $id");    
            header("location: receipt.php?pid=$row");
            
       }      
    }  
    
?>