<?php
/**
 * Created by PhpStorm.
 * User: Ez01
 * Date: 02/05/2019
 * Time: 22:02
 *
 * To send mail please create object PHPMailer.php
 * next call the method setup parameters
 * next send mail with the method -> send mail
 *
 * NOTE THAT YOU MUST ENABLE MAIL IN THE CONFIGURATION
 *
 */


include('PHPMailer/class.phpmailer.php');
include("PHPMailer/class.smtp.php");
include("./configuration.php");


class class_mail_handler
{
    const ALT_BODY_DEFAULT = "To view the message, please use an HTML compatible email viewer!";
    private $mail = false;

    public function __construct()
    {
        $this->mail = new PHPMailer;
        $this->mail->IsSMTP();
        $this->mail->SMTPDebug = 0;
        $this->mail->SMTPAuth = true;
        $this->mail->Host = SMTP_SERVER;
        $this->mail->Port = SMTP_PORT;
        $this->mail->Username = SMTP_USERNAME;
        $this->mail->Password = SMTP_PASSWORD;
    }

    public function setup_parameters($mail_from, $from_name, $subject, $msg_html, $to_address, $to_name = "", $alt_body = alt_body_default)
    {

        $this->mail->SetFrom($mail_from, $from_name);

        $this->mail->Subject = $subject;

        $this->mail->AltBody = $alt_body; // optional, comment out and test

        $this->mail->MsgHTML($msg_html);

        if ($to_name = "") {
            $to_name = $to_address;
        }

        $this->mail->AddAddress($to_address, $to_name);

    }

    //returns 1 when sent 0 when error 2 when mail not enabled in configuration
    public function send_mail()
    {

        if (MAIL_ENABLE == true) {
            if (!$this->mail->Send()) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }

    }


}