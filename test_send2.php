<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$sid = env('TWILIO_SID');
$token = env('TWILIO_AUTH_TOKEN');
$csid = env('TWILIO_CONTENT_SID');
$from = env('TWILIO_FROM_NUMBER');
$resp = Illuminate\Support\Facades\Http::withBasicAuth($sid, $token)->asForm()->post('https://api.twilio.com/2010-04-01/Accounts/'.$sid.'/Messages.json', [
    'From' => $from,
    'To' => 'whatsapp:+6281234567890',
    'ContentSid' => $csid,
    'ContentVariables' => json_encode(['1'=>'Budi', '2'=>"Baris 1\r\nBaris 2"])
]);
echo $resp->body();
