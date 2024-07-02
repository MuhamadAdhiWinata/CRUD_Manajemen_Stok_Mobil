<?php
// URI untuk mengakses webservice
$opt = [
    "location" => "http://localhost:1000/soapServer2.php",
    "uri" => "http://localhost:1000/",
    "trace" => 1
];
$api = new SoapClient(NULL, $opt);
$response = $api->ambilData(); // Memanggil metode ambilData dari layanan SOAP
$data = json_decode($response); // Mendekodekan respons JSON menjadi objek PHP
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Harga Barang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Harga Barang</h1>
        <a href="tambah.php" class="btn-add"><i class="fas fa-plus"></i> Tambah Data</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Merk Mobil</th>
                    <th>Tipe Mobil</th>
                    <th>Warna Mobil</th>
                    <th>Gambar Mobil</th>
                    <th>Status Mobil</th>
                    <th>Harga Mobil</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $d) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($d->id_mobil); ?></td>
                        <td><?php echo htmlspecialchars($d->merk_mobil); ?></td>
                        <td><?php echo htmlspecialchars($d->tipe_mobil); ?></td>
                        <td><?php echo htmlspecialchars($d->warna_mobil); ?></td>
                        <td>
                            <img src="mobil/<?php echo htmlspecialchars($d->gambar_mobil); ?>" alt="<?php echo htmlspecialchars($d->merk_mobil); ?>" width="100">
                        </td>
                        <td><?php echo htmlspecialchars($d->status_mobil); ?></td>
                        <td><?php echo htmlspecialchars($d->harga_mobil); ?></td>
                        <td class="action-buttons">
                            <a href='edit.php?id_mobil=<?php echo htmlspecialchars($d->id_mobil); ?>' class="edit"><i class="fas fa-edit"></i> Edit</a>
                            <a href='hapus.php?id_mobil=<?php echo htmlspecialchars($d->id_mobil); ?>' class="delete"><i class="fas fa-trash-alt"></i> Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
