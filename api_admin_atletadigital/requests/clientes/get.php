<?php

if (isset($key) && is_numeric($key)) {
    $url = 'http://localhost:8080/clientes/?id=' . $key;
} else {
    $url = 'http://localhost:8080/clientes/';
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://localhost:8080/clientes/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);

curl_close($curl);

if (empty($response)) {
    $response = array();
} else {
    $response = json_decode($response, true);
}
