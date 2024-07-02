<?php
    //uri untuk mengakses webservice
   $opt = ["location" => "http://localhost:1000/soapServer2.php",
    "uri" => "http://localhost:1000/",
    "trace" => 1];
    //membaca api
    $api = new SoapClient(NULL, $opt);
    //memanggil fungsi api
    echo $api->ambilData();
    ?>