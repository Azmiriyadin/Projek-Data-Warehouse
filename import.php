<?php
    include "koneksi.php";
    $data = $_REQUEST["xt"];
    $d1 = explode("#", $data);
    $total = 0;
    $berhasil = 0;
    $gagal = 0;
    foreach ($d1 as $k) {
        $d2 = explode("|", $k);
        $id = $d2[0];
        $direktur = $d2[1];
        $durasi = $d2[2];
        $jenis = $d2[3];
        $judul = $d2[4];
        $tahun = $d2[5];
        $sqlkonversi = "INSERT INTO firebase_film VALUES('$id','$direktur','$durasi','$jenis','$judul','$tahun')";
        try{
            mysqli_query($koneksi_mysql, $sqlkonversi);
            $berhasil++;
        }catch(Exception $e){
            $gagal++;
        }
    }
    echo '{
        "total":"'.$total.'",
        "berhasil":"'.$berhasil.'",
        "gagal":"'.$gagal.'"
    }';
?>