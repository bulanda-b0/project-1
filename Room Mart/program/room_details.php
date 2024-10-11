<?php
  @include 'config.php';
  session_start();
    
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    
    header('Location: login.php');
    exit;

  }
    
        if(isset($_SESSION['owner_id'])){
                $booking_user_id = $_SESSION['owner_id'];
        }
        elseif(isset($_SESSION['tenant_id'])){
            $booking_user_id = $_SESSION['tenant_id'];
        }else{
            header('location: login.php');
        }



    if(isset($_GET['room_id'])){
        $room_id = $_GET['room_id'];
        
        
    }else{
        session_unset();
        session_destroy();
        header('location:login.php');
    }
    

 

    $select = "SELECT p.property_type, p.price, p.p_location, p.post_date, p.p_description, p.      property_image, u.firstname, u.middlename, u.lastname, u.email, u.mobileno, u.profile_img FROM listproperty_form AS p 
    INNER JOIN signup_form AS u ON p.user_id = u.user_id WHERE p.property_id = '" . $room_id . "' ";

    $result = $conn->query($select);

    $row = mysqli_fetch_array($result);

            $property_type = $row['property_type'];
            $property_price = $row['price'];
            $property_location = $row['p_location'];
            $post_date = $row['post_date'];
            $property_description = $row['p_description'];
            $property_image = $row['property_image'];
            $first_name = $row['firstname'];
            $middle_name = $row['middlename'];
            $last_name = $row['lastname'];
            $email = $row['email'];
            $mobileno = $row['mobileno'];
            $profile_img = $row['profile_img'];

            $multiple_space = str_repeat("&nbsp",2);


            

             
                        
            if(isset($_POST['submit'])){

                $booked_room_id = $_POST['property_id'];
                $booked_user_id = $_POST['booking_user_id'];
                $booking_status = "ok";

                // date_default_timezone_set('UTC');

                $booked_date = $_POST['booked_date'];

                $insert = " INSERT into booked_room (user_id, property_id, booked_date) VALUES ('$booked_user_id','$booked_room_id','$booked_date' ) ";

                mysqli_query($conn, $insert);

                $update_status = "UPDATE listproperty_form SET booking_status = '" .$booking_status. "' WHERE property_id = '".$booked_room_id."' ";

                mysqli_query($conn, $update_status);



                header('location:thanks.php');


            }
        
        
        
 
     


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link rel="stylesheet" type="text/css" href="room_details.css">
</head>
<body>

  <div class="room-details">
    
        <h3 class="heading-of-details" >Book Your Room</h3>
        
    <div class="details-of-div" >

          <div class="details-of-rooms">
                <div style=" display: grid ; grid-template-columns: 3.5fr 5fr; grid-template-rows: 1fr; background-color: black; ">
                    
                        <div style=" background-color: black ; " >
                        <h4 style=" color: white ; background-color: black;  " >Type Of Room:</h4>

                        </div> 
                        <div style="color: white ; font-size:15px ; background-color: black; " >
                            <p style="background-color: black;" > <?php echo $property_type; ?> </p>
                        </div>     
                </div>
                <div style=" display: grid ; grid-template-columns: 3.5fr 5fr; grid-template-rows: 1fr; background-color: black; ">
                    
                    <div style=" background-color: black ; " >
                    <h4 style=" color: white ; background-color: black;  " >Price:</h4>

                    </div> 
                    <div style="color: white ; font-size:15px ; background-color: black; " >
                        <p style="background-color: black;" > <?php echo $property_price; ?> </p>
                    </div>     
            </div>
            <div style=" display: grid ; grid-template-columns: 3.5fr 5fr; grid-template-rows: 1fr; background-color: black; ">
                    
                    <div style=" background-color: black ; " >
                    <h4 style=" color: white ; background-color: black;  " >Posted Date:</h4>

                    </div> 
                    <div style="color: white ; font-size:15px ; background-color: black; " >
                        <p style="background-color: black;" > <?php echo $post_date; ?> </p>
                    </div>     
            </div>
            <div style=" display: grid ; grid-template-columns: 3.5fr 5fr; grid-template-rows: 1fr; background-color: black; ">
                    
                    <div style=" background-color: black ; " >
                    <h4 style=" color: white ; background-color: black;  " >Location:</h4>

                    </div> 
                    <div style="color: white ; font-size:15px ; background-color: black; " >
                        <p style="background-color: black;" > <?php echo $property_location; ?> </p>
                    </div>     
            </div>

            <div style=" display: grid ; grid-template-columns: 3.5fr 5fr; grid-template-rows: 1fr; background-color: black; ">
                    
                    <div style=" background-color: black ; " >
                    <h4 style=" color: white ; background-color: black;  " >More Details:</h4>

                    </div> 
                    <div style="color: white ; font-size:15px ; background-color: black; " >
                        <p style="background-color: black;" > <?php echo $property_description; ?> </p>
                    </div>     
            </div>

     </div>



            <div class="room-photo-div">
                <div class="room-photo-display">

                    <?php
                   echo ' <img class="room-photo" src="' . $property_image .' " >';
                    ?>
                    

                </div>

                <div style=" background-color: black ; " >

                        <form style=" background-color: black ; " action="" method="post">

                            <input type="hidden" name="property_id" value="<?php echo $room_id; ?>" >
                            <input type="hidden" name="booking_user_id" value="<?php echo $booking_user_id; ?>" >
                            <input type="hidden" name="booked_date" id="booked_date" value="<?php echo date('Y-m-d'); ?>" >
                            <button class="book-now-b1" name="submit" >
                            Book Now
                            </button>

                        </form>
                        <!-- <script>
                            document.getElementById('booked_date').value =new Date().toISOString().slice(0,10);
                        </script> -->

                       



                    

                </div>






            </div>



            <div class="owner-details-div">
                <div style=" background-color: black; ">
                    <?php

                        echo '<img class="profile-pic" src="' .$profile_img. '" > ';
                    
                    
                    ?>

                </div>
                <div style=" background-color: black; ">
                    <div style=" display: grid ; grid-template-columns: 1.7fr 5fr; grid-template-rows: 1fr; background-color: black; margin-left: 25px; margin-top:10px ; ">
                        
                        <div style=" background-color: black ; " >
                        <h3 style=" color: white ; background-color: black;  " >Name:</h3>

                        </div> 
                        <div style="color: white ; font-size:17px ; background-color: black; " >
                            <p style="background-color: black; margin-top:2px;" > <?php echo $first_name . $multiple_space . $middle_name . $multiple_space . $last_name; ?> </p>
                        </div>     
                    </div>

                </div>
                <div style=" background-color: black; ">
                    <div style=" display: grid ; grid-template-columns: 1.7fr 5fr; grid-template-rows: 1fr; background-color: black; margin-left: 25px; margin-top:10px ; ">
                            
                            <div style=" background-color: black ; " >
                            <h3 style=" color: white ; background-color: black;  " >Email:</h3>

                            </div> 
                            <div style="color: white ; font-size:17px ; background-color: black; " >
                                <p style="background-color: black; margin-top:2px;" > <?php echo $email; ?> </p>
                            </div>     
                        </div>

                </div>
                <div style=" background-color: black; ">
                    <div style=" display: grid ; grid-template-columns: 1.7fr 5fr; grid-template-rows: 1fr; background-color: black; margin-left: 25px; margin-top:10px ; ">
                                
                                <div style=" background-color: black ; " >
                                <h3 style=" color: white ; background-color: black;  " >Phone:</h3>

                                </div> 
                                <div style="color: white ; font-size:17px ; background-color: black; " >
                                    <p style="background-color: black; margin-top:2px;" > <?php echo $mobileno; ?> </p>
                                </div>     
                            </div>

                </div>



                <div class="contact-chat" style=" background-color: black; ">
                    <img src="photo/messanger.png " class="message-icon" >

                </div>




            </div>


    </div>


  </div>


    
</body>
</html>