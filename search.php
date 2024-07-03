<?php
require_once 'soapServer2.php';

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$opt = [
    "location" => "http://localhost:1000/soapServer2.php",
    "uri" => "http://localhost:1000/",
    "trace" => 1
];
$api = new SoapClient(NULL, $opt);
$response = $api->cariData($keyword); // Memanggil metode cariData
echo $response;
?>
