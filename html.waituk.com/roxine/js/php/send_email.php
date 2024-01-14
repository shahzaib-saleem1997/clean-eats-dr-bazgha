<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
// Check if the form data is present
if (
    isset($_POST['con_fname']) &&
    isset($_POST['con_lname']) &&
    isset($_POST['con_phone']) &&
    isset($_POST['con_message']) &&
    isset($_POST['con_email'])
) {
    // Collect form data
    $con_fname = $_POST['con_fname'];
    $con_lname = $_POST['con_lname'];
    $con_phone = $_POST['con_phone'];
    $con_message = $_POST['con_message'];
    $con_email = $_POST['con_email'];

    // Compose the email message
    $subject = 'Contact Form Submission';
    $message = "First Name: $con_fname\n";
    $message .= "Last Name: $con_lname\n";
    $message .= "Phone: $con_phone\n";
    $message .= "Email: $con_email\n";
    $message .= "Message:\n$con_message";

    // Set the recipient email address
    $to = 'shahzaib.saleem1997@gmail.com'; // Replace with the actual email address

    // Set additional headers
    $headers = "From: $con_email\r\n";
    $headers .= "Reply-To: $con_email\r\n";

    // Send the email
    $success = mail($to, $subject, $message, $headers);

    // Check if the email was sent successfully
    if ($success) {
        $response = array('response' => 'success', 'message' => 'Email sent successfully.');
    } else {
        $response = array('response' => 'error', 'message' => 'Failed to send email. Please try again.');
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request, missing form data
    $response = array('response' => 'error', 'message' => 'Invalid request. Missing form data.');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
