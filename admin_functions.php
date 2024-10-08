<?php
session_start();
include "db.php";
function addUser($conn, $first_name, $last_name, $email, $password) {
    // Add a new user to the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$hashed_password')";
    $conn->query($sql);
}

function editUser($conn, $user_id, $first_name, $last_name, $email, $password) {
    // Edit user details in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', password='$hashed_password' WHERE id=$user_id";
    $conn->query($sql);
}

function deleteUser($conn, $user_id) {
    // Delete a user from the database
    $sql = "DELETE FROM users WHERE id=$user_id";
    $conn->query($sql);
}

function displayUsers($conn) {
    // Display a table of users
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Actions</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['first_name'] . '</td>';
            echo '<td>' . $row['last_name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td><a href="?edit_user=' . $row['id'] . '">Edit</a> | <a href="?delete_user=' . $row['id'] . '">Delete</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No users found.';
    }
}

// Add Event
function addEvent($conn, $event_name, $event_date, $location, $category, $image_url, $description)
{
    // Check if required fields are not null
    if ($event_name === null || $event_date === null || $location === null) {
        echo 'Error: Required fields are missing.';
        return;
    }
    $query = "INSERT INTO events (event_name, event_date, location, category, image_url, description) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $event_name, $event_date, $location, $category, $image_url, $description);
    $stmt->execute();
    $stmt->close();
}

// Edit Event
function editEvent($conn, $event_id, $event_name, $event_date, $location, $category, $image_url, $description) {
    $query = "UPDATE events SET event_name = ?, event_date = ?, location = ?, category = ?, image_url = ?, description = ? WHERE event_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $event_name, $event_date, $location, $category, $image_url, $description, $event_id);
    $stmt->execute();
    $stmt->close();
}

// Delete Event
function deleteEvent($conn, $event_id) {
    $query = "DELETE FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $stmt->close();
}

// Display Events
function displayEvents($conn) {
    $query = "SELECT * FROM events";
    $result = $conn->query($query);
    // Implement logic to fetch and display events
}

// Add Booking
function addBooking($conn, $user_id, $user_email, $package_name, $guest_count, $color_palette, $addons, $event_date, $time_slot, $location, $occasion, $full_name, $phone_number, $movie_name, $genre_option)
{
    $query = "INSERT INTO bookings (user_id, user_email, package_name, guest_count, color_palette, addons, event_date, time_slot, location, occasion, full_name, phone_number, movie_name, genre_option) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        echo 'Error: ' . $conn->error;
        return;
    }

    // Bind parameters
    $stmt->bind_param("isssssssssssss", $user_id, $user_email, $package_name, $guest_count, $color_palette, $addons, $event_date, $time_slot, $location, $occasion, $full_name, $phone_number, $movie_name, $genre_option);

    // Execute the statement
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        echo 'Error: ' . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Edit Booking
function editBooking($conn, $booking_id, $user_id, $user_email, $package_name, $guest_count, $color_palette, $addons, $event_date, $time_slot, $location, $occasion, $full_name, $phone_number, $movie_name, $genre_option) {
    $query = "UPDATE bookings SET user_id = ?, user_email = ?, package_name = ?, guest_count = ?, color_palette = ?, addons = ?, event_date = ?, time_slot = ?, location = ?, occasion = ?, full_name = ?, phone_number = ?, movie_name = ?, genre_option = ? WHERE booking_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssssssssssi", $user_id, $user_email, $package_name, $guest_count, $color_palette, $addons, $event_date, $time_slot, $location, $occasion, $full_name, $phone_number, $movie_name, $genre_option, $booking_id);
    $stmt->execute();
    $stmt->close();
}

// Delete Booking
function deleteBooking($conn, $booking_id) {
    $query = "DELETE FROM bookings WHERE booking_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $stmt->close();
}

