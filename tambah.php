<?php
// URI untuk mengakses web service
try {
    $opt = [
        "location" => "http://localhost:1000/soapServer2.php",
        "uri" => "http://localhost:1000/",
        "trace" => 1
    ];

    // Membaca API
    $api = new SoapClient(NULL, $opt);
    
    // Jika ada pengiriman data dari form, proses untuk menambahkan data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $komen = $api->tambahData(
            $_POST['merk_mobil'],
            $_POST['tipe_mobil'],
            $_POST['warna_mobil'],
            $_POST['gambar_mobil'],
            $_POST['status_mobil'],
            $_POST['harga_mobil']
        );
        
        // Menampilkan pesan respons dari layanan SOAP
        echo $komen;
    }
} catch (SoapFault $ex) {
    // Menampilkan pesan jika terjadi kesalahan saat memanggil layanan SOAP
    echo "Gagal menambahkan data. Error: " . $ex->getMessage();
}
?>

<center>
    <h2>Menambah Data Mobil</h2>
    <table>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
                <td><input type="text" name="gambar_mobil" required /></td>
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
