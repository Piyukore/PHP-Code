<?php
if (isset($_POST['email']) && isset($_POST['report'])) {
    $email = $_POST['email'];
    $report = $_POST['report'];

    $subject = 'Student Report Card';
    $message = '<html><body>'. $report. '</body></html>';
    $headers = 'MIME-Version: 1.0'. "\r\n";
    $headers.= 'Content-type: text/html; charset=iso-8859-1'. "\r\n";
    $headers.= 'From: praptikore967@gmail.com'. "\r\n";

    if (mail($email, $subject, $message, $headers)) {
       header("Location: http://localhost/student/generate_report.php");
       exit(); 
    } else {
        echo 'Failed to send report!';
    }
}
?>