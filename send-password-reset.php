<?php
$email = $_POST["email"];

// Generate a random token
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);

// Calculate the token expiration time (e.g., 30 minutes)
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

include("database.php");

$sql = "UPDATE form
        SET reset_token_hash = ?,
        reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($conn->affected_rows) {
    require("mailer.php");

    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END
        Click <a href="http://localhost/form/reset-password.php?token=$token">here</a>
        to reset your password.
    END;

    try {
        $mail->send();
        echo "Message sent. Please check your inbox.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }
} else {
    echo "Email not found or the database update failed.";
}
