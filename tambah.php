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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menambah Data Mobil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container1">
        <h2>Menambah Data Mobil</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="merk_mobil">Merk Mobil</label>
                <input type="text" id="merk_mobil" name="merk_mobil" required>
            </div>
            <div class="form-group">
                <label for="tipe_mobil">Tipe Mobil</label>
                <input type="text" id="tipe_mobil" name="tipe_mobil" required>
            </div>
            <div class="form-group">
                <label for="warna_mobil">Warna Mobil</label>
                <input type="text" id="warna_mobil" name="warna_mobil" required>
            </div>
            <div class="form-group">
                <label for="harga_mobil">Harga Mobil</label>
                <input type="text" id="harga_mobil" name="harga_mobil" required>
            </div>
            <div class="form-group">
                <label for="gambar_mobil">Gambar Mobil</label>
                <input type="file" id="gambar_mobil" name="gambar_mobil" required>
            </div>
            <div class="form-group">
                <label for="status_mobil">Status Mobil</label>
                <select id="status_mobil" name="status_mobil" required>
                    <option value="masih ada">Masih Ada</option>
                    <option value="terjual">Terjual</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Simpan</button>
                <a href="index.php" class="btn-back" style="text-decoration: none; color: white; display: inline-block; padding: 10px 20px; background-color: #d9534f; border-radius: 4px; text-align: center; margin-top: 10px;">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
