<?php

if ($_POST) {
    $text = $_POST['text'];
    $text_arr = preg_split('/[\s]+/', $text, 4);

    $addTo_arr = preg_split('/[\|]+/', $text_arr[1]);
    $addTo = substr($addTo_arr[1], 0, -1);
    $setSubject = $text_arr[2];
    $setText = $text_arr[3];

    require 'vendor/autoload.php';

    $sendgrid = new SendGrid(getenv('SENDGRID_USERNAME'), getenv('SENDGRID_PASSWORD'));

    $mail = new SendGrid\Email();
    $mail
        ->addTo($addTo)
        ->setFrom('slack@example.com')
        ->setSubject($setSubject)
        ->setText($setText)
    ;

    $result = $sendgrid->send($mail);
    if ($result = '200') {
        echo json_encode(array('text' => '送信完了です！'));
    }else{
        echo json_encode(array('text' => '送信失敗です'));
    }
}

?>
