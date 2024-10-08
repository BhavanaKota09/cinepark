<?php
// Session start and database connection
session_start();
include "db.php";

$conn = mysqli_connect($servername, $username, $password, "$dbname");

// Fetch event categories from the database
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

// Store the results in an associative array
$eventCategories = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $eventCategories[] = $row;
    }
}

// Close the database connection

?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<title>CinePark - Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../css/animate.css">
    
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>

  	<div class="wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6 d-flex align-items-center">
						<p class="mb-0 phone pl-md-2">
							<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +1987654321</a> 
							<a href="#"><span class="fa fa-paper-plane mr-1"></span> myemail@gmail.com</a>
						</p>
					</div>
					<div class="col-md-6 d-flex justify-content-md-end">
						<div class="social-media mr-4">
			    		<p class="mb-0 d-flex">
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
			    		</p>
		        </div>
		        <div class="reg">
            <p class="mb-0"><a href="../register.html" class="mr-2">Sign Up</a> <a href="../login.html">Log In</a></p>
		        </div>
					</div>
				</div>
			</div>
		</div>
    
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Cine <span>Park</span></a>


	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

		  <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
			  <li class="nav-item"><a href="booking.php" class="nav-link">Book Event</a></li>
	          <li class="nav-item"><a href="../contact.html" class="nav-link">Contact</a></li>
              <li class="nav-item"><a href="my_bookings.php" class="nav-link">My Bookings</a></li>
       
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <div class="hero-wrap" style="background-image: url('../images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-8 ftco-animate d-flex align-items-end">
                    <div class="text w-100 text-center">
                        <h1 class="mb-4">Plan Your <span>Perfect Event</span>.</h1>
                        <p><a href="#" class="btn btn-primary py-2 px-4">Get Started</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-intro">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-4 d-flex">
                <div class="intro d-lg-flex w-100 ftco-animate">
                    <div class="icon">
                        <span class="flaticon-calendar"></span>
                    </div>
                    <div class="text">
                        <h2>24/7 Event Support</h2>
                        <p>Our commitment to you is unwavering. We offer round-the-clock online support to ensure your event needs are always met.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="intro color-1 d-lg-flex w-100 ftco-animate">
                    <div class="icon">
                        <span class="flaticon-guarantee"></span>
                    </div>
                    <div class="text">
                        <h2>Event Success Guarantee</h2>
                        <p>Your satisfaction is our top priority. We guarantee the success of your event and stand by the quality of our services.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="intro color-2 d-lg-flex w-100 ftco-animate">
                    <div class="icon">
                        <span class="flaticon-location"></span>
                    </div>
                    <div class="text">
                        <h2>Local Presence</h2>
                        <p>We understand the importance of being present. That's why we have a local presence to ensure seamless event coordination in your area.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- <section class="ftco-section ftco-no-pb">
			<div class="container">
				<div class="row">
					<div class="col-md-6 img img-3 d-flex justify-content-center align-items-center" style="background-image: url(images/about.jpg);">
					</div>
					<div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
	          <div class="heading-section">
	          	<span class="subheading">Since 1905</span>
	            <h2 class="mb-4">Desire Meets A New Taste</h2>

	            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
	            <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country.</p>
	            <p class="year">
	            	<strong class="number" data-number="115">0</strong>
		            <span>Years of Experience In Business</span>
	            </p>
	          </div>

					</div>
				</div>
			</div>
		</section> -->
    <section class="ftco-section ftco-no-pb">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="event-category w-100 text-center ftco-animate">
                  
                    <h3>Weddings</h3>
                    <p>Make your special day truly memorable with our expert event planning for weddings.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="event-category w-100 text-center ftco-animate">
                  
                    <h3>Corporate Events</h3>
                    <p>Plan successful corporate events that leave a lasting impression on your clients and employees.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="event-category w-100 text-center ftco-animate">
                  
                    <h3>Birthday Parties</h3>
                    <p>Celebrate birthdays in style with our creative and personalized event planning services.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="event-category w-100 text-center ftco-animate">
                  
                    <h3>Conferences</h3>
                    <p>Host successful conferences with our professional event management and logistics support.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="event-category w-100 text-center ftco-animate">
                  
                    <h3>Social Gatherings</h3>
                    <p>Bring people together with our expert planning for social events and gatherings.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="event-category w-100 text-center ftco-animate">
                  
                    <h3>Exhibitions</h3>
                    <p>Showcase your products and ideas with our comprehensive exhibition planning services.</p>
                </div>
            </div>
        </div>
    </div>
