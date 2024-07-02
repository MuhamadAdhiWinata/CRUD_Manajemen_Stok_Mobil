<?php
// Cek apakah id ada di URL
if (!isset($_GET['id_mobil'])) {
    die('ID mobil tidak ditemukan.');
}


// URI untuk mengakses webservice
try {
    $opt = [
        "location" => "http://localhost:1000/soapServer2.php",
        "uri" => "http://localhost:1000/",
        "trace" => 1
    ];
    // Membaca API
    $api = new SoapClient(NULL, $opt);
    $data = $api->bacaSatu($_GET['id_mobil']);
} catch (SoapFault $ex) {
    echo $api->__getLastResponse();
    exit();
}

$mobil = json_decode($data);

// Mengambil detail mobil
foreach ($mobil as $m) {
    $id_mobil = $m->id_mobil;
    $merk_mobil = $m->merk_mobil;
    $tipe_mobil = $m->tipe_mobil;
    $warna_mobil = $m->warna_mobil;
    $gambar_mobil = $m->gambar_mobil;
    $status_mobil = $m->status_mobil;
    $harga_mobil = $m->harga_mobil;
}
?>

<center>
    <h2>Edit Data Mobil</h2>
    <table>
        <form action="update.php" method="post">
            <input type="hidden" name="id_mobil" value="<?php echo $id_mobil; ?>">
            <tr>
                <td>Merk Mobil</td>
                <td><input type="text" name="merk_mobil" value="<?php echo $merk_mobil; ?>"></td>
            </tr>
            <tr>
                <td>Tipe Mobil</td>
                <td><input type="text" name="tipe_mobil" value="<?php echo $tipe_mobil; ?>"></td>
            </tr>
            <tr>
                <td>Warna Mobil</td>
                <td><input type="text" name="warna_mobil" value="<?php echo $warna_mobil; ?>"></td>
            </tr>
            <tr>
                <td>Gambar Mobil</td>
                <td><input type="text" name="gambar_mobil" value="<?php echo $gambar_mobil; ?>"></td>
            </tr>
            <tr>
                <td>Status Mobil</td>
                <td>
                    <select name="status_mobil">
                        <option value="masih ada" <?php if($status_mobil == 'masih ada') echo 'selected'; ?>>Masih Ada</option>
                        <option value="terjual" <?php if($status_mobil == 'terjual') echo 'selected'; ?>>Terjual</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Harga Mobil</td>
                <td><input type="text" name="harga_mobil" value="<?php echo $harga_mobil; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Simpan"></td>
            </tr>
        </form>
    </table>
</center>
