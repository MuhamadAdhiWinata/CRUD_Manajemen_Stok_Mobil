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
    <title>DAFTAR HARGA BARANG</title>
</head>
<body>
    <h2>DAFTAR HARGA BARANG</h2>
    <a href="tambah.php">Tambah Data</a>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>MERK MOBIL</td>
            <td>TIPE MOBIL</td>
            <td>WARNA MOBIL</td>
            <td>GAMBAR MOBIL</td>
            <td>STATUS MOBIL</td>
            <td>HARGA MOBIL</td>
            <td>AKSI</td>
        </tr>
        <?php foreach ($data as $d) { ?>
            <tr>
                <td><?php echo $d->id_mobil; ?></td>
                <td><?php echo $d->merk_mobil; ?></td>
                <td><?php echo $d->tipe_mobil; ?></td>
                <td><?php echo $d->warna_mobil; ?></td>
                <td>
                    <img src="mobil/<?php echo $d->gambar_mobil; ?>" alt="<?php echo $d->merk_mobil; ?>" width="100">
                </td>
                <td><?php echo $d->status_mobil; ?></td>
                <td><?php echo $d->harga_mobil; ?></td>
                <td>
                    <a href='edit.php?id_mobil=<?php echo $d->id_mobil; ?>'>Edit</a>
                    <a href='hapus.php?id_mobil=<?php echo $d->id_mobil; ?>'>Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
