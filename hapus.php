<?php
// Pastikan parameter 'id_mobil' tersedia
if (!isset($_GET['id_mobil'])) {
    die("ID mobil tidak ditemukan.");
}

$id_mobil = $_GET['id_mobil'];

// URI untuk mengakses webservice
try {
    $opt = [
        "location" => "http://localhost:1000/soapServer2.php",
        "uri" => "http://localhost:1000/",
        "trace" => 1
    ];
    // Membaca API
    $api = new SoapClient(NULL, $opt);
    $komen = $api->hapusData($id_mobil);
} catch (SoapFault $ex) {
    echo $api->__getLastResponse();
    exit();
}
?>
<script type="text/javascript">
    alert('<?php echo $komen; ?>');
    window.location.href = 'index.php';
</script>