</section>


    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Explore</span>
                    <h2>Event Categories</h2>
                </div>
            </div>
            <div class="row">
                <?php foreach ($eventCategories as $category) : ?>
                    <div class="col-md-4 d-flex">
                    <div class="product ftco-animate">
                            <div class="img d-flex align-items-center justify-content-center"  style="background-image: url(<?php echo $category['image_url']; ?>);">
                            </div>
                            <div class="text text-center">
                                <h2><?php echo $category['event_name']; ?></h2>
                                <p class="mb-0"><?php echo $category['description']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <a href="booking.php" class="btn btn-primary d-block">Plan Your Event <span class="fa fa-long-arrow-right"></span></a>
                </div>
            </div>
        </div>
    </section>
  
    <section class="ftco-section testimony-section img" style="background-image: url(../images/bg_1.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <span class="subheading">Testimonials</span>
                <h2 class="mb-3">What Our Clients Say</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel ftco-owl">
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-comment"></span></div>
                            <div class="text">
                                <p class="mb-4">Our event was a huge success, thanks to the meticulous planning and execution by the event planning team. They went above and beyond to make our day special.</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(../images/person_1.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Emily Thompson</p>
                                        <span class="position">Happy Client</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-comment"></span></div>
                            <div class="text">
                                <p class="mb-4">The event planning team made our dream wedding a reality. Every detail was perfect, and their professionalism and creativity truly shone through. Highly recommended!</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(../images/person_2.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Daniel Rodriguez</p>
                                        <span class="position">Satisfied Customer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-comment"></span></div>
                            <div class="text">
                                <p class="mb-4">From the initial consultation to the event day, the team was attentive and responsive. Our corporate event was a hit, and we received many compliments on the flawless execution.</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(../images/person_3.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Sophie Turner</p>
                                        <span class="position">Corporate Client</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add more testimonial items as needed -->
                </div>
            </div>
        </div>
    </div>
</section>



<footer class="ftco-footer">
    <div class="container">
        <div class="row mb-5">
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2 logo"><a href="#">Cine <span>Park</span></a></h2>
                    <p>Your perfect events, planned with care and precision.</p>
                    <ul class="ftco-footer-social list-unstyled mt-2">
                        <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4 ml-md-4">
                    <h2 class="ftco-heading-2">My Account</h2>
                    <ul class="list-unstyled">
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Profile</a></li>
                        <li><a href="register.html"><span class="fa fa-chevron-right mr-2"></span>Register</a></li>
                        <li><a href="login.html"><span class="fa fa-chevron-right mr-2"></span>Login</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>My Events</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4 ml-md-4">
                    <h2 class="ftco-heading-2">Information</h2>
                    <ul class="list-unstyled">
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>About us</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Services</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Contact us</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Quick Links</h2>
                    <ul class="list-unstyled">
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>New Events</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Help Center</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Report Issue</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>FAQs</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Contact Us</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon fa fa-map-marker"></span><span class="text">Your Event Planning Address</span></li>
                            <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+1 234 5678 910</span></a></li>
                            <li><a href="#"><span class="icon fa fa-paper-plane pr-4"></span><span class="text">info@eventplanner.com</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script src="../js/jquery.waypoints.min.js"></script>
  <script src="../js/jquery.stellar.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/jquery.animateNumber.min.js"></script>
  <script src="../js/scrollax.min.js"></script>
  <script src="../js/main.js"></script>
    
  </body>
</html>