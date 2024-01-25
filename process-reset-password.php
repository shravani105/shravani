<?php
// Start by including your database connection
include("database.php");

// Enable error reporting for development (disable this in production)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Collect the token and password from POST data
$token = $_POST["token"] ?? null;
$password = $_POST["password"] ?? null;
$password_confirm = $_POST["password_confirm"] ?? null;

// Hash the token
$token_hash = hash("sha256", $token);

// Check for token's existence
if (!$token) {
    // Redirect to a friendly error page or output an error message
    exit("Token is required.");
}

// SQL query to find the user by reset token
$sql = "SELECT * FROM form WHERE reset_token_hash = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if the user exists and the token is valid
if (!$user) {
    exit("Invalid token.");
} elseif (strtotime($user["reset_token_expires_at"]) <= time()) {
    exit("Token has expired.");
}

// Validate the password
if (!$password || strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password)) {
    exit("Password does not meet the requirements.");
}

// Check if passwords match
if ($password !== $password_confirm) {
    exit("Passwords do not match.");
}

// Update the user's password
$sql = "UPDATE form SET pass = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE user = ?";
$stmt = $conn->prepare($sql);
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password before storing
$stmt->bind_param("ss", $hashed_password, $user["user"]);
$stmt->execute();

// Redirect to a success page or output a success message
echo "PASSWORD UPDATED";

// Close the database connection
$stmt->close();
$conn->close();

