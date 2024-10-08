<?php
include "db.php";
include "admin_functions.php";

// Process any form submissions or actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Manage Users
    if (isset($_POST['add_user'])) {
        // Handle add user form submission
        addUser($conn, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);
    } elseif (isset($_POST['edit_user'])) {
        // Handle edit user form submission
        editUser($conn, $_POST['edit_user_id'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);
    } elseif (isset($_POST['delete_user'])) {
        // Handle delete user form submission
        deleteUser($conn, $_POST['delete_user_id']);
    } elseif (isset($_POST['add_event'])) {
        // Add Event Logic
        $image_url = null;
        if ($_FILES['event_image']['error'] == 0) {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($_FILES['event_image']['name'], PATHINFO_EXTENSION));
    
            if (in_array($fileExtension, $allowedExtensions)) {
                $uploadDirectory = 'images/';
    
                // Create the directory if it doesn't exist
                if (!is_dir($uploadDirectory)) {
                    mkdir($uploadDirectory, 0755, true);
                }
    
                $image_url = $uploadDirectory . uniqid() . '_' . $_FILES['event_image']['name'];
                move_uploaded_file($_FILES['event_image']['tmp_name'], $image_url);
            } else {
                echo "<script>alert('Invalid image format');</script>";
            }
        }

        $event_name = $_POST['event_name'];
        $event_date = $_POST['event_date'];
        $location = $_POST['location'];
        $category = $_POST['category'];
        $description = $_POST['description'];

        addEvent($conn, $event_name, $event_date, $location, $category, $image_url, $description);
    } elseif (isset($_POST['edit_event'])) {
        // Edit Event Logic
        $event_id = $_POST['edit_event_id'];
        $new_event_name = $_POST['new_event_name'];
        $new_event_date = $_POST['new_event_date'];
        $new_location = $_POST['new_location'];
        $new_category = $_POST['new_category'];
        $new_image_url = $_POST['new_image_url'];
        $new_description = $_POST['new_description'];

        editEvent($conn, $event_id, $event_name, $event_date, $location, $category, $image_url, $description);
    } elseif (isset($_POST['delete_event'])) {
        // Delete Event Logic
        $event_id = $_POST['delete_event_id'];

        deleteEvent($conn, $event_id);
    }

    // Check if form data for adding/editing bookings is submitted
    if (isset($_POST['add_booking'])) {
        // Add Booking Logic
        $user_id = $_POST['user_id'];
        $user_email = $_POST['user_email'];
        $package_name = $_POST['package_name'];
        $guest_count = $_POST['guest_count'];
        $color_palette = $_POST['color_palette'];
        $addons = $_POST['addons'];
        $event_date = $_POST['event_date'];
        $time_slot = $_POST['time_slot'];
        $location = $_POST['location'];
        $occasion = $_POST['occasion'];
        $full_name = $_POST['full_name'];
        $phone_number = $_POST['phone_number'];
        $movie_name = $_POST['movie_name'];
        $genre_option = $_POST['genre_option'];

        addBooking($conn, $user_id, $user_email, $package_name, $guest_count, $color_palette, $addons, $event_date, $time_slot, $location, $occasion, $full_name, $phone_number, $movie_name, $genre_option);
    } elseif (isset($_POST['edit_booking'])) {
        // Edit Booking Logic
        $booking_id = $_POST['booking_id'];
        $user_id = $_POST['user_id'];
        $user_email = $_POST['user_email'];
        $package_name = $_POST['package_name'];
        $guest_count = $_POST['guest_count'];
        $color_palette = $_POST['color_palette'];
        $addons = $_POST['addons'];
        $event_date = $_POST['event_date'];
        $time_slot = $_POST['time_slot'];
        $location = $_POST['location'];
        $occasion = $_POST['occasion'];
        $full_name = $_POST['full_name'];
        $phone_number = $_POST['phone_number'];
        $movie_name = $_POST['movie_name'];
        $genre_option = $_POST['genre_option'];

        editBooking($conn, $booking_id, $user_id, $user_email, $package_name, $guest_count, $color_palette, $addons, $event_date, $time_slot, $location, $occasion, $full_name, $phone_number, $movie_name, $genre_option);
    } elseif (isset($_POST['delete_booking'])) {
        // Delete Booking Logic
        $booking_id = $_POST['booking_id'];

        deleteBooking($conn, $booking_id);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinePark Admin Panel</title>
    <!-- Include Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mx-auto py-8">
        <div class="header bg-gray-800 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-extrabold tracking-tight text-yellow-500">CinePark Admin Panel</h1>
                <div class="flex items-center space-x-4">
                    <a href="../login.html" class="hover:text-gray-500 transition duration-300 ease-in-out">Logout</a>
                </div>
            </div>
        </div>
        <div class="admin-dashboard container mx-auto bg-white shadow-lg mt-8 p-6 rounded-lg">
            <!-- Links to manage users, events, bookings -->
            <ul class="flex space-x-4 mb-8">
                <li><a href="#users" class="text-blue-500 hover:text-blue-700">Manage Users</a></li>
                <li><a href="#events" class="text-blue-500 hover:text-blue-700">Manage Events</a></li>
                <li><a href="#bookings" class="text-blue-500 hover:text-blue-700">Manage Bookings</a></li>
            </ul>

            <!-- Section to manage users -->
            <section id="users">
                <h2 class="text-2xl font-bold mb-4">Manage Users</h2>
                <?php displayUsers($conn); ?>

                <!-- Add, edit, delete user forms go here -->
                <form method="post" action="" class="mb-4">
                    <div class="flex space-x-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-600">First Name:</label>
                            <input type="text" name="first_name" required
                                class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-600">Last Name:</label>
                            <input type="text" name="last_name" required
                                class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-600">Email:</label>
                            <input type="email" name="email" required
                                class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-600">Password:</label>
                            <input type="password" name="password" required
                                class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">
                        </div>
                    </div>
                    <button type="submit" name="add_user"
                        class="mt-4 p-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:border-blue-700">
                        Add User
                    </button>
                </form>


                <!-- Edit, delete user forms go here -->
                <?php displayEditDeleteUserForms($conn); ?>
            </section>

            <!-- Section to manage events -->
            <section id="events">
                <h2 class="text-2xl font-bold mb-4">Manage Events</h2>
                <?php displayEvents($conn); ?>

                <form method="post" action="" enctype="multipart/form-data">
                    <label for="event_name" class="block text-sm font-medium text-gray-600">Event Name:</label>
                    <input type="text" name="event_name" class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500" required>
                    <br>
                    <label for="event_date" class="block text-sm font-medium text-gray-600">Event Date:</label>
                    <input type="date" name="event_date" class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500" required>
                    <br>
                    <label for="location" class="block text-sm font-medium text-gray-600">Location:</label>
                    <input type="text" name="location" class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500" required>
                    <br>
                    <label for="category" class="block text-sm font-medium text-gray-600">Category:</label>
                    <input type="text" name="category" class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">
                    <br>
                    <label for="event_image" class="block text-sm font-medium text-gray-600">Event Image:</label>
                    <input type="file" name="event_image" accept="image/*" class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">
                    <br>
                    <label for="description" class="block text-sm font-medium text-gray-600">Description:</label>
                    <textarea name="description" class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500"></textarea>
                    <br>
                    <button type="submit" name="add_event"   class="mt-4 p-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:border-blue-700">Add Event</button>
                </form>

                <!-- Edit, delete event forms go here -->
                <?php displayEditDeleteEventForms($conn); ?>
            </section>

            <!-- Section to manage bookings -->
            <section id="bookings">
                <h2 class="text-2xl font-bold mb-4">Manage Bookings</h2>
                <?php displayBookings($conn); ?>

                <form method="post" action="" class="mb-4">
    <!-- Add your booking form fields here -->

    <!-- User ID -->
    <label for="user_id" class="block text-sm font-medium text-gray-600">User ID:</label>
    <input type="text" name="user_id" required
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <!-- User Email -->
    <label for="user_email" class="block text-sm font-medium text-gray-600">User Email:</label>
    <input type="email" name="user_email" required
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <!-- Package Name -->
    <label for="package_name" class="block text-sm font-medium text-gray-600">Package Name:</label>
    <input type="text" name="package_name" required
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <!-- Guest Count -->
    <label for="guest_count" class="block text-sm font-medium text-gray-600">Guest Count:</label>
    <input type="number" name="guest_count" required
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <!-- Color Palette -->
    <label for="color_palette" class="block text-sm font-medium text-gray-600">Color Palette:</label>
    <input type="text" name="color_palette"
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <!-- Addons -->
    <label for="addons" class="block text-sm font-medium text-gray-600">Addons:</label>
    <textarea name="addons"
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500"></textarea>

    <!-- Event Date -->
    <label for="event_date" class="block text-sm font-medium text-gray-600">Event Date:</label>
    <input type="date" name="event_date" required
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <!-- Time Slot -->
    <label for="time_slot" class="block text-sm font-medium text-gray-600">Time Slot:</label>
    <input type="text" name="time_slot" required
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <!-- Location -->
    <label for="location" class="block text-sm font-medium text-gray-600">Location:</label>
    <input type="text" name="location" required
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <!-- Occasion -->
    <label for="occasion" class="block text-sm font-medium text-gray-600">Occasion:</label>
    <input type="text" name="occasion" required
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <!-- Full Name -->
    <label for="full_name" class="block text-sm font-medium text-gray-600">Full Name:</label>
    <input type="text" name="full_name" required
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <!-- Phone Number -->
    <label for="phone_number" class="block text-sm font-medium text-gray-600">Phone Number:</label>
    <input type="tel" name="phone_number" required
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <!-- Movie Name -->
    <label for="movie_name" class="block text-sm font-medium text-gray-600">Movie Name:</label>
    <input type="text" name="movie_name"
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <!-- Genre Option -->
    <label for="genre_option" class="block text-sm font-medium text-gray-600">Genre Option:</label>
    <input type="text" name="genre_option"
        class="mt-1 p-2 border rounded-md w-64 focus:outline-none focus:border-blue-500">

    <button type="submit" name="add_booking"
        class="mt-4 p-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:border-blue-700">
        Add Booking
    </button>
</form>

                <!-- Edit, delete booking forms go here -->
                <?php displayEditDeleteBookingForms($conn); ?>
            </section>

        </div>
    </div>


</body>

</html>