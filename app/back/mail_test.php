<?php

$to      = "hiromu.bado@gmail.com";
$subject = "TEST";
$message = "メールテスト";
$headers = "From: from@example.com";

$sendMailResult = false;
if (mb_send_mail($to, $subject, $message, $headers)) {
    $sendMailResult = true;
}

// if (mail($to, $subject, $message, $headers, $additional_params)) {
//     $sendMailResult = true;
// }

$response = array(
    'status' => true,
    'sendMailResult' => $sendMailResult,
    'message' => 'mail sended.'
);
echo json_encode($response);
