
<?php
            @include'config.php';
            session_name('signup_session');
            session_start();

            if (isset($_POST['submit']))
            // $error = [];
        {
            $_SESSION['register'] = true;

            $_SESSION['s_fname']  = mysqli_real_escape_string($conn, $_POST['firstname']);
            $_SESSION['s_mname'] = mysqli_real_escape_string($conn, $_POST['middlename']);
            $_SESSION['s_lname'] = mysqli_real_escape_string($conn, $_POST['lastname']);
            $_SESSION['s_email'] = mysqli_real_escape_string($conn, $_POST['email']);
            $_SESSION['s_mnum'] = mysqli_real_escape_string($conn, $_POST['mobileno']);
            $_SESSION['s_addr'] = mysqli_real_escape_string($conn, $_POST['addr']);
            $_SESSION['s_npass'] = mysqli_real_escape_string($conn, $_POST['npassword']);
            $_SESSION['s_cpass'] = mysqli_real_escape_string($conn, $_POST['cpassword']);
            $_SESSION['s_usertype'] = mysqli_real_escape_string($conn, $_POST['usertype']);

            $select = " SELECT * FROM signup_form WHERE email= '".$_SESSION['s_email']."' OR mobileno='".$_SESSION['s_mnum']."'";

            $result = $conn->query($select);
            
            if($result->num_rows>0)
            {
                $error[] = "User already exist!!";
                
            }else
            {
                header('location:confirm_code.php');
                

            }

        };

        ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="signup.css">
    <script src="script.js"></script>
    <title>signup</title>
</head>
<body>
    <div class="signup">
       <div class="signuptext" >
        <span class="span-title">Sign up</span>
       </div>

        <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<p style="color: red; font-size:16px ">'.$error.'</p>';
                }
            }
        ?>

       
        <form action="" method="post" id="signup_form" onsubmit="return validateForm()" autocomplete="off" >
            <input type="text" name="firstname" id="firstname" handleKeyDown="jumpToNextInput(event,'middlename')" placeholder="First name*" required>

            <input type="text" name="middlename" id="middlename" handleKeyDown="jumpToNextInput(event,'lastname')" placeholder="Middle name" >

            <input type="text" name="lastname" id="lastname" handleKeyDown="jumpToNextInput(event,'email')"  placeholder="Last name*" required>

            <input type="email" name="email" id="email" handleKeyDown="jumpToNextInput(event,'mobileno')" placeholder="email address*" required>

            <input type="tel" name="mobileno" id="mobileno" handleKeyDown="jumpToNextInput(event,'address')" placeholder="mobile number*" required maxlength="10">
            <p id="phone-error" class="error-phone-message">Invalid!!</p>

            <input type="address" name="addr" id="address"handleKeyDown="jumpToNextInput(event,'new-password')" placeholder="full address*" required>

            <input type="password" id="new-password" name="npassword" handleKeyDown="jumpToNextInput(event,'confirm-password')" placeholder="new password*" pattern="^(?=.*\d).{6,}$" minlength="6" required>

            <input type="password" id="confirm-password" name="cpassword" placeholder="confirm password*" pattern="^(?=.*\d).{6,}$" minlength="6" required><p id="password-error" class="error-message">Invalid!!</p>
            
            <select id="usertype" name="usertype" required>
                <option value="" disabled selected>choose user type</option>
                <option value="owner">Owner</option>
                <option value="tenant">Tenant</option>
            </select>

            <button type="submit" name="submit" id="submit-btn" value="submit">Submit</button>
        </form>
        
        <span class="login-part">already have an account?   <a href="login.php">Login</a> </span>

    </div>
















    <!-- // for enter button to next form  -->
        <script>
            
            function handleKeyDown(event, nextInputId){
                if(event.key="Enter"){
                    event.preventDefault();
                    document.getElementById(nextInputId).focus();

                }
            }
        </script>









 <!-- // for validating two passwors and disabling submit button -->
        <script>
           
            const passwordInput = document.getElementById("new-password");
            const confirmPasswordInput = document.getElementById("confirm-password");
            const passwordError = document.getElementById("password-error");
            const submitButton = document.getElementById("submit-btn");

            confirmPasswordInput.addEventListener("blur", validatePassword);
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
                phoneError.style.display = 'inline';
                submitButton1.disabled=true;
            }   
        }
       </script>

    
</body>
</html>