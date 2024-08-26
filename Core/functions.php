<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require base_path('vendor/autoload.php');

function dd($value)
{

    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function base_path($path)
{
    return BASE_PATH . $path;
}
function view($path,$attributes=[]){
    extract($attributes);
    return base_path('views/'.$path);
}

function abort($code=404)
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}
function login($user)
{

    $_SESSION['user'] = [
        'id' => $user['id'],
        'email' => $user['email']
    ];

    session_regenerate_id(true);
}

function logout()
{
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    header('Location: /');
}
function sendmail($email)
{

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '4794cf61ef5089';
        $mail->Password = 'ffa23053e4d4cd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = '465';

        //Recipients
        $mail->setFrom('yagouthasan3@gmail.com', 'hasan');
        $mail->addAddress($email, 'adsada');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Subject of the email';
        $mail->Body = 'This is the HTML message body <b>in bold!</b>';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
