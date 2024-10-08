<?php
session_start();
include "db.php";

// Fetch booking details from the database
$userID = $_SESSION['user_id'];
$bookingsQuery = "SELECT * FROM bookings WHERE user_id = $userID";
$bookingsResult = $conn->query($bookingsQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Venue Vibes - My Bookings</title>
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
                <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>My Bookings <i class="fa fa-chevron-right"></i></span></p>
                <h2 class="mb-0 bread">My Bookings</h2>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="table-wrap">
                <table class="table">
                    <thead class="thead-primary">
                    <tr>
                        <th>Booking ID</th>
                        <th>Package Name</th>
                        <th>Occasion</th>
                        <th>Guest Count</th>
                        <th>Event Date</th>
                        <th>Location</th>
                        <th>Movie Name</th> <!-- Add this column -->
                        <th>Genre</th> <!-- Add this column -->
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if ($bookingsResult && $bookingsResult->num_rows > 0) {
                        while ($booking = $bookingsResult->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $booking['booking_id'] . '</td>';
                            echo '<td>' . $booking['package_name'] . '</td>';
                            echo '<td>' . $booking['occasion'] . '</td>';
                            echo '<td>' . $booking['guest_count'] . '</td>';
                            echo '<td>' . $booking['event_date'] . '</td>';
                            echo '<td>' . $booking['location'] . '</td>';
                            echo '<td>' . $booking['movie_name'] . '</td>'; // Display Movie Name
                            echo '<td>' . $booking['genre_option'] . '</td>'; // Display Genre
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="8">No bookings found.</td></tr>';
                    }
                    ?>

                    </tbody>
                </table>
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

<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-migrate-3.0.1.min.js"></script>
