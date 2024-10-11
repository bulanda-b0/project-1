
<?php

include 'config.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect the user to the login page
    header('Location: login.php');
    exit;
}




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks for booking</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            background-color: deeppink;
        }
        .thank-you{
            width: 400px;
            height: 300px;
            background-color: black;
            margin-left: 500px;
            margin-top: 100px;
            border-radius: 40px;
            padding: 40px;
            

        }
        .text1{
            background-color: black;
            color: white;
            font-style: italic;
            font-weight: 600;
            background-color: black;
            
            
        }
        .thanks{
            margin-left: 35px;
            margin-top: 20px;
            background-color: black;
            color: green;
        }
        .arrow-image{
            height: 60px;
            width: 60px;
            background-color: black;
            margin-top: 20px;
            margin-left: 40%;
            margin-bottom: 20px;
        }




    </style>
</head>
<body>
    

        <div class="thank-you">
            <h1 class="thanks" >
                Thanks For Booking!!
            </h1>
            <img src="photo/arrow.png" class="arrow-image" >
            <h1 class="text1" >
                <?php

                if(isset($_SESSION['usertype']) && $_SESSION['usertype']=='owner'){
                        echo '<a style="background-color:black; color:red; margin-left:25%; " href="owner_page.php">Home Profile</a>';
                }elseif(isset($_SESSION['usertype']) && $_SESSION['usertype']=='tenant'){
                    echo '<a style="background-color:black; color:red; margin-left:25%; " href="tenant_page.php">Home Profile</a>';

                }else{
                    session_unset();
                    session_destroy();
                    echo '<a href="login.php">Home Profile</a>';

                }





                ?>  
            </h1>
            

        </div>




</body>
</html>