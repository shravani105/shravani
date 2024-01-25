<?php
session_start();
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Corrected Database connection parameters
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "doctor";

    // Create a database connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data and sanitize it
    $first_name = $conn->real_escape_string($_POST['name']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile_number = $conn->real_escape_string($_POST['number']);
    $role= $conn->real_escape_string($_POST['role']);
    $password= $conn->real_escape_string($_POST['password']);


    // Prepare and execute the SQL query to insert data
    $sql = "INSERT INTO form (name, dob, email, number,role,password) VALUES (?, ?, ?, ? , ? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $first_name, $dob, $email, $mobile_number,$role,$password);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Registration successfull!!!' )</script>";
        header("location:index.html"); 
        die;
    } else {
        echo "<script type='text/javascript'>alert('Error occured,register Again!!' )</script>";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">

   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <title>HOME PAGE</title>
    
    
</head>

<body>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="HOMEE.css">
        <title>HOME PAGE</title>
    </head>

    <body>
        

        <header class="header">
            <a href="#" class="logo"> <i class="fas fa-heartbeat"></i>E-CLINIC WORKS</a>
            

            <nav class="navbar">
                <a href="home.html">HOME</a>
                <a href="about.html">ABOUT</a>
                <a href="APPOIN.html">APPOINTMENT</a>
                <a href="doctor.html">DOCTOR</a>
                <a href="#">CONTACT</a>
               
            </nav>
            <button class="btnLogin-popup">LOGIN</button>
            <div id="menu-btn">
                <i class="fa fa-bars"></i>
            </div>
            <div id="close-btn">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
            

        </header>

        
        <div class="wrapper">
            <span class="icon-close">
                <ion-icon name="close-outline"></ion-icon>
            </span>
            <div class="form-box login">
                <h2>LOGIN</h2>
                <form action="verify.php" method="post">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <input type="text" name="name" required>
                        <label>Name</label>

                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                        <input type="email" name="email" required>
                        <label>Email-Id</label>
                    </div>
                  
                    <a href="verify.html">
                        <button type="submit" class="btn">PROCEED</button>
                    </a>
                    <div class="login-register">
                        <p> Not registered yet??
                            <a href="#" class="register-link"> REGISTER NOW!!</a>
                        </p>
                    </div>
                </form>
            </div>

            <div class="form-box register">
                <h2>Registeration</h2>
                <form action="#" method="post">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <input type="text" name="name" required>
                        <label> FULL NAME</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="calendar-outline"></ion-icon></span>
                        <input type="date" name="dob" required>
                        <label>BIRTH DATE</label>
                    </div>
                    

                    <div class="input-box">
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <input type="tel" name="number" pattern="^[789]\d{9}$" required>
                        <label>PHONE NO</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                        <input type="email" name="email" required>
                        <label>EMAIL ID</label>
                    </div>
                    <button type="submit" class="btn">REGISTER</button>
                    <div class="login-register">
                        <p> Already Registered??
                            <a href="#" class="login-link">LOGIN</a>
                        </p>
                    </div>

                </form>
            </div>
        </div>



        <script src="HOMEE.js"></script>
        <script src="HOMEE.php"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>



    </body>

    </html> -->