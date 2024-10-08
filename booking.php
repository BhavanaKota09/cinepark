<?php
session_start();
include "db.php";
function getEvents($conn) {
    $query = "SELECT event_id, event_name FROM events"; // Adjust the table name as needed
    $result = mysqli_query($conn, $query);

    $events = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }

    return $events;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $user_id = $_SESSION['user_id'];
    $user_email = $_SESSION['user_email'];
    $package_name = $_POST['package_name'];
    $occasion = $_POST['occasion'];
    $guest_count = $_POST['guest_count'];
    $color_palette = $_POST['color_palette'];
    $add_ons = $_POST['add_ons'];
    $event_date = $_POST['event_date'];
    $preferred_time = $_POST['preferred_time'];
    $location_choice = $_POST['location_choice'];
	$phone_number = $_POST['phone_number'];
    $movie_name = $_POST['movie_name']; // New field
    $genre_option = $_POST['genre_option']; // New field


    // Insert data into the bookings table
	$sql = "INSERT INTO bookings (user_id, user_email, package_name, occasion, guest_count, color_palette, addons, event_date, time_slot, location, phone_number, movie_name, genre_option, created_at)
    VALUES ('$user_id', '$user_email', '$package_name', '$occasion', '$guest_count', '$color_palette', '$add_ons', '$event_date', '$preferred_time', '$location_choice', '$phone_number', '$movie_name', '$genre_option', NOW())";

    if ($conn->query($sql) === TRUE) {
		echo "<script>
		alert('Booking Confirmed');
		window.location.href = '../orderconfirm.html';
		</script>";
    } else {
        echo "<script>
            alert('Invalid Booking');
            window.location.href = '../booking.php';
            </script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CinePark - Booking</title>
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
							<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +00 1234 567</a> 
							<a href="#"><span class="fa fa-paper-plane mr-1"></span> youremail@email.com</a>
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
    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('../images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-5 text-center">
          	<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Bookings <i class="fa fa-chevron-right"></i></span></p>
            <h2 class="mb-0 bread">Wanna Plan For Your Party ?!</h2>
          </div>
        </div>
      </div>
    </section>

	<section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<div class="form-group">
    <label for="phone_number">Phone Number</label>
    <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
</div>
    <div class="form-group">
        <label for="package_name">Luxury Picnic Package</label>
        <select class="form-control" id="package_name" name="package_name">
            <option value="Standard Luxury Picnic for Two Guests (Customizable)">Standard Luxury Picnic for Two Guests (Customizable)</option>
            <option value="LalasLuxe Luxury Group Inquiry 3+ Guests (Customizable)">LalasLuxe Luxury Group Inquiry 3+ Guests (Customizable)</option>
            <option value="Luxury Picnic Proposal (Customizable)">Luxury Picnic Proposal (Customizable)</option>
            <option value="Let's Get Cozy Luxury Picnic for 2-6 Guests (Seasonal)">Let's Get Cozy Luxury Picnic for 2-6 Guests (Seasonal)</option>
            <option value="Tablescape Service 2+ Guests">Tablescape Service 2+ Guests</option>
            <option value="Be My Valentine Luxury Picnic for 2+ Guests">Be My Valentine Luxury Picnic for 2+ Guests</option>
            <option value="Other Personal Event">Other Personal Event</option>
        </select>
    </div>

    <div class="form-group">
    <label for="event">Select Event</label>
    <select class="form-control" id="event" name="event">
        <?php
        $events = getEvents($conn);
        foreach ($events as $event) {
            echo "<option value=\"{$event['event_id']}\">{$event['event_name']}</option>";
        }
        ?>
    </select>
</div>

    <div class="form-group">
        <label for="guest_count">Guest Count</label>
        <input type="number" class="form-control" id="guest_count" min="1" name="guest_count" required>
    </div>

    <div class="form-group">
        <label for="color_palette">Picnic Color Palette</label>
        <select class="form-control" id="color_palette" name="color_palette">
            <option value="Pink/Blush">Pink/Blush</option>
            <option value="White/Ivory">White/Ivory</option>
            <option value="Tan/Cream">Tan/Cream</option>
            <option value="Brown/Beige">Brown/Beige</option>
            <option value="Rust/Terracotta">Rust/Terracotta</option>
            <option value="Blue">Blue</option>
            <option value="Red">Red</option>
            <option value="Green">Green</option>
            <option value="Custom">Custom</option>
        </select>
    </div>

    <div class="form-group">
        <label for="add_ons">A La Carte Add-ons</label>
        <textarea class="form-control" id="add_ons" name="add_ons"></textarea>
    </div>

    <div class="form-group">
        <label for="event_date">Date of Event</label>
        <input type="date" class="form-control" id="event_date" name="event_date" required>
    </div>
    <div class="form-group">
    <label for="movie_name">Movie Name</label>
    <input type="text" class="form-control" id="movie_name" name="movie_name" required>
</div>

<div class="form-group">
    <label for="genre_option">Genre Option</label>
    <select class="form-control" id="genre_option" name="genre_option">
        <option value="horror">Horror</option>
        <option value="love">Love</option>
        <option value="action">Action</option>
        <option value="sci-fi">Sci-Fi</option>
        <!-- Add more genres as needed -->
    </select>
</div>
    <div class="form-group">
        <label for="preferred_time">Preferred Time Slot</label>
        <select class="form-control" id="preferred_time" name="preferred_time">
            <option value="11am-1pm">11am-1pm</option>
            <option value="1pm-3pm">1pm-3pm</option>
            <option value="3pm-5pm">3pm-5pm</option>
            <option value="5pm-7pm">5pm-7pm</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="form-group">
        <label for="location_choice">Location Choice</label>
        <select class="form-control" id="location_choice" name="location_choice">
            <option value="Liberty State Park Jersey City, NJ">Liberty State Park Jersey City, NJ</option>
            <option value="Lenape Park Cranford, NJ">Lenape Park Cranford, NJ</option>
            <option value="Hoboken Pier A Park Hoboken, NJ">Hoboken Pier A Park Hoboken, NJ</option>
            <option value="Brookdale Park, Bloomfield NJ">Brookdale Park, Bloomfield NJ</option>
            <option value="Private Residence">Private Residence</option>
            <option value="Other Location">Other Location</option>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Book Now</button>
    </div>
</form>

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  <script src="../js/main.js"></script>
    
  </body>
</html>