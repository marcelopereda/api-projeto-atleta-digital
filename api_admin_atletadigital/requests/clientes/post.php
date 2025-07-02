<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://localhost:8080/clientes/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Accept:Charset=UTF-8'
    ),
    CURLOPT_POSTFIELDS => json_encode($postfields),
  
));

$response = curl_exec($curl);

curl_close($curl);

if (empty($response)) {
    $response = array();
} else {
    $response = json_decode($response, true);
}
