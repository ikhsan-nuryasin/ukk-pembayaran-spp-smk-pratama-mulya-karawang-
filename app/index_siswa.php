<?php
    include "header_siswa.php";
?>

<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh; text-align: center;">
    <div class="page-header" style="margin-top: 40%;">
        <h3>Selamat Datang di Dashboard Aplikasi Pembayaran SPP SMK Pratama Mulya Karawang</h3>
    </div>
    <p>...</p>
</div>
<div id="notifikasi-container" class="container"></div>

<script>
function loadNotifikasi() {
    fetch("notifikasi.php?aksi=ambil")
        .then(response => response.json())
        .then(data => {
            let html = "";
            data.forEach(notif => {
                html += `<div class="alert alert-info">${notif.pesan}</div>`;
            });
            document.getElementById("notifikasi-container").innerHTML = html;
        });
}

// Panggil fungsi saat halaman dimuat
loadNotifikasi();
</script>

<style>
/* CSS untuk membuat tampilan lebih responsif */
@media (max-width: 768px) {
    .container {
        padding: 20px;
    }
    h3 {
        font-size: 1.5rem;
    }
}
html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

.container {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

/* Footer tetap di bawah */
footer {
    background-color: #267365;
    color: white;
    padding: 10px 0;
    text-align: center;
    width: 100%;
    position: relative;
    bottom: 0;
}

</style>

<?php
    include "footer_siswa.php";
?>
