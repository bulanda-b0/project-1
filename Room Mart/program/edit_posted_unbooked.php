
<?php
    @include 'config.php';
    session_start();
    
 
    
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        
        header('Location: login.php');
        exit;
    }
    $editing_room_id = $_GET['room_id'];


    if(isset($_POST['submit'])){

        $p_id = $_POST['property_id'];

        $select = " SELECT * from listproperty_form where property_id = '".$p_id."' ";
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($result);

    $propertytype = ($_POST['propertytype'] !=='') ? mysqli_real_escape_string($conn, $_POST['propertytype']) : $row['property_type'];

    $price = ($_POST['price'] !=='') ?  mysqli_real_escape_string($conn, $_POST['price']) : $row['price'] ;

    $location = ($_POST['location'] !=='') ? mysqli_real_escape_string($conn, $_POST['location']) : $row['p_location'];

    $description = ($_POST['description'] !=='') ? mysqli_real_escape_string($conn, $_POST['description']) : $row['p_description'];


        if(isset($_FILES['uploadphoto']) && $_FILES['uploadphoto']['error'] === UPLOAD_ERR_OK){
        $name = $_FILES['uploadphoto']['name'];
        $tmpName = $_FILES['uploadphoto']['tmp_name'];
        $uploadDir = 'propertypicture/';
        $path = $uploadDir . $name;
        move_uploaded_file($tmpName, $path);
        }else{

                $path = $row['property_image'];

        }

        $update = " UPDATE listproperty_form set property_type = '$propertytype', price ='$price', p_location = '$location', p_description = '$description' , property_image = '$path' where property_id = '".$p_id."'  ";

        mysqli_query($conn, $update);

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
    <title>Edit Room Details</title>
    <link rel="stylesheet" type="text/css" href="edit_posted_unbooked.css">
</head>
<body>

<div class="list-property-form">
        <div class="list-property-head">
            <h3 class="head_title" >Edit your Room Details</h3>
        </div>

        <form action="" method="post" class="list-form" id="list-form" enctype="multipart/form-data" >

            <select id="propertytype" name="propertytype" required>
                <option value="" disabled selected>choose property type</option>
                <option value="House">House</option>
                <option value="Single Room">Single Room</option>
                <option value="Double Room">Double Room</option>
                <option value="Flat">Flat</option>
            </select>

            <input type="number" name="price" placeholder="Enter price of property" >
            <input type="text" name="location" placeholder="Enter location of property" >
            <textarea rows="7" cols="39" type="text" name="description" placeholder="Enter property description" maxlength="200" ></textarea>
            <p class="head-of-photo">
                Upload property photo
            </p>
            <input style="background-color: pink ; " type="file" name="uploadphoto" value="" accept="image/*" >

            <input type="hidden" name="property_id" value="<?php echo $editing_room_id; ?>" >

            <button type="submit" name="submit" id="submit" value="submit" class="submit-btn" >Submit</button>
    

        </form>



    </div>


    
</body>
</html>