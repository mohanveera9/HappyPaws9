<?php
include('db.php');

// Check if the request is an AJAX request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $reservation_date = $_POST["reservation_date"];
        $reservation_time = $_POST["reservation_time"];
        $service_type = $_POST["service_type"];

        // Insert the booking details into the database
        $sql = "INSERT INTO bookings (name, email, reservation_date, reservation_time, service_type)
                VALUES ('$name', '$email', '$reservation_date', '$reservation_time', '$service_type')";

        $response = array();

        if ($conn->query($sql) === TRUE) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = $conn->error;
        }

        // Return JSON response
        echo json_encode($response);

        $conn->close();
        exit();
    }
}

// Handle non-AJAX requests here
?>
