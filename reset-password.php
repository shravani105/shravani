<?php
// process-reset-password.php

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST["token"];
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];

    // Check if passwords match
    if ($password !== $password_confirm) {
        die("Passwords do not match");
    }

    // Add additional password strength validation if needed

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    include("database.php");

    // Update the user's password in the database
    $sql = "UPDATE form SET pass = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE reset_token_hash = ?";
    $stmt = $con->prepare($sql);
    $hashed_token = hash("sha256", $token);
    $stmt->bind_param("ss", $hashed_password, $hashed_token);
    $stmt->execute();

    // Check if the password was updated successfully
    if ($stmt->affected_rows > 0) {
        echo "Password updated successfully";
    } else {
        echo "Failed to update password";
    }

    // Close the statement and database connection
    $stmt->close();
    $con->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Your CSS styles -->
</head>
<body>
    <h1>Reset Password</h1>
    <form action="process-reset-password.php" method="post">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <label for="password">New Password</label>
        <input type="password" name="password" required>
        <label for="password_confirm">Confirm New Password</label>
        <input type="password" name="password_confirm" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>


