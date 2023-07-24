<?php
session_start();
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

$alert = array(
    "type-success" => "success",
    "message-success" => "Email Başarılı bir şekilde gönderildi!",
    "type-danger" => "danger",
    "message-danger" => "Eksik Bilgi Göndermezsiniz!"
);
if(isset($_POST["submit"])){
    if (isset($_POST["receiverEmail"]) && isset($_POST["senderEmail"]) && isset($_POST["topicEmail"]) && isset($_POST["message"])) {
        // Check if any of the fields are empty
        if ($_POST["receiverEmail"] !== "" && $_POST["senderEmail"] !== "" && $_POST["topicEmail"] !== "" && $_POST["message"] !== "") {
            // Form data is complete, proceed to send the email
            $receiverEmail = $_POST["receiverEmail"];
            $senderEmail = $_POST["senderEmail"];
            $emailSubject = $_POST["topicEmail"];
            $emailMessage = $_POST["message"];
            $file = $_FILES["file"];
    
            if (move_uploaded_file($file["tmp_name"], "files/" . $file["name"])) {
                // Create a new PHPMailer instance
                $mail = new PHPMailer(true);
    
                try {
                    // Set up SMTP configuration
                    $mail->SMTPDebug = 2;
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = '';
                    $mail->Password = '';
                    $mail->CharSet = 'utf8';
                    $mail->SMTPSecure = 'tls'; // or 'ssl' if your SMTP server requires it
                    $mail->Port = 587; // or the port number used by your SMTP server
                    // ... (Your SMTP configuration remains unchanged) ...
    
                    // Set up email parameters
                    $mail->setFrom($senderEmail, 'Uygar Eren');
                    $mail->addAddress($receiverEmail); // Receiver email address
    
                    // Add the attachment
                    $mail->addAttachment("files/" . $file['name']);
    
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = $emailSubject;
                    $mail->Body = $emailMessage;
    
                    // Send the email
                    if ($mail->send()) {
                        // Email sent successfully, set success message
                        $_SESSION["type"] = $alert["type-success"];
                        $_SESSION["message"] = $alert["message-success"];
                        header("Location: http://localhost/phpMailer/index.php");
                        exit();
                    } else {
                        $_SESSION["type"] = $alert["type-danger"];
                        $_SESSION["message"] = $alert["message-danger"];
                    }
                } catch (Exception $e) {
                    // Email sending failed, set error message
                    $_SESSION["type"] = $alert["type-danger"];
                    $_SESSION["message"] = "Email gönderirken bir hata oluştu: " . $mail->ErrorInfo;
                }
            } else {
                // Error moving uploaded file, set error message
                $_SESSION["type"] = $alert["type-danger"];
                $_SESSION["message"] = "Dosya yüklenirken bir hata oluştu.";
            }
        } else {
            // Form data is incomplete, set error message
            $_SESSION["type"] = $alert["type-danger"];
            $_SESSION["message"] = $alert["message-danger"];
        }
    } else {
        // Form data not submitted, set error message
        $_SESSION["type"] = $alert["type-danger"];
        $_SESSION["message"] = $alert["message-danger"];
    }
}


// Do not redirect here, it will redirect automatically after form submission
header("Location: http://localhost/phpMailer/index.php");
exit();

?>
