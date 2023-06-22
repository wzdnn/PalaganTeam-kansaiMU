<?php
namespace PalaganTeam\MuhKansai\App;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
class EmailSend{
    public static function sendEmail(string $emailTarget, string $subject, $body){
        require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/Exception.php';

        try{
            $mail = new PHPMailer;
            $mail->isSMTP();
            // server setting
            $mail->Host = 'smtp.hostinger.com';
            $mail->Username = 'NoReplay@muhammadiyah-kansai.com';
            $mail->Password = 'Admin@kansai2';
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

            $mail->setFrom('NoReplay@muhammadiyah-kansai.com', 'Muhammadiyah Kansai');
            $mail->addAddress($emailTarget);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->smtpClose();

            return $mail->send();
        } catch(Exception $ex){
            throw new Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }

}