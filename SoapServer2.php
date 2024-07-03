<?php
class Service1 {
    public $konek;

    public function __construct() {
        $this->konek = new mysqli('localhost', 'root', '', 'responsi');
        if ($this->konek->connect_error) {
            die("Connection failed: " . $this->konek->connect_error);
        }
    }

    function ambilData() {
        $return_brg = array(); // Inisialisasi variabel
        $hasil = $this->konek->query("SELECT * FROM stokmobil");

        while ($rows = $hasil->fetch_array()) {
            $return_brg[] = array(
                'id_mobil' => $rows['id_mobil'],
                'merk_mobil' => $rows['merk_mobil'],
                'tipe_mobil' => $rows['tipe_mobil'],
                'warna_mobil' => $rows['warna_mobil'],
                'gambar_mobil' => $rows['gambar_mobil'],
                'status_mobil' => $rows['status_mobil'],
                'harga_mobil' => $rows['harga_mobil']
            );
        }
        return json_encode($return_brg);
    }

    function tambahData($merk_mobil, $tipe_mobil, $warna_mobil, $gambar_mobil, $status_mobil, $harga_mobil) {
        $sql = "INSERT INTO stokmobil (merk_mobil, tipe_mobil, warna_mobil, gambar_mobil, status_mobil, harga_mobil)
                VALUES ('$merk_mobil', '$tipe_mobil', '$warna_mobil', '$gambar_mobil', '$status_mobil', $harga_mobil)";
        if ($this->konek->query($sql) === TRUE) {
            return "Tambah Data berhasil";
        } else {
            return "Error: " . $sql . "<br>" . $this->konek->error;
        }
    }
    
    function updateData($id_mobil, $merk_mobil, $tipe_mobil, $warna_mobil, $gambar_mobil, $status_mobil, $harga_mobil) {
        $sql = "UPDATE stokmobil SET 
                merk_mobil='$merk_mobil', 
                tipe_mobil='$tipe_mobil', 
                warna_mobil='$warna_mobil', 
                gambar_mobil='$gambar_mobil', 
                status_mobil='$status_mobil', 
                harga_mobil=$harga_mobil 
                WHERE id_mobil=$id_mobil";
        if ($this->konek->query($sql) === TRUE) {
            return "Ubah Data berhasil";
        } else {
            return "Error: " . $sql . "<br>" . $this->konek->error;
        }
    }

    function hapusData($id_mobil)
    {
    $sql = "DELETE FROM stokmobil WHERE id_mobil = $id_mobil";
    if ($this->konek->query($sql) === TRUE) {
        return "Menghapus Data berhasil";
    } else {
        return "Error: " . $sql . "<br>" . $this->konek->error;
    }
    }

    function bacaSatu($id_mobil) {
      $return_mobil = array(); // Inisialisasi variabel
      $hasil = $this->konek->query("SELECT * FROM stokmobil WHERE id_mobil=$id_mobil");
  
      while ($rows = $hasil->fetch_array()) {
          $return_mobil[] = array(
              'id_mobil' => $rows['id_mobil'],
              'merk_mobil' => $rows['merk_mobil'],
              'tipe_mobil' => $rows['tipe_mobil'],
              'warna_mobil' => $rows['warna_mobil'],
              'gambar_mobil' => $rows['gambar_mobil'],
              'status_mobil' => $rows['status_mobil'],
              'harga_mobil' => $rows['harga_mobil']
          );
      }
      return json_encode($return_mobil);
  }
    function cariData($keyword) {
        $keyword = $this->konek->real_escape_string($keyword); // Prevent SQL injection
        $return_brg = array();
        $sql = "SELECT * FROM stokmobil 
                WHERE merk_mobil LIKE '%$keyword%' 
                OR tipe_mobil LIKE '%$keyword%' 
                OR warna_mobil LIKE '%$keyword%' 
                OR status_mobil LIKE '%$keyword%' 
                OR harga_mobil LIKE '%$keyword%'";
        $hasil = $this->konek->query($sql);

        while ($rows = $hasil->fetch_array()) {
            $return_brg[] = array(
                'id_mobil' => $rows['id_mobil'],
                'merk_mobil' => $rows['merk_mobil'],
                'tipe_mobil' => $rows['tipe_mobil'],
                'warna_mobil' => $rows['warna_mobil'],
                'gambar_mobil' => $rows['gambar_mobil'],
                'status_mobil' => $rows['status_mobil'],
                'harga_mobil' => $rows['harga_mobil']
            );
        }
        return json_encode($return_brg);
    }
 
  
}

// URI configuration
$opt = ["uri" => "http://localhost:1000/"];
// Membuat kelas instan
$serv = new SoapServer(NULL, $opt);
// Memanggil kelas
$serv->setClass('Service1');
// Start
$serv->handle();
?>
