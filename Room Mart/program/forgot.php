<?php
    @include'config.php';
    session_name('reset_session');
    session_start();

    //Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['send'])){

        $_SESSION['email'] = $_POST['email'];
        $user_email = $_SESSION['email'];

        $select = " SELECT * FROM signup_form WHERE email= '".$_SESSION['email']."'";
        $result = $conn->query($select);

        if($result->num_rows>0)
        {
            
            $_SESSION['random_otp'] = rand(1000000, 9999999);
            $v_otp = $_SESSION['random_otp'];


        //Load Composer's autoloader
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings              
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'project020g@gmail.com';                 
            $mail->Password   = 'isvv phyr xxty epvj';                             
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                    

            //Recipients
            $mail->setFrom('project020g@gmail.com', 'Room Mart');
            $mail->addAddress($user_email, 'User');     
        

            //Content
            $mail->isHTML(true);                                 
            $mail->Subject = 'OTP verification';
            $mail->Body    = "Your OTP verification code: <br> <b>'".$v_otp."'</b> <br>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


            
        }else
        {
            echo '<h2 style="color:red; margin-left:45%; " >Incorrect email!!</h2>';

        }

    }

    if(isset($_POST['reset'])){

        $otp = $_SESSION['random_otp'];
        $form_otp = $_POST['otp_code'];
        $new_pass = $_POST['new_pass'];
        $con_pass = $_POST['con_pass'];
        $email_key = $_SESSION['email'];

         if(isset($otp) && isset($form_otp) && ($otp==$form_otp) && ($new_pass==$con_pass)){

            $update =" UPDATE signup_form set npassword = '$new_pass', cpassword = '$con_pass' where email = '$email_key' ";

            mysqli_query($conn, $update);

            session_unset();
            session_destroy();
            header('location:login.php');


         }
         else{
            echo '<h3>Enter correct details!!</h3>';
         }



    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="forgot.css">
</head>
<body>


<div class="reset-pass">
    <h2>Reset Password</h2>
    <form class="form-1" action="" method="POST" >
        <input type="email" name="email" placeholder="Enter your registered email" required>
        <button type="submit" name="send" >Send OTP</button>
    </form>
    <h4>Enter OTP and New Password</h4>
    <form class="form-2" action="" method="POST" >
        <input class="form-2-otp" type="number" name="otp_code" placeholder="Enter otp code" required >

        <input class="i1" type="password" id="new-password" name="new_pass" placeholder="Enter new password*" pattern="^(?=.*\d).{6,}$" minlength="6" required >

        <input class="i2" type="password" id="confirm-password" name="con_pass" placeholder="Confirm new password*" pattern="^(?=.*\d).{6,}$" minlength="6" required >
        <p id="password-error" style="color:red; background-color:black; margin-left:15px; font-size: 25px; " >Invalid!!</p>
        

        <button type="submit" name="reset" id="submit-btn" >Reset</button>
    

    </form>

    <!-- validating two password -->
    <script>
           
            const passwordInput = document.getElementById("new-password");
            const confirmPasswordInput = document.getElementById("confirm-password");
            const passwordError = document.getElementById("password-error");
            const submitButton = document.getElementById("submit-btn");

            confirmPasswordInput.addEventListener("input", validatePassword);
            passwordError.style.display = 'none';

            function validatePassword(){
                if(passwordInput.value!==confirmPasswordInput.value){
                    passwordError.style.display = 'inline';
                    confirmPasswordInput.classList.add("error-input");
                    submitButton.disabled = true;
                }
                else{
                    passwordError.style.display = 'none';
                    confirmPasswordInput.classList.remove("error-input");
                    submitButton.disabled=false;
                }

                function validateForm(){
                    return !submitButton.disabled;
                }
            } 
        </script>



</div>
    
</body>
</html>