<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = $_POST["contact-name"];
    $phone = $_POST["contact-phone"];
    $email = $_POST["contact-email"];
    $subject = $_POST["subject"];
    $message = $_POST["contact-message"];

    // Validate data (you can add more validation as needed)

    // Compose the email message
    $to = "sunnihithadega23@gmail.com";
    $subject = "New Contact Form Submission: $subject";
    $messageBody = "Name: $name\n";
    $messageBody .= "Phone: $phone\n";
    $messageBody .= "Email: $email\n\n";
    $messageBody .= "Message:\n$message";

    // Set additional headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    $mailSuccess = mail($to, $subject, $messageBody, $headers);

    // Prepare response
    $response = array();

    if ($mailSuccess) {
        $response["code"] = true;
        $response["success"] = "Message sent successfully!";
    } else {
        $response["code"] = false;
        $response["err"] = "Error sending message. Please try again later.";
    }

    // Send JSON response
    header("Content-Type: application/json");
    echo json_encode($response);
} else {
    // Handle the case where the script is accessed directly without a POST request
    header("HTTP/1.0 403 Forbidden");
    echo "Access Forbidden";
}
?>
