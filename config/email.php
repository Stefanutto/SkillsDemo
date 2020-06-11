<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'lib/phpMailer/PHPMailer.php';
require_once 'lib/phpMailer/SMTP.php';
require_once 'lib/phpMailer/Exception.php';

class sendEmail{
    private $recipientEmail;
    private $recipientName;
    private $subject;
    private $msgHTML;
    private $Attachment;

    function __construct($recipientEmail, $recipientName, $subject, $msgHTML, $Attachment = "" ) {
        $this->recipientEmail = $recipientEmail;
        $this->recipientName = $recipientName;
        $this->subject = $subject;
        $this->msgHTML = $msgHTML;
        $this->Attachment = $Attachment;
        $this->send();
    }

    private function send(){

        $mail = new PHPMailer(true);
        try {
            //$mail->SMTPDebug = 2;
            $mail->CharSet = EMAIL_CHARSET;
            $mail->isSMTP();
            $mail->Host = EMAIL_SMTP;
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            $mail->Username = EMAIL_USER;
            $mail->Password = EMAIL_PASS;
            $mail->SMTPSecure = EMAIL_SMTP_SECURE;
            $mail->Port = EMAIL_PORT;
            $mail->setFrom(EMAIL_USER);
            if(strlen($this->recipientEmail) > 0 ){
                $mail->addAddress($this->recipientEmail, $this->recipientName);
            }
            $mail->addAddress(EMAIL_USER);
            $mail->isHTML(EMAIL_IS_HTML);
            $mail->Subject = $this->subject;
            $mail->msgHTML($this->msgHTML);
            //Attachments
            if($this->Attachment != "")
                $mail->addAttachment($this->Attachment);         // Add attachments

            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
            $mail->send();
            if($this->Attachment != "")
                unlink($this->Attachment);
        } catch (Exception $e) {
            //echo 'Message could not be sent.';
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
            $log = new Log();
            $log->WriteLog('Mailer Error: ' . $mail->ErrorInfo);
        }
    }
}
