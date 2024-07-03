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

// Fungsi untuk memformat angka ke dalam format Rupiah
function formatRupiah($angka){
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Stock Mobil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Stock Mobil</h1>
        <a href="tambah.php" class="btn-add">Tambah Data</a>
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
                        <td><?php echo formatRupiah(htmlspecialchars($d->harga_mobil)); ?></td>
                        <td class="action-buttons">
                            <a href='edit.php?id_mobil=<?php echo htmlspecialchars($d->id_mobil); ?>' class="edit">Edit</a>
                            <a href='hapus.php?id_mobil=<?php echo htmlspecialchars($d->id_mobil); ?>' class="delete">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