// Display Bookings
function displayBookings($conn) {
    $query = "SELECT * FROM bookings";
    $result = $conn->query($query);
    // Implement logic to fetch and display bookings
}
function displayEditDeleteUserForms($conn)
{
    // Fetch users for display
    $usersQuery = "SELECT * FROM users";
    $usersResult = $conn->query($usersQuery);

    if ($usersResult && $usersResult->num_rows > 0) {
        echo '<h3 class="text-xl font-bold mb-2">Edit / Delete Users</h3>';
        echo '<ul class="space-y-2">';

        while ($user = $usersResult->fetch_assoc()) {
            echo '<li class="flex items-center space-x-4">';
            echo '<span class="font-bold">' . $user['first_name'] . ' ' . $user['last_name'] . '</span>';

            // Edit user form
            echo '<form method="post" action="" class="flex items-center">';
            echo '<input type="hidden" name="edit_user_id" value="' . $user['id'] . '">';
            echo '<button type="submit" name="edit_user" class="p-2 bg-green-500 text-white rounded-md hover:bg-green-700 focus:outline-none focus:border-green-700">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">';
            echo '<path fill-rule="evenodd" d="M16 5a1 1 0 0 0-1 1v10a1 1 0 0 0 2 0V6a1 1 0 0 0-1-1zm-2.586 7.707a1 1 0 0 0 1.414 0L16 10.414l1.293 1.293a1 1 0 0 0 1.414-1.414l-3-3a1 1 0 0 0-1.414 0L9 12.586l-2.293-2.293a1 1 0 0 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0L14 12.586l2.293 2.293z"/>';
            echo '</svg>';
            echo '</button>';
            echo '</form>';

            // Delete user form
            echo '<form method="post" action="" class="flex items-center">';
            echo '<input type="hidden" name="delete_user_id" value="' . $user['id'] . '">';
            echo '<button type="submit" name="delete_user" class="p-2 bg-red-500 text-white rounded-md hover:bg-red-700 focus:outline-none focus:border-red-700">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">';
            echo '<path fill-rule="evenodd" d="M5 2a1 1 0 0 1 1 1v12a1 1 0 0 1-2 0V3a1 1 0 0 1 1-1zm4-1a1 1 0 0 1 2 0v12a1 1 0 0 1-2 0V1zM2 4a1 1 0 0 1 1-1h1.111a1 1 0 0 1 .555.166l.554.37 1.486 1.486a1 1 0 1 1-1.414 1.414L4 4.414V15a1 1 0 0 1-2 0V4z"/>';
            echo '</svg>';
            echo '</button>';
            echo '</form>';

            echo '</li>';
        }

        echo '</ul>';
    } else {
        echo '<p>No users found.</p>';
    }
}
function displayEditDeleteEventForms($conn)
{
    // Fetch events for display
    $eventsQuery = "SELECT * FROM events";
    $eventsResult = $conn->query($eventsQuery);

    if ($eventsResult && $eventsResult->num_rows > 0) {
        echo '<h3 class="text-xl font-bold mb-2">Edit / Delete Events</h3>';
        echo '<ul class="space-y-2">';

        while ($event = $eventsResult->fetch_assoc()) {
            echo '<li class="flex items-center space-x-4">';
            echo '<span class="font-bold">' . $event['event_name'] . '</span>';

            // Edit event form
            echo '<form method="post" action="" class="flex items-center">';
            echo '<input type="hidden" name="edit_event_id" value="' . $event['event_id'] . '">';
            echo '<button type="submit" name="edit_event" class="p-2 bg-green-500 text-white rounded-md hover:bg-green-700 focus:outline-none focus:border-green-700">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">';
            echo '<path fill-rule="evenodd" d="M16 5a1 1 0 0 0-1 1v10a1 1 0 0 0 2 0V6a1 1 0 0 0-1-1zm-2.586 7.707a1 1 0 0 0 1.414 0L16 10.414l1.293 1.293a1 1 0 0 0 1.414-1.414l-3-3a1 1 0 0 0-1.414 0L9 12.586l-2.293-2.293a1 1 0 0 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0L14 12.586l2.293 2.293z"/>';
            echo '</svg>';
            echo '</button>';
            echo '</form>';

            // Delete event form
            echo '<form method="post" action="" class="flex items-center">';
            echo '<input type="hidden" name="delete_event_id" value="' . $event['event_id'] . '">';
            echo '<button type="submit" name="delete_event" class="p-2 bg-red-500 text-white rounded-md hover:bg-red-700 focus:outline-none focus:border-red-700">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">';
            echo '<path fill-rule="evenodd" d="M5 2a1 1 0 0 1 1 1v12a1 1 0 0 1-2 0V3a1 1 0 0 1 1-1zm4-1a1 1 0 0 1 2 0v12a1 1 0 0 1-2 0V1zM2 4a1 1 0 0 1 1-1h1.111a1 1 0 0 1 .555.166l.554.37 1.486 1.486a1 1 0 1 1-1.414 1.414L4 4.414V15a1 1 0 0 1-2 0V4z"/>';
            echo '</svg>';
            echo '</button>';
            echo '</form>';

            echo '</li>';
        }

        echo '</ul>';
    } else {
        echo '<p>No events found.</p>';
    }
}
function displayEditDeleteBookingForms($conn)
{
    // Fetch bookings for display
    $bookingsQuery = "SELECT * FROM bookings";
    $bookingsResult = $conn->query($bookingsQuery);

    if ($bookingsResult) {
        echo '<h3 class="text-xl font-bold mb-2">User Bookings</h3>';
        echo '<ul class="space-y-2">';

        while ($booking = $bookingsResult->fetch_assoc()) {
            echo '<li class="flex items-center space-x-4">';
            
            // Check if the key "booking_id" is set
            $bookingId = isset($booking['booking_id']) ? $booking['booking_id'] : null;

            // Display booking details
            echo '<span class="font-bold">' . $booking['package_name'] . '</span>';

            // Edit booking form
            echo '<form method="post" action="" class="flex items-center">';
            echo '<input type="hidden" name="edit_booking_id" value="' . $bookingId . '">';
        
            
            echo '<path fill-rule="evenodd" d="M16 5a1 1 0 0 0-1 1v10a1 1 0 0 0 2 0V6a1 1 0 0 0-1-1zm-2.586 7.707a1 1 0 0 0 1.414 0L16 10.414l1.293 1.293a1 1 0 0 0 1.414-1.414l-3-3a1 1 0 0 0-1.414 0L9 12.586l-2.293-2.293a1 1 0 0 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0L14 12.586l2.293 2.293z"/>';
            echo '</svg>';
            echo '</button>';
            echo '</form>';

            // Delete booking form
            echo '<form method="post" action="" class="flex items-center">';
            echo '<input type="hidden" name="delete_booking_id" value="' . $bookingId . '">';
         
           
            echo '<path fill-rule="evenodd" d="M5 2a1 1 0 0 1 1 1v12a1 1 0 0 1-2 0V3a1 1 0 0 1 1-1zm-2.586 7.707a1 1 0 0 0 1.414 0L16 10.414l1.293 1.293a1 1 0 0 0 1.414-1.414l-3-3a1 1 0 0 0-1.414 0L9 12.586l-2.293-2.293a1 1 0 0 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0L14 12.586l2.293 2.293z"/>';
            echo '</svg>';
            echo '</button>';
            echo '</form>';

            echo '</li>';
        }

        echo '</ul>';
    } else {
        echo '<p>No bookings found.</p>';
    }
}

?>