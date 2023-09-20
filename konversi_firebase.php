<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>

<script>
const firebaseConfig = {
  apiKey: "AIzaSyA_EZ-_HfXmQqJwsyGagHAuh2i5nr-R3vQ",
  authDomain: "pemrograman-web2-5d896.firebaseapp.com",
  databaseURL: "https://pemrograman-web2-5d896-default-rtdb.firebaseio.com",
  projectId: "pemrograman-web2-5d896",
  storageBucket: "pemrograman-web2-5d896.appspot.com",
  messagingSenderId: "457367107964",
  appId: "1:457367107964:web:2dd2894a58768ee3354cf9",
  measurementId: "G-XGMMNT8Y0G"
    };
    firebase.initializeApp(firebaseConfig);
    let db = firebase.database();
    let tblfilm = db.ref("film");
    tblfilm.on('value', sukses, gagal);
    let xt;
    function sukses(item){
        let dt = "";
        $.each(item.val(), function(i, kolom) {
            let id = i;
            let direktur = kolom.director;
            let durasi = kolom.duration;
            let jenis = kolom.genre;
            let judul = kolom.title;
            let tahun = kolom.year;
            dt += `${id}|${direktur}|${durasi}|${jenis}|${judul}|${tahun}#`;
        });
        xt = dt.slice(0, -1);
        $.ajax({
            url: "import.php",
            method: "POST",
            data: {xt: xt},
            cache: false,
            success: function(x){
                let respon = JSON.parse(x);
                alert(`Total: ${respon.total}, Berhasil: ${respon.berhasil}, Gagal: ${respon.gagal}`);
                
            },
            error: function(){
                alert("Server Tidak Tersambung");
            }
        });
    }
    function gagal(error){
        alert(`Data Gagal di Akses. Alasan: ${error}`);
    }
</script>