<?php
session_start();
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Corrected Database connection parameters
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "clinic";

    // Create a database connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Escape and sanitize the data to prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile_number = $conn->real_escape_string($_POST['number']);
    $date = $conn->real_escape_string($_POST['date']);
    $slot = (int) $conn->real_escape_string($_POST['slot']);
    $status = $conn->real_escape_string($_POST['status']);

    // Assuming $conn is the database connection

    // Assuming $conn is the database connection



    // Assuming $conn is the database connection

    // Check if the slot is available before saving to the database
    $sqlCheckAvailability = "SELECT id FROM appointments WHERE date = '$date' AND slot = $slot AND status = 'booked'";
    $resultCheckAvailability = $conn->query($sqlCheckAvailability);

    // Check if the query execution was successful
    if ($resultCheckAvailability !== false) {
        // Fetch the number of rows in the result set
        $numRows = $resultCheckAvailability->num_rows;

        if ($numRows > 0) {
            // Slot is already booked
            $response = ['success' => false, 'message' => 'Slot is already booked. Please choose another slot.'];
        } else {
            // Save the appointment details to the database and mark the slot as booked
            $sqlInsertAppointment = "INSERT INTO appointments (name, email, phone, date, slot, status) VALUES ('$name', '$email', '$phone', '$date', $slot, 'booked')";

            // Check if the insertion was successful
            if ($conn->query($sqlInsertAppointment) === TRUE) {
                $response = ['success' => true, 'message' => 'Appointment booked successfully.'];
                header("location:index.html");
                die;
            } else {
                $response = ['success' => false, 'message' => 'Error booking appointment: ' . $conn->error];
            }
        }
    } else {
        // Handle the case where the query execution failed
        $response = ['success' => false, 'message' => 'Error executing the query: ' . $conn->error];
    }

    // Output the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);




}
