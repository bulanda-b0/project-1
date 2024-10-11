<?php

    @include 'config.php';
    session_start();
    error_reporting(0);

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        // Redirect the user to the login page
        header('Location: login.php');
        exit;
    }

    if(isset($_POST['submit'])){

        $usertype = $_SESSION['usertype'];
        $user_id = ($usertype === 'owner') ? $_SESSION['owner_id'] : $_SESSION['tenant_id'];

        $select = "SELECT * FROM signup_form WHERE user_id='$user_id'";
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($result);

        $fname = ($_POST['firstname'] !== '') ? mysqli_real_escape_string($conn, $_POST['firstname']) : $row['firstname'];

        $mname = ($_POST['middlename'] !== '') ? mysqli_real_escape_string($conn, $_POST['middlename']) : $row['middlename'];

        $lname = ($_POST['lastname'] !== '') ? mysqli_real_escape_string($conn, $_POST['lastname']) : $row['lastname'];

        $addr = ($_POST['addr'] !== '') ? mysqli_real_escape_string($conn, $_POST['addr']) : $row['addr'];

        $mobileno = ($_POST['mobileno'] !== '') ? mysqli_real_escape_string($conn, $_POST['mobileno']) : $row['mobileno'];

        $email = ($_POST['email'] !== '') ? mysqli_real_escape_string($conn, $_POST['email']) : $row['email'];

        $npassword = ($_POST['npassword'] !== '') ? mysqli_real_escape_string($conn, $_POST['npassword']) : $row['npassword'];

        $cpassword = ($_POST['cpassword'] !== '') ? mysqli_real_escape_string($conn, $_POST['cpassword']) : $row['cpassword'];


        if(isset($_FILES['uploadphoto']) && $_FILES['uploadphoto']['error'] === UPLOAD_ERR_OK) {
            $name = $_FILES['uploadphoto']['name'];
            $tmpName = $_FILES['uploadphoto']['tmp_name'];
          
            // Save the uploaded image to a directory
            $uploadDir = 'images/';
            $path = $uploadDir . $name;
            move_uploaded_file($tmpName, $path);
          }else{
            $path = $row['profile_img'];
          }



        $update = "UPDATE signup_form SET firstname='$fname', middlename='$mname', lastname='$lname',mobileno='$mobileno', addr='$addr', email='$email', npassword='$npassword', cpassword='$cpassword', profile_img='$path'  WHERE user_id='$user_id'";

        mysqli_query($conn, $update);

        if ($usertype === 'owner') {
            $_SESSION['owner_firstname'] = $fname;
            $_SESSION['owner_middlename'] = $mname;
            $_SESSION['owner_lastname'] = $lname;
            $_SESSION['owner_addr'] = $addr;
            $_SESSION['owner_email'] = $email;
            $_SESSION['owner_mobileno'] = $mobileno;
            $_SESSION['profile_img'] = $image;


        } else {
            $_SESSION['tenant_firstname'] = $fname;
            $_SESSION['tenant_middlename'] = $mname;
            $_SESSION['tenant_lastname'] = $lname;
            $_SESSION['tenant_addr'] = $addr;
            $_SESSION['tenant_email'] = $email;
            $_SESSION['tenant_mobileno'] = $mobileno;
            $_SESSION['profile_img'] = $image;

        }

        if(isset($_SESSION['usertype']) && $_SESSION['usertype']=='owner'){
            header('location: owner_page.php');
    }elseif(isset($_SESSION['usertype']) && $_SESSION['usertype']=='tenant'){
        header('location: tenant_page.php');

    }else{
        session_unset();
        session_destroy();
        header('location: login.php');

    }
        

    }




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" type="text/css" href="edit_details.css">

</head>
<body>

    <div class="update-profile">
        <div class="title">
            <span>update your required information</span>
        </div>


        <form action="" method="post" class="update-form" id="input-form" enctype="multipart/form-data" >
            <input type="text" name="firstname" id="firstname" onkeydown="jumpToNextInput(event,'middlename')" placeholder="First name" >

            <input type="text" name="middlename" id="middlename" onkeydown="jumpToNextInput(event,'lastname')" placeholder="Middle name" >

            <input type="text" name="lastname" id="lastname" onkeydown="jumpToNextInput(event,'email')"  placeholder="Last name" >

            <input type="email" name="email" id="email" onkeydown="jumpToNextInput(event,'mobileno')" placeholder="email address" >

            <input type="tel" name="mobileno" id="mobileno" onkeydown="jumpToNextInput(event,'address')" placeholder="mobile number" maxlength="10">
            <span id="phone-error" class="error-phone-message">invalid!!</span>

            <input type="address" name="addr" id="address"onkeydown="jumpToNextInput(event,'new-password')" placeholder="full address" >

            <input type="password" id="new-password" name="npassword" onkeydown="jumpToNextInput(event,'confirm-password')" placeholder="new password" pattern="^(?=.*\d).{6,}$" minlength="6" >

            <input style="margin-bottom: 40px; " type="password" id="confirm-password" name="cpassword" placeholder="confirm password" pattern="^(?=.*\d).{6,}$" minlength="6" ><span id="password-error" class="error-message">Invalid!!</span>

            <span style="margin-left: 20px; color: green ; " >Edit Profile Picture</span>

            <input style="background-color: pink ; " type="file" name="uploadphoto" value="" accept="image/*" >
          
             

            <button type="submit" name="submit" id="submit-btn" value="submit" style="font-weight: 400; " > Update Profile </button>

        </form>

    </div>
    <script>
        // for validating two passwors and disabling submit button
      const passwordInput = document.getElementById("new-password");
      const confirmPasswordInput = document.getElementById("confirm-password");
      const passwordError = document.getElementById("password-error");
      const submitButton = document.getElementById("submit-btn");

      confirmPasswordInput.addEventListener("blur", validatePassword);
      passwordError.style.display = 'none';

      function validatePassword(){
          if(passwordInput.value!==confirmPasswordInput.value){
              passwordError.style.display = 'block';
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

<script>
    // validating nepali numbers 
    const phoneInput = document.getElementById("mobileno");
    const phoneError = document.getElementById("phone-error");
    const submitButton1 = document.getElementById("submit-btn");

    phoneInput.addEventListener("input", restrictNonNumericInput);
    phoneInput.addEventListener("blur", validatePhoneNumber);
    phoneError.style.display = 'none';

    function restrictNonNumericInput(){
        phoneInput.value = phoneInput.value.replace(/\D/g, "");
    }

    function validatePhoneNumber(){
        const phoneNumber = phoneInput.value;
        phoneError.style.display = 'none';

        if (/^[9][0-9]{9}$/.test(phoneNumber)){
            submitButton1.disabled=false;
        }
        else{
            phoneError.style.display = 'block';
            submitButton1.disabled=true;
        }    
    }
   </script>

    <script>
        // for enter button to next form 
        function jumpToNextInput (event, nextInputId){
            if(event.keyCode === 13){
                event.preventDefault();

                const nextField = document.getElementById(nextFieldId);
                nextField.focus();

            }
        }
    </script>

    
</body>
</html>

