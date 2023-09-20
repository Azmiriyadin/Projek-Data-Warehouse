<?php
include "koneksi.php";

echo "<hr>";
echo "<h1>Database MySQL</h1>";
$sql = "SELECT * FROM produk";
$data = mysqli_query($koneksi_mysql, $sql);
while ($x = mysqli_fetch_array($data)) {
    $nama = $x["nama_produk"];
    $harga = $x["harga_jual"];
    $stok = $x["stok_produk"];
    echo "$nama - $harga - $stok <br>";
}
echo "<hr>";
echo "<h1>Database SQlite</h1>";
$sql = "SELECT * FROM barang";
$hasil = $koneksi_sqlite->query($sql);
foreach ($hasil as $x) {
    $nama = $x["nama_barang"];
    $harga = $x["harga_jual"];
    echo "$nama - $harga<br>";
}
include "koneksi.php";

echo "<hr>";
echo "<h1>Database Acces</h1>";
$sql = "SELECT * FROM stock";
$data = mysqli_query($koneksi_access, $sql);
while ($x = mysqli_fetch_array($data)) {
    $nama = $x["Judul_Buku"];
    $harga = $x["Harga"];
    echo "$nama - $harga<br>";
}
echo "<hr>";
echo "<h1>Data Excel</h1>";
include "SimpleXLSX.php";

use Shuchkin\SimpleXLSX;

if ($data = SimpleXLSX::parse('TOKO_HP.xlsx')) {
    foreach ($data->rows() as $r) {
        echo $r[3] . " - " . $r[4] . "<br>";
    }
} else {
    echo SimpleXLSX::parseError();
};
?>
<hr>
<h1>Data Firebase</h1>
<p id="blokdata"></p>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>


<script>
    const firebaseConfig = {
        apiKey: "AIzaSyCTf-gtGnBQWMUC1-44WpVcm0OqevybGow",
        authDomain: "database-rental-dvd.firebaseapp.com",
        databaseURL: "https://database-rental-dvd-default-rtdb.firebaseio.com",
        projectId: "database-rental-dvd",
        storageBucket: "database-rental-dvd.appspot.com",
        messagingSenderId: "220410605057",
        appId: "1:220410605057:web:3e5919e60a4be8b8a51a00",
        measurementId: "G-KC69G9Y3VC"
    };

    firebase.initializeApp(firebaseConfig);
    let db = firebase.database();
    let tblfilm = db.ref("film");

    tblfilm.on('value', sukses, gagal);

    function sukses(item) {
        let dt = "";
        $.each(item.val(), function(i, kolom) {
            var judul = kolom.title;
            var tahun = kolom.year;
            dt += `${judul} (${tahun})<br>`;
        });
        $("#blokdata").html(dt);

    }

    function gagal(error) {
        $("#blokdata").html(`Data Gagal di Akses, Alasan: $(error)`);
    }
</script>