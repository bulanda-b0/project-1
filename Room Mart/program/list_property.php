<?php
@include 'config.php';
session_start();

// $owner_id = $_SESSION['owner_id'];
// $tenant_id = $_SESSION['tennant_id'];

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    
    header('Location: login.php');
    exit;
}

if(isset($_SESSION['owner_id'])){
    $posting_user_id = $_SESSION['owner_id'];
}
elseif(isset($_SESSION['tenant_id'])){
$posting_user_id = $_SESSION['tenant_id'];
}else{
    session_unset();
    session_destroy();
header('location: login.php');
}




if (isset($_POST['submit']))
{

    $propertytype = mysqli_real_escape_string($conn, $_POST['propertytype']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $user_id = $posting_user_id;
    

    if(isset($_FILES['uploadphoto']) && $_FILES['uploadphoto']['error'] === UPLOAD_ERR_OK) {
        $name = $_FILES['uploadphoto']['name'];
        $tmpName = $_FILES['uploadphoto']['tmp_name'];
      
        // Save the uploaded image to a directory
        $uploadDir = 'propertypicture/';
        $path = $uploadDir . $name;
        move_uploaded_file($tmpName, $path);
      
      }

    
        $insert = " INSERT INTO listproperty_form(user_id, property_type, price, p_location, post_date, p_description, property_image) VALUES('$user_id', '$propertytype', '$price', '$location','$date','$description','$path')";
        
        mysqli_query($conn, $insert);
        if(isset($_SESSION['usertype']) && $_SESSION['usertype']=='owner'){
            header('location:owner_page.php');
    }elseif(isset($_SESSION['usertype']) && $_SESSION['usertype']=='tenant'){
        header('location:tenant_page.php');

    }else{
        session_unset();
        session_destroy();
        echo '<a href="login.php">Home Profile</a>';

    }
     

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list property</title>
    <link rel="stylesheet" type="text/css" href="list_property.css">



</head>
<body>

    <div class="list-property-form">
        <div class="list-property-head">
            <h3 class="head_title" >Enter your property Details</h3>
        </div>

        <form action="" method="post" class="list-form" id="list-form" enctype="multipart/form-data" >

            <select id="propertytype" name="propertytype" required>
                <option value="" disabled selected>choose property type</option>
                <option value="House">House</option>
                <option value="Single Room">Single Room</option>
                <option value="Double Room">Double Room</option>
                <option value="Flat">Flat</option>
            </select>

            <input type="number" name="price" placeholder="Enter price of property*" required>
            <input type="text" name="location" placeholder="Enter location of property*" required>
            <input type="hidden" name="date" value=" <?php echo date('Y-m-d'); ?> " >
            <textarea rows="7" cols="39" type="text" name="description" placeholder="Enter property description*" required maxlength="200" ></textarea>
            <p class="head-of-photo">
                Upload property photo
            </p>
            <input style="background-color: pink ; " type="file" name="uploadphoto" value="" accept="image/*" required >

            <button type="submit" name="submit" id="submit" value="submit" class="submit-btn" >Submit</button>
    

        </form>



    </div>
    
</body>
</html>