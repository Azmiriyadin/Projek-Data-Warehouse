<?php
include "koneksi.php";
echo "<h1>Data Base Mysql</h1>";
//---------------------------------------
$sql = "SELECT * FROM barang";
$hasil = $koneksi_sqlite->query($sql);
$total = 0;
$berhasil = 0;
$gagal = 0;
foreach ($hasil as $x) {
    $total++;
    $id = $x["id_barang"];
    $nama = $x["nama_barang"];
    $hargab = $x["harga_beli"];
    $hargaj = $x["harga_jual"];
    $stok = $x["stok"];
    $ids = $x["id_supplier"];
    $sqlkonversi = "INSERT INTO sqlite_barang VALUES ('$id','$nama','$hargab','$hargaj','$stok','$ids')";
    $cek = mysqli_query($koneksi_mysql, $sqlkonversi);
    if ($cek) {
        $berhasil++;
    } else {
        $gagal++;
    }
}
echo "Rekap Data Barang<br>Total: $total; Berhasil: $berhasil; Gagal: $gagal;";
