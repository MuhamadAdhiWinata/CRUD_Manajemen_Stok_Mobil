<?php
// URI untuk mengakses webservice
try {
    $opt = [
        "location" => "http://localhost:1000/soapServer2.php",
        "uri" => "http://localhost:1000/",
        "trace" => 1
    ];
    // Membaca API
    $api = new SoapClient(NULL, $opt);
    $komen = $api->updateData(
        $_POST['id_mobil'],
        $_POST['merk_mobil'],
        $_POST['tipe_mobil'],
        $_POST['warna_mobil'],
        $_POST['gambar_mobil'],
        $_POST['status_mobil'],
        $_POST['harga_mobil']
    );
} catch (SoapFault $ex) {
    echo $api->__getLastResponse();
    exit();
}

if ($komen === "Ubah Data berhasil") {
    echo "<script type='text/javascript'>
        window.location.href = 'index.php';
    </script>";
} else {
    echo $komen;
}
?>
