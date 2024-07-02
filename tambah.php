<?php
// URI untuk mengakses web service
$opt = [
    "location" => "http://localhost:1000/soapServer2.php",
    "uri" => "http://localhost:1000/",
    "trace" => 1
];
$api = new SoapClient(NULL, $opt);

// Jika ada pengiriman data dari form, proses untuk menambahkan data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangani file yang diunggah
    $file_tmp = $_FILES['gambar_mobil']['tmp_name'];
    $file_name = $_FILES['gambar_mobil']['name'];
    move_uploaded_file($file_tmp, 'mobil/' . $file_name);
    
    // Panggil metode untuk menambahkan data ke dalam layanan SOAP
    $komen = $api->tambahData(
        $_POST['merk_mobil'],
        $_POST['tipe_mobil'],
        $_POST['warna_mobil'],
        $file_name, // Gunakan $file_name sebagai nama file gambar
        $_POST['status_mobil'],
        $_POST['harga_mobil']
    );
    
    // Menampilkan pesan respons dari layanan SOAP
    if ($komen == "Tambah Data berhasil") {
        // Mengalihkan ke index.php setelah berhasil menambahkan data
        header("Location: index.php");
        exit();
    } else {
        echo $komen;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menambah Data Mobil</title>
</head>
<body>
    <center>
        <h2>Menambah Data Mobil</h2>
        <table>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                <tr>
                    <td>Merk Mobil</td>
                    <td><input type="text" name="merk_mobil" required /></td>
                </tr>
                <tr>
                    <td>Tipe Mobil</td>
                    <td><input type="text" name="tipe_mobil" required /></td>
                </tr>
                <tr>
                    <td>Warna Mobil</td>
                    <td><input type="text" name="warna_mobil" required /></td>
                </tr>
                <tr>
                    <td>Harga Mobil</td>
                    <td><input type="text" name="harga_mobil" required /></td>
                </tr>
                <tr>
                    <td>Gambar Mobil</td>
                    <td><input type="file" name="gambar_mobil" required /></td>
                </tr>
                <tr>
                    <td>Status Mobil</td>
                    <td>
                        <select name="status_mobil" required>
                            <option value="masih ada">Masih Ada</option>
                            <option value="terjual">Terjual</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Simpan" /></td>
                </tr>
            </form>
        </table>
    </center>
</body>
</html>
