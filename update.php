<?php
// Pastikan metode adalah POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Metode tidak diizinkan.");
}

function parseRupiah($harga) {
    $harga = str_replace('Rp ', '', $harga);
    $harga = str_replace('.', '', $harga);
    return intval($harga);
}

$harga_mobil = parseRupiah($_POST['harga_mobil']);


// URI untuk mengakses webservice
try {
    $opt = [
        "location" => "http://localhost:1000/soapServer2.php",
        "uri" => "http://localhost:1000/",
        "trace" => 1
    ];
    
    // Membaca API
    $api = new SoapClient(NULL, $opt);

    // Proses file yang diunggah jika ada
    if ($_FILES['gambar_mobil']['size'] > 0) {
        $file_tmp = $_FILES['gambar_mobil']['tmp_name'];
        $file_name = $_FILES['gambar_mobil']['name'];
        move_uploaded_file($file_tmp, 'mobil/' . $file_name);
        $gambar_mobil = $file_name;
    } else {
        // Jika tidak ada file yang diunggah, gunakan nilai yang sudah ada
        $gambar_mobil = $_POST['gambar_mobil'];
    }

    // Memanggil metode untuk mengupdate data ke dalam layanan SOAP
    $komen = $api->updateData(
        $_POST['id_mobil'],
        $_POST['merk_mobil'],
        $_POST['tipe_mobil'],
        $_POST['warna_mobil'],
        $gambar_mobil,
        $_POST['status_mobil'],
        $harga_mobil
    );    
} catch (SoapFault $ex) {
    echo $api->__getLastResponse();
    exit();
}

// Menampilkan pesan respons dari layanan SOAP
if ($komen === "Ubah Data berhasil") {
    echo "<script type='text/javascript'>
        window.location.href = 'index.php';
    </script>";
} else {
    echo $komen;
}
?>
