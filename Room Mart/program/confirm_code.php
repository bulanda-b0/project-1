
<?php 
@include'config.php';
// error_reporting(0);
session_name('signup_session');
session_start();


if (!isset($_SESSION['register']) || $_SESSION['register'] !== true) {
        
    header('Location: signup.php');
    exit;
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$user_fname = $_SESSION['s_fname'];
$user_mname = $_SESSION['s_mname'];
$user_lname = $_SESSION['s_lname'];
$user_email = $_SESSION['s_email'];
$user_number = $_SESSION['s_mnum'];
$user_addr = $_SESSION['s_addr'];
$user_npass = $_SESSION['s_npass'];
$user_cpass = $_SESSION['s_cpass'];
$user_usertype = $_SESSION['s_usertype'];

if(isset($_POST['send_otp'])){

$_SESSION['random_otp'] = rand(100000, 999999);
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
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}






if(isset($_POST['send'])){
    $entered_otp = $_POST['otp_code']; 
    $v_otp2 = $_SESSION['random_otp'];

    if($entered_otp == $v_otp2 ){

        $insert = " INSERT INTO signup_form(firstname, middlename, lastname, email, mobileno, addr, npassword, cpassword, usertype) VALUES('$user_fname','$user_mname','$user_lname','$user_email','$user_number','$user_addr','$user_npass','$user_cpass','$user_usertype')";

        mysqli_query($conn, $insert);
        session_unset();
        session_destroy();
        header('location:login.php');

    }else {

        echo '<h2>Incorrect Code!! Send again if any problem receiving code.</h2>';

    }
    




}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm code</title>
    <style>

        *{
            background-color: whitesmoke ;
            margin: 0;
            padding: 0;
        }
        .code-receive{
            margin-top: 220px;
            margin-left: 500px;
            height: 400px;
            width: 300px;
            background-color: black;
            border-radius: 40px;
        }
        .code-receive h2{
            color: white;
            width: 200px;
            padding-top: 10px;
            background-color: black;
            margin-left: 40px;
        }
        .form-code{
            background-color: black;
        }
        .send-otp-form{
            background-color: black;
            margin-top: 50px;
        }
        .send-otp-form button{
            margin-top: 30px;
            margin-left: 100px;
            margin-bottom: 20px;
            padding: 7px;
            background-color: blueviolet ;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }
        .send-otp-form button:active {
            transform: scale(1.2);
        }
        .form-code input{
            height: 40px;
            width: 200px;
            margin-left: 40px;
            margin-top: 40px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: black;
            font-size: 20px;
        }
        .form-code button{
            padding: 10px;
            background-color: red;
            color: white;
            margin-left: 110px;
            border-radius: 10px;
            cursor: pointer;
               
        }
        .form-code button:active{
                transform: scale(0.7) ;
            }
            .form-code button:hover{
                background-color: darkred;

            }




    </style >

    <script type="text/javascript" >
        window.onbeforeunload =function(){
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "destroy_session.php", false);
            xhr.send();
        }

    </script>

</head>
<body>
        
    <div class="code-receive">
        <form class="send-otp-form" action="" method="POST" >
            <button type="submit" name="send_otp" >Send OTP</button>

        </form>

    <h2>Confirm OTP code</h2>
        <form class="form-code" action="" method="POST" >
            <input type="number" name="otp_code" required ><br>
            <button type="submit" name="send" >Confirm</button>

        </form>

    </div>
    
</body>
</html>