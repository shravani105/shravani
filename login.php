<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // $name = $_POST['name']; // You commented this line, so it's not used
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script type='text/javascript'>alert('Invalid email format' )</script>";
        exit;
    }

    // Validate age (minimum 10 years)
    $currentDate = date('Y-m-d');
    $ageLimitDate = date('Y-m-d', strtotime('-10 years', strtotime($currentDate)));
    
    if ($dob >= $ageLimitDate) {
        echo "<script type='text/javascript'>alert('You must be at least 10 years old' )</script>";
        exit;
    }

    if (!empty($email) && !empty($password)) {
        $query = "SELECT * FROM form WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $u_data = mysqli_fetch_assoc($result);
            if ($u_data['password'] == $password) {
                echo "<script type='text/javascript'>alert('Login successful' )</script>";
                header("location:INDEXX.php");
                exit;
            } else {
                echo "<script type='text/javascript'>alert('Email and password do not match')</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Email does not exist, register first')</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Email and password cannot be empty')</script>";
    }
}

