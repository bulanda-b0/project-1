<?php
                @include'config.php';
                // session_name('login_session');
                session_start();
                if (isset($_POST['submit']))
            {
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $npassword = mysqli_real_escape_string($conn, $_POST['npassword']);
    
                $select = " SELECT * FROM signup_form WHERE email='$email' && npassword='$npassword'";
    
                $result = mysqli_query($conn, $select);
                
                if(mysqli_num_rows($result) > 0)
                {

                    $_SESSION['loggedin'] = true;

                    $row = mysqli_fetch_array($result);
                    if($row['usertype'] == 'owner'){

                        $_SESSION['owner_id'] = $row['user_id'];
                        $_SESSION['owner_firstname'] = $row['firstname'];
                        $_SESSION['owner_middlename'] = $row['middlename'];
                        $_SESSION['owner_lastname'] = $row['lastname'];
                        $_SESSION['owner_addr'] = $row['addr'];
                        $_SESSION['owner_mobileno'] = $row['mobileno'];
                        $_SESSION['owner_email'] = $row['email'];
                        $_SESSION['usertype'] = $row['usertype'];
                        $_SESSION['profile_img'] = $row['profile_img'];

                        header('location: owner_page.php');

                    } elseif($row['usertype'] == 'tenant'){

                        $_SESSION['tenant_id'] = $row['user_id'];
                        $_SESSION['tenant_firstname'] = $row['firstname'];
                        $_SESSION['tenant_middlename'] = $row['middlename'];
                        $_SESSION['tenant_lastname'] = $row['lastname'];
                        $_SESSION['tenant_addr'] = $row['addr'];
                        $_SESSION['tenant_mobileno'] = $row['mobileno'];
                        $_SESSION['tenant_email'] = $row['email'];
                        $_SESSION['usertype'] = $row['usertype'];
                        $_SESSION['profile_img'] = $row['profile_img'];

                        header('location: tenant_page.php');

                    } 
                } else{

                    $error[] = 'incorrect email or password';
                }
                    
                
    
            };


?>





<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="login.css">
  <title>Room Mart Login</title>
</head>
<body>
   
    <!-- login container  -->
  <div class="login">
    <h3>login into room mart</h3>
    <form action="" method="POST" >
      <input type="email" name="email" id="email" placeholder="Enter your email" required>
      <input type="password" name="npassword" placeholder="Password" id="npassword" required>
      
      <button type="submit" name="submit" onclick="login()">Login</button>
    </form>

    <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<p>'.$error.'</p>';
                }
            }
        ?>


      <!-- or    -->
        <div class="textor">Don't have an account? <a href="signup.php">Register</a></div>

        <!-- for forget password  -->
        <div class="forgotpsw">
            <a href="forgot.php">forgot password?</a>
        </div>
        
    
  </div>

        
</body>
</html>



