<?php

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit Data Mobil</h2>
        <form action="update.php" method="post" enctype="multipart/form-data" class="form-container">
            <input type="hidden" name="id_mobil" value="<?php echo $id_mobil; ?>">
            <div class="form-group">
                <label for="merk_mobil">Merk Mobil</label>
                <input type="text" id="merk_mobil" name="merk_mobil" value="<?php echo $merk_mobil; ?>">
            </div>
            <div class="form-group">
                <label for="tipe_mobil">Tipe Mobil</label>
                <input type="text" id="tipe_mobil" name="tipe_mobil" value="<?php echo $tipe_mobil; ?>">
            </div>
            <div class="form-group">
                <label for="warna_mobil">Warna Mobil</label>
                <input type="text" id="warna_mobil" name="warna_mobil" value="<?php echo $warna_mobil; ?>">
            </div>
            <div class="form-group">
                <label for="gambar_mobil">Gambar Mobil</label>
                <input type="file" id="gambar_mobil" name="gambar_mobil">
                <?php if (!empty($gambar_mobil)): ?>
                    <br>
                    <img src="mobil/<?php echo $gambar_mobil; ?>" width="150">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="status_mobil">Status Mobil</label>
                <select id="status_mobil" name="status_mobil">
                    <option value="masih ada" <?php if($status_mobil == 'masih ada') echo 'selected'; ?>>Masih Ada</option>
                    <option value="terjual" <?php if($status_mobil == 'terjual') echo 'selected'; ?>>Terjual</option>
                </select>
            </div>
            <div class="form-group">
                <label for="harga_mobil">Harga Mobil</label>
                <input type="text" id="harga_mobil" name="harga_mobil" value="<?php echo $harga_mobil; ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
