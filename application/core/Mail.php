<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class Mail{
    private $error;
    
    public function sendMail($user_email, $from_email, $from_name, $subject, $body){
        $mail = new PHPMailer();
        // if you want to send mail via PHPMailer using SMTP credentials
        if (Config::get('EMAIL_USE_SMTP')) {
            // set PHPMailer to use SMTP
            $mail->isSMTP();
            // 0 = off, 1 = commands, 2 = commands and data, perfect to see SMTP errors
            $mail->SMTPDebug = 0;
            // encryption
            if (Config::get('EMAIL_SMTP_ENCRYPTION')) {
                    $mail->SMTPSecure = Config::get('EMAIL_SMTP_ENCRYPTION');
            }
            // enable SMTP authentication
            $mail->SMTPAuth = Config::get('EMAIL_SMTP_AUTH');
            // set SMTP provider's credentials
            $mail->Host = Config::get('EMAIL_SMTP_HOST');
            $mail->Port = Config::get('EMAIL_SMTP_PORT');
            $mail->Username = Config::get('EMAIL_SMTP_USERNAME');
            $mail->Password = Config::get('EMAIL_SMTP_PASSWORD');
        } else {
            $mail->isMail();
        }
        // fill mail with data
        $mail->From = $from_email;
        $mail->FromName = $from_name;
        $mail->AddAddress($user_email);
        $mail->Subject = $subject;
        $mail->Body = $body;
        // try to send mail
        $mail_send_status = $mail->send();
        if ($mail_send_status) {
            return true;
        } else {
            // if not successful, copy errors into Mail's error property
            $this->error = $mail->ErrorInfo;
            return false;
        }
    }
    
    public function getError(){
        return $this->error;
    }

}
