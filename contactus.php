<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $to = "shanmugapriya.k.2021.cse@ritchennai.edu.in"; 
    $subject = "Message from Contact Form";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    if (mail($to, $subject, $body)) {
        echo "<script>alert('Message sent successfully');</script>";
    } else {
        echo "<script>alert('Failed to send message');</script>"; 
    } 
}
?>
