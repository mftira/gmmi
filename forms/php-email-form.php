<?php
// Change the following line to your receiving email address
$receiving_email_address = 'materialsengineeringclub@gmail.com';

// Check if the form data is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate form data
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        // If any of the required fields are empty, return an error response
        echo 'Please fill in all the fields.';
        http_response_code(400); // Bad request
        exit;
    }

    // Construct email message
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n\n";
    $email_message .= "Message:\n$message";

    // Send email
    $headers = "From: $name <$email>\r\nReply-To: $email\r\n";
    if (mail($receiving_email_address, $subject, $email_message, $headers)) {
        // If the email is sent successfully, return a success response
        echo 'OK';
    } else {
        // If there's an error sending the email, return an error response
        echo 'Something went wrong. Please try again later.';
        http_response_code(500); // Internal server error
    }
} else {
    // If the request method is not POST, return a method not allowed response
    echo 'Method not allowed.';
    http_response_code(405); // Method not allowed
}
?>
