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
    
    // Ambil data mobil untuk ditampilkan pada pop-up konfirmasi
    $dataMobilJson = $api->bacaSatu($id_mobil);
    $dataMobilArray = json_decode($dataMobilJson, true);
    
    if (empty($dataMobilArray)) {
        die("Data mobil tidak ditemukan.");
    }
    
    $mobilInfo = json_encode($dataMobilArray[0]);

    // Jika pengguna mengonfirmasi penghapusan, hapus data
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        $komen = $api->hapusData($id_mobil);
        echo "<script>alert('$komen'); window.location.href = 'index.php';</script>";
        exit();
    }

} catch (SoapFault $ex) {
    echo $api->__getLastResponse();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hapus Data Mobil</title>
</head>
<body>
<script type="text/javascript">
    // Data mobil yang akan dihapus
    var dataMobil = <?php echo $mobilInfo; ?>;
    var mobilDetails = "ID: " + dataMobil.id_mobil + "\n" +
                       "Merk: " + dataMobil.merk_mobil + "\n" +
                       "Tipe: " + dataMobil.tipe_mobil + "\n" +
                       "Warna: " + dataMobil.warna_mobil + "\n" +
                       "Harga: " + dataMobil.harga_mobil;

    // Konfirmasi penghapusan
    var confirmDelete = confirm("Apakah Anda yakin ingin menghapus data mobil ini?\n\n" + mobilDetails);
    if (confirmDelete) {
        window.location.href = 'hapus.php?id_mobil=<?php echo $id_mobil; ?>&confirm=yes';
    } else {
        window.location.href = 'index.php';
    }
</script>
</body>
</html>
