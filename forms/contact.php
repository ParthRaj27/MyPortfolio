<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form field data
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Check for empty values
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        // Handle empty fields
        http_response_code(400);
        echo "Please fill out all the fields.";
        exit;
    }

    // Set recipient email address
    $recipient = "parthrajyaguru279@gmail.com"; // Change this to your email

    // Set email subject
    $email_subject = "New Contact Form Submission: $subject";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers
    $email_headers = "From: $name <$email>";

    // Send the email
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // If successful, send success message
        http_response_code(200);
        echo "Your message has been sent. Thank you!";
    } else {
        // If failed to send email
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // If not a POST request
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
