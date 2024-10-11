

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Property</title> 
    <link rel="stylesheet" type="text/css" href="search_property.css">

</head>
<body>
    <div class="nav-bar-for-search-property">
        <div class="logo">
            <img src="photo/logo.png" alt="Logo" class="logo-icon" >
        </div>

        <div class="search-bar">
            <form action="" method="POST">
                <div class="search-bar-div" >
                    <div  >
                        <input type="text" name="keyword" class="search-input" placeholder="Enter a keyword">
                    </div>
                    <div  >
                         <button type="submit" name="search" class="search-btn" > <img src="photo/searchicon.gif" class="search-icon" > </button>
                    </div>
                </div>
                  
            </form>
        </div>

        <div class="support-centre">
            <a href="support-centre.php"> <img src="photo/support.gif" class="support-logo" > </a>
            <h5 class="head-of-support" >Support centre</h5>
        </div>
    
    </div>
<div class="display-container" >
           
        
        <?php


        @include 'config.php';
        session_start();

        if(isset($_POST['search'])){

           $key =  $_POST['keyword'];

        //    $select1 = "SELECT * FROM listproperty_form WHERE property_type LIKE '%$key%' ORDER BY property_id DESC";
        // $select1 = "SELECT *, CASE WHEN property_type LIKE '%$key%' THEN 1 ELSE 2 END AS order_col FROM listproperty_form ORDER BY order_col, property_id DESC";

        $select1 = "SELECT *, CASE WHEN property_type LIKE '%$key%' OR p_location LIKE '%$key%' THEN 1 ELSE 2 END AS order_col FROM listproperty_form ORDER BY order_col, property_id DESC";

           $result = $conn->query($select1);


           echo '<div class="grid-container">';

           while ($row = $result->fetch_assoc()) {
               $property_id = $row['property_id'];
               $user_id = $row['user_id'];
               $property_type = $row['property_type'];
               $property_price = $row['price'];
               $property_location = $row['p_location'];
               $post_date = $row['post_date'];
               $property_description = $row['p_description'];
               $property_image = $row['property_image'];
               $property_status = $row['booking_status'];
   
           if($property_status == ""){
               echo '<div class="grid-item">';
                   echo '
                   <img src="' . $property_image . '"  >
                   ';   
                   echo '<h2>' . $property_type . '</h2>';
   
                   echo '<h5>Price: ' . $property_price . ' </h5>';
                   echo '<h5>Location: ' . $property_location . ' </h5>';
                   echo '<h5>Date: ' . $post_date . ' </p> </h5>';
                   echo '<h5>Description: ' . $property_description . ' </h5>';
   
              
   
               if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
   
                   echo '
                   <a href="login.php"><button>More Details</button></a>
                   ';
   
               }else{
                   // $_SESSION['room_id'] = $property_id;
   
                   echo '
                   <a href="room_details.php?room_id='.$property_id.'"><button>More Details</button></a>
                   ';
   
               }
            echo '</div>';
           }
         }
       
   
       echo '</div>';







        }else{



        $select = "SELECT * FROM listproperty_form order by property_id desc";
        $result = $conn->query($select);

    echo '<div class="grid-container">';

        while ($row = $result->fetch_assoc()) {
            $property_id = $row['property_id'];
            $user_id = $row['user_id'];
            $property_type = $row['property_type'];
            $property_price = $row['price'];
            $property_location = $row['p_location'];
            $post_date = $row['post_date'];
            $property_description = $row['p_description'];
            $property_image = $row['property_image'];
            $property_status = $row['booking_status'];

        if($property_status == ""){
            echo '<div class="grid-item">';
                echo '
                <img src="' . $property_image . '"  >
                ';   
                echo '<h2>' . $property_type . '</h2>';

                echo '<h5>Price: ' . $property_price . ' </h5>';
                echo '<h5>Location: ' . $property_location . ' </h5>';
                echo '<h5>Date: ' . $post_date . ' </p> </h5>';
                echo '<h5>Description: ' . $property_description . ' </h5>';

           

            if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){

                echo '
                <a href="login.php"><button>More Details</button></a>
                ';

            }else{
                // $_SESSION['room_id'] = $property_id;

                echo '
                <a href="room_details.php?room_id='.$property_id.'"><button>More Details</button></a>
                ';

            }
         echo '</div>';
        }
      }
    

    echo '</div>';
        }

        $conn->close();


        ?>
              

</div>




    



    
</body>
</html>