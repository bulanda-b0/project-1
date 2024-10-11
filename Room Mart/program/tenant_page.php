<?php
    include 'config.php';
    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        // Redirect the user to the login page
        header('Location: login.php');
        exit;
    }

    $tenant_id = $_SESSION['tenant_id']; 
    $image = $_SESSION['profile_img'];

    if(!isset($tenant_id)){

        header('location:login.php');
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Profile</title>
    <link rel="stylesheet" type="text/css" href="profile_edit_page.css">
    <link rel="stylesheet" type="text/css" href="tenant_book_page.css">

</head>
<body>
   
<div class="profile-sec">
        <div class="user-info-section">
            <div class="profile-pic">

                <?php 
                    if($_SESSION['profile_img'] == NULL){
                        echo '<img class="default-pic" src = "images/defaultpic.jpg" >';
                    }else{
                        echo '<img class="default-pic" src="'.$image.'" >';
                    }
                
                ?>
                
                <h3 class="user-id-display" >USER ID: <?php echo $tenant_id ?> </h3>

            </div>
            <div class="display-info">
                <div style="background-color: aquamarine;" ><h1 class="heading-of-your-info" >Your Information</h1></div> 
                <div class="information-part">
                <div style="background-color: aquamarine;" > <h4 style="
                    margin-left: 50px; background-color: aquamarine;
                     " >First Name: <?php echo $_SESSION['tenant_firstname'] ?> </h4> </div>

                    <div style="background-color: aquamarine;" > <h4 style="
                        margin-left: 50px; background-color: aquamarine;
                         "  >Address: <?php echo $_SESSION['tenant_addr'] ?> </h4> </div>

                    <div style="background-color: aquamarine;"> <h4 style="
                        margin-left: 50px; background-color: aquamarine;
                         "  >Middle Name: <?php echo $_SESSION['tenant_middlename'] ?> </h4> </div>

                    <div style="background-color: aquamarine;"> <h4 style="
                        margin-left: 50px; background-color: aquamarine;
                         "  >Email: <?php echo $_SESSION['tenant_email'] ?> </h4> </div>

                    <div style="background-color: aquamarine;"> <h4 style="
                        margin-left: 50px; background-color: aquamarine;
                         "  >Last Name: <?php echo $_SESSION['tenant_lastname'] ?> </address></h4> </div>

                    <div style="background-color: aquamarine;"> <h4 style="
                        margin-left: 50px; background-color: aquamarine;
                         "  >Phone No: <?php echo $_SESSION['tenant_mobileno'] ?> </h4> </div>

                    <div style="background-color: aquamarine;"> <h4 style="
                        margin-left: 50px; background-color: aquamarine;
                         "  >User Type: <?php echo $_SESSION['usertype'] ?> </h4> </div>

                </div>

            </div>
            <div class="edit-info-section">
                 <div style="background-color: aquamarine; margin-right: 20px; margin-top: 20px; " >
                   <a style="background-color: aquamarine ; " href="logout.php"><button class="logout-button" > <img src="photo/logout.gif" class="logout-icon" ><h3 style="background-color: green;" >Logout</h3></button></a>
                </div>
                <div class="edit-details">
                <a style="background-color: aquamarine ; " href="http://localhost/program/edit_details.php" ><button class="edit-info" ><h3 style="background-color: green;" >Edit Details</h3></button></a>
                </div>
               

            </div>

        </div>


        <div class="property-management-section">
        
            <div class="list-property-items">
                
                    <div style=" background-color: white ; " >
                       <h3 class="heading-list-property2" >Book Property </h3>
                    </div>

                    <div style=" background-color: white ; " >
                      <a href="search_property.php" class="hreftitle-of-list-property" >   
                       <img src="photo/rightarrow.gif" class="arrow-image">
                       </a>
                    </div>

                    <div style=" background-color: white ; " >
                       <h3 class="heading-list-property" >List your Property </h3>
                    </div>

                    <div style=" background-color: white ; " >
                      <a href="list_property.php" class="hreftitle-of-list-property" >   
                       <img src="photo/rightarrow.gif" class="arrow-image">
                       </a>
                    </div>
                
                
            </div>

            <div class="booked-and-posted-list">
                <h3 class="booked-title" >Your Bookings</h3> 
                <h3 class="posted-title" >Posted Rooms</h3>
            </div>


            <div class="booked-property-list">
                
                    

                    <div class="booked-rooms-details">

                        <?php
                             @include 'config.php';
                        
                             $select = "SELECT p.property_type, p.price, p.p_location, p.property_image, p.property_id, b.booked_date FROM listproperty_form AS p INNER JOIN booked_room AS b ON p.property_id = b.property_id WHERE b.user_id = '".$tenant_id."' order by booked_id desc  ";

                             $result = $conn->query($select);

                            
                    
                     
                             while ($row = $result->fetch_assoc()) {
                                 
                                 $property_type = $row['property_type'];
                                 $property_price = $row['price'];
                                 $property_location = $row['p_location'];
                                 $property_image = $row['property_image'];
                                 $booked_date = $row['booked_date'];
                                 $booked_room_id = $row['property_id'];
                     
                                 echo '<div class="grid-item">';
                                     echo '
                                     <img src="' . $property_image . '"  >
                                     ';   
                                     echo '<h2 style="backgroung-color:black" >' . $property_type . '</h2>';
                     
                                     echo '<h5 >Price: ' . $property_price . ' </h5>';
                                     echo '<h5  >Location: ' . $property_location . ' </h5>';
                                     echo '<h5 >Booked Date: '. $booked_date .' </h5>';

                                     echo '<a style=" background-color:black;" href="my_bookedroom_details.php?room_id='.$booked_room_id.'" ><button class="button1" >View Details</button></a> ';
                     
                                  echo '</div>';
                             }
                       ?>


                    </div>








                    <div class="posted-rooms-details">
                     <?php
                             @include 'config.php';
                        
                             $query1 = " SELECT * from listproperty_form where user_id = '" . $tenant_id . "' order by property_id desc ";

                             $result1 = $conn->query($query1);

                            
                    
                     
                             while ($row1 = $result1->fetch_assoc()) {
                                 
                                 $room_type = $row1['property_type'];
                                 $room_price = $row1['price'];
                                 $room_location = $row1['p_location'];
                                 $room_image = $row1['property_image'];
                                 $posted_date = $row1['post_date'];
                                 $room_description = $row1['p_description'];
                                 $booking_status = $row1['booking_status'];
                                 $property_id = $row1['property_id'] ; 

                                 if($booking_status !== 'deleted'){
                     
                                 echo '<div class="grid-item2">';
                                     echo '
                                     <img src="' . $room_image . '"  >
                                     ';   
                                     echo '<h2 style="backgroung-color:black" >' . $room_type . '
                                    </ h2>';
                     
                                     echo '<h5 >Price: ' . $room_price . ' </h5>';
                                     echo '<h5  >Location: ' . $room_location . ' </h5>';
                                     echo '<h5 >Posted Date: '. $posted_date .' </h5>';
                                     echo '<h5 >Description: '. $room_description .' </h5>';

                                     if($booking_status == ""){
                                        echo '<h5 class="book-colour">Booking Status: Not Booked</h5> ';
                                     
                                        
                                     }else{
                                        echo'<h5 class="book-colour" >Booking Status: Booked  </h5> ';

                                     }

                                     if($booking_status == ""){
                                        echo '<a style=" background-color: rgb(248, 181, 192);" href="edit_posted_unbooked.php?room_id='.$property_id.'" ><button class="button1" >Edit Details</button></a> ';
                                    
                                     }else{
                                        echo '<a style=" background-color: rgb(248, 181, 192);" href="who_booked_myroom.php?room_id='.$property_id.'" ><button class="button1" >View Details</button></a> ';
                                     }


                                    echo '<form style="background-color: rgb(248, 181, 192); display:inline;" action="" method="POST" >';
                                     echo '<input type="hidden" name="delete" value="deleted" >';
                                     echo '<input type="hidden" name="id" value="'.$property_id.'" >';

                                     if($booking_status == "" ){
                                     
                                        
                                        echo '<button type="submit"  class="button2" name="submit" >Delete</button> ';
                                     }

                                     echo '</form>';

                                     if(isset($_POST['submit'])){

                                        $status_delete = $_POST['delete'];
                                        $id = $_POST['id'];
                                        

                                        


                                        $set = " UPDATE listproperty_form set booking_status = '".$status_delete."' where property_id = '".$id."' ";

                                        mysqli_query($conn, $set);
                                        



                                     }



                                  echo '</div>';
                                }

                             }
                       ?>




                    </div>



            </div>
        </div>







    </div>
</body>
</html>