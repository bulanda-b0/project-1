
<?php
    include'config.php';

    if(isset($_POST['submit'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        mysqli_query($conn, "INSERT INTO contact_form(name, email, message) VALUES('$name', '$email', '$message') ");

        header('location:home.php');
        exit();

    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" type="text/css" href="header.css">
    <title>Room Mart Home</title>

    

</head>
<body>
   
    <!-- <!-- Top bar of home page  -->
    <div class="header">
        <div class="left-section">
            <a href="home.php"><img class="logo" src="photo/logo.png"></a>
        </div>
        <div class="middle-section">
                <a class="service-sec" href="#services-link">Services</a>
                <a class="about-sec" href="#about-section-link">About</a>
                <a class="contact-sec" href="#contact-section-link">Contact</a>
                <a class="blog-sec" href="#">Blog</a> 
        </div>
        <div class="right-section">
            <a href="login.php"><button class="lsbutton">Login</button></a>
            <a href="signup.php" ><button class="lsbutton">Signup</button></a>
        </div>
        
    </div>
 

<!-- home first section -->
    <div class="first-page">
        <div class="front-text-left">
        <div class="text1-box" ><p class="text1">All the tools you need to grow a successful propert business.</p></div>
        <div class="text2-box"><h2 class="text2">Property management platform. Built for you.</h2></div>
        <div class="text3-box"><p class="text3">Keep your businss moving by automatic rent collection, maintenance, communication,accounting, leasing and more.</p></div>
        </div>
        <div class="front-photo-right"> <img  class="front-photo" src="photo/room1.jpg"></div>  
    </div>


<!-- home second section -->
        <div class="home-2nd-part">
            <div class="list-property-section">
                <div class="list-property-div">
                   <a href="login.php"><button class="list-property-button"><p class="list-property-button-text">+ List a Room</p></button></a> 
                </div>
                    
            </div>
            
            <div class="find-property-section">
                <div class="find-property-div">
                    <a href="search_property.php"><button class="find-property-button"><p class="find-property-button-text">+ Find a Room</p></button></a>
                </div>
            </div>
            
        </div>


<!-- home data section  -->
    <div class="renting-data-grid">
        <div class="box1">
            <div>
                <img src="photo/logo.png" class="logo-photo1">
            </div>
            <div>
                <p class="text-under-logo1">Over 1000 properties for rent</p>
            </div>

        </div>
        <div class="box2">
            <div class="box2-1">
                <h2 class="logo-photo2">95%</h2>
            </div>
            <div class="box2-2">
                <p class="text-under-logo2">Customer satisfaction. our customers are here to stay with RoomMart!</p>
            </div>

        </div>
        <div class="box3">
            <div class="box2-1">
                <h2 class="logo-photo2">30%</h2>
            </div>
            <div >
                <p class="text-under-logo2">Faster rent collection times compared to cash, poster ad.</p>
            </div>

        </div>
        <div class="box4">
            <div class="box2-1">
                <h2 class="logo-photo2">99%</h2>
            </div>
            <p class="text-under-logo2">Occuoancy rate is higher!</p>
            <div>


            </div>

        </div>
    </div>


<!-- home fourth section for service  -->
    <div class="service-title" id="services-link">
       <div class="service-heading-title-border"><h1  class="service-heading-title">The leading plattform for rental property management!! Services we provide</h1></div>
    </div>



    <div class="services-section" >
        <div class="list-property">
            <img src="photo/rentavailable.jpg" class="rent-service-available">
            <h2 class="list-property-heading">Property Listing</h2>
            <p class="list-property-text">Get your property listed with us and reach potential tenants easily. We offer a hassle-free way to list your property and connect with tenants.</p>
            <a href="login.php"><button class="btn-for-list"><span class="btn-list-text">></span></button></a>
        </div>
        <div class="rent-property">
            <img src="photo/rented.jpg" style="margin-left: 72px;" class="rent-service-available">
            <h2 class="list-property-heading">Booking Property</h2>
            <p class="list-property-text">Tenants can book their suitable home for rent. We offer a hassle-free way to book desired property and save their time and money.</p>
            <a href="search_property.php"><button class="btn-for-list"><span class="btn-list-text">></span></button></a>
        </div>
        <div class="collect-rent">
            <img src="photo/rentcollect.jpg" class="rent-service-available">
            <h2 class="list-property-heading">Rent Collection</h2>
            <p class="list-property-text">Managing rent payments has never been easier. Our rent collection service provides a simple way to collect rent from tenants and keep track of payments.</p>
            <a href="login.php"><button class="btn-for-list"><span class="btn-list-text">></span></button></a>

        </div>
    </div>



<!-- fifth section for about  -->
    <div class="about-us-heading" id="about-section-link">
        <h1 class="about-us-title">About Us</h1>
    </div>
    <div class="about-section" >
        <div class="about-us-details">
            <h1 class="heading-creative">We are <strong>Creative!</strong></h1>
            <p class="about-us-para">With a passion for aesthetic and deep understanding of digital media, we bring your vision to life. We are a creative studio specializing in <strong>web design, photography</strong>  and <strong>grphics design</strong>. Let us transform your ideas into reality. Partner with us to make your online presence stand out and have a lastiong impression. <br> We are committed to delivering excellence and exceeding expectations. Wheather you are a small start-up, a growing enterprise or an indivisual with a unique project, we are dedicated to crafting innovative and impactful solutions to your needs.</p>
            <div class="project-link">
                <div class="web-design">
                    <img src="photo/web.png" class="web-photo">
                    <h3 class="web-text">Web Design</h3>
                </div>
                <div class="photography">
                    <img src="photo/photography.png" class="web-photo">
                    <h3 class="web-text">Photography</h3>
                </div>
                <div class="graphics-design">
                    <img src="photo/gdesign.png" class="web-photo">
                    <h3 class="web-text">Graphics</h3>
                </div>
            </div>
        </div>
        <div class="about-us-team">
            <h1 class="heading-creative"><strong>Who</strong> Are We?</h1>
            <p class="about-us-para">Welcome to our website! we are a team of developers, designers, and we are students of compuer engineering dedicated to delevering innovative solutions. With expertise in programming, design, and commitment to continuous learning, we bring ideas to  life. Wheather you need web design, photography or graphics design, we are here to help. Let's create digital experiences toether.</p>
            <h2 class="our-team-heading">Our Team</h2>
            <div class="team-profile">
                <div class="profile-1">
                    <img src="photo/bulanda2.jpg" class="profile-1-pic">
                    <h4 class="name">Bulanda Belbase</h4>
                    <h5 class="work">Dev || photography</h5>
                </div>
                <div class="profile-2">
                    <img src="photo/bijayan.jpg" class="profile-1-pic">
                    <h4 class="name">Bijayan Raj Yadav</h4>
                    <h5 class="work">Dev || Designer</h5>
                </div>
                <div class="profile-3">
                    <img src="photo/sunil.jpg" class="profile-1-pic">
                    <h4 class="name">Sunil Shah</h4>
                    <h5 class="work">Dev || Designer</h5>
                </div>
            </div>
        </div>
    </div>

<!-- sixth section of home page  -->
<div class="contact-us-heading" id="contact-section-link">
    <h1 class="contact-us-title">Contact Us</h1>
</div>
<div class="contact-us">
    <div class="contact-us-left">

        <form method="POST" action="home.php" id="form" name="emailContact" autocomplete="off">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" rows="6" placeholder="Your Message" maxlength="300" required></textarea>
            <input type="hidden" required>
            <button type="submit" class="btn" id="button" name="submit" onclick="sendMail()" >Submit</button>
            
        </form>

    </div>
    <div class="contact-us-right">
        <div class="email-section">
           <div>
            <img src="photo/email.png" class="email-logo">
           </div>
           <div>
            <P class="email-id">roommart@gmail.com</P>
           </div> 
        </div>
        
        <div class="social-media-heading">
            <div>
                <img src="photo/social-media.png" class="social-png">
            </div>
            <div>
                <P class="social">Social Medias:</P>
            </div>
        </div>

        <div class="media-icons">
            <div class="facebook">
                <a href="https://www.facebook.com/"><img src="photo/facebook.png" class="fb-icon"></a>
            </div>
            <div class="instagram">
               <a href="https://www.instagram.com/"> <img src="photo/instagram.png" class="fb-icon"></a>
            </div>
            <div class="youtube">
               <a href="https://www.youtube.com/"> <img src="photo/youtube.png" class="fb-icon"></a>
            </div>
            <div class="twitter">
               <a href="https://www.twitter.com/"> <img src="photo/twitter.png" class="fb-icon"></a>
            </div>
            <div class="github">
               <a href="https://www.github.com/"> <img src="photo/github.png" class="fb-icon"></a>
            </div>
        </div>
        
    </div>
</div>

<!-- last part of home page  -->
<div class="last-section">
    <P class="copyright-text">© 2023 RoomMart. All rights reserved.</P>
</div>






    
 
</body>
</html>