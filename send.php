<?php
if (isset($_POST['name'])) {$name = $_POST['name'];}
if (isset($_POST['email'])) {$email = $_POST['email'];}
if (isset($_POST['message'])) {$message = $_POST['message'];}
if (isset($_POST['g_recaptcha_response'])) {$g_recaptcha_response = $_POST['g_recaptcha_response'];}

$address = 'info@neklo.com';
$sub = "Feedback from Magento.Neklo.com";
$mes = "Автор назвался: $name \nУказал свой адрес: $email \nСодержание письма: $message";
$verify = mail($address, $sub, $mes, "Content-type:text/plain; charset = UTF-8\r\nFrom: $email");

$message = array();

if ($g_recaptcha_response) {
    $message['title'] = 'THANK YOU!';
    $message['message'] = 'You message has been sent successfully';

} else {
    $message['message'] = 'Invalid captcha value';
}

exit(json_encode($message));
