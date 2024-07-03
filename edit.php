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
    $harga_mobil = intval($m->harga_mobil); 
}

// Fungsi untuk memformat angka ke dalam format Rupiah
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mobil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container1">
        <h2>Edit Data Mobil</h2>
        <form action="update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_mobil" value="<?php echo htmlspecialchars($id_mobil); ?>">
            <input type="hidden" name="gambar_mobil" value="<?php echo htmlspecialchars($gambar_mobil); ?>">
            <div class="form-group">
                <label for="merk_mobil">Merk Mobil</label>
                <input type="text" id="merk_mobil" name="merk_mobil" value="<?php echo htmlspecialchars($merk_mobil); ?>">
            </div>
            <div class="form-group">
                <label for="tipe_mobil">Tipe Mobil</label>
                <input type="text" id="tipe_mobil" name="tipe_mobil" value="<?php echo htmlspecialchars($tipe_mobil); ?>">
            </div>
            <div class="form-group">
                <label for="warna_mobil">Warna Mobil</label>
                <input type="text" id="warna_mobil" name="warna_mobil" value="<?php echo htmlspecialchars($warna_mobil); ?>">
            </div>
            <div class="form-group">
                <label for="gambar_mobil">Gambar Mobil</label>
                <input type="file" id="gambar_mobil" name="gambar_mobil">
                <?php if (!empty($gambar_mobil)): ?>
                    <br>
                    <img src="mobil/<?php echo htmlspecialchars($gambar_mobil); ?>" width="150">
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
                <input type="text" id="harga_mobil" name="harga_mobil" value="<?php echo formatRupiah($harga_mobil); ?>">
            </div>
            <div class="form-group">
                <button type="submit">Simpan</button>
                <a href="index.php" class="btn-back">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
