<?php
include "koneksi.php";
include "SimpleXLSX.php";

use Shuchkin\SimpleXLSX;

if ($data = SimpleXLSX::parse('TOKO_HP.xlsx')) {
    $baris = 0;
    $total = 0;
    $berhasil = 0;
    $gagal = 0;
    foreach ($data->rows(2) as $r) {
        $baris++;
        if ($baris >= 3) {
            $total++;
            $kode = $r[2];
            $nama = $r[3];
            $telp = $r[4];
            $alamat = $r[5];
            $sql = "INSERT INTO excel_supplier VALUES('$kode','$nama','$telp','$alamat')";
            $cek = mysqli_query($koneksi_mysql, $sql);
            if ($cek) {
                $berhasil++;
            } else {
                $gagal++;
            }
        }
    }


    echo '{
        "total":"' . $total . '",
        "berhasil":"' . $berhasil . '",
        "gagal":"' . $gagal . '"
    }';
} else {
    echo SimpleXLSX::parseError();
}
