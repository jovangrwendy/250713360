<h2>Belanja</h2>
<p><strong>Daftar Kategori:</strong></p>
<form method="POST" action="">
    <p>Makanan dan Minuman: <br />
        <select name="makanan">
            <option value="">-- Pilih Makanan/Minuman --</option>
            <option value="daging kaleng">Daging Kaleng</option>
            <option value="susu">Susu</option>
        </select>
    </p>
    <p>Aksesoris: <br />
        <select name="aksesoris">
            <option value="">-- Pilih Aksesoris --</option>
            <option value="kalung">Kalung</option>
            <option value="pakaian">Pakaian</option>
        </select>
    </p>
    <button type="submit">Kirim</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $makanan = $_POST['makanan'] ?? '';
    $aksesoris = $_POST['aksesoris'] ?? '';
    
    $errors = [];
    if (empty($makanan) || empty($aksesoris)) {
        $errors[] = "Harap pilih makanan/minuman dan aksesoris terlebih dahulu.";
    }
    
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>!! " . htmlspecialchars($error) . " !!</p>";
        }
    } else {
        $harga_makanan = 0;
        if ($makanan === 'daging kaleng') {
            $harga_makanan = 1000;
        } elseif ($makanan === 'susu') {
            $harga_makanan = 15000;
        }
        
        $harga_aksesoris = 0;
        if ($aksesoris === 'kalung') {
            $harga_aksesoris = 50000;
        } elseif ($aksesoris === 'pakaian') {
            $harga_aksesoris = 10000;
        }
        
        $totalBayar = $harga_makanan + $harga_aksesoris;
        
        function dapatDiskon($totalBayar) {
            if ($totalBayar >= 100000) {
                return 0.10;
            } else {
                return 0;
            }
        }
        
        function totalHarga($diskon, $totalBayar) {
            return $totalBayar - ($totalBayar * $diskon);
        }
        
        $diskon = dapatDiskon($totalBayar);
        $finalHarga = totalHarga($diskon, $totalBayar);
        
        echo "<h3>Informasi Belanja</h3>";
        echo "<p><strong>Makanan dan Minuman:</strong> " . htmlspecialchars($makanan) . "</p>";
        echo "<p><strong>Aksesoris:</strong> " . htmlspecialchars($aksesoris) . "</p>";
        echo "<p><strong>Total Harga:</strong> Rp " . htmlspecialchars($finalHarga) . "</p>";
        echo "<p><strong>Diskon:</strong> " . htmlspecialchars($diskon * 100) . "%</p>";
        
        if ($diskon == 0) {
            echo "<p>Maaf tidak ada diskon yang diberikan.</p>";
        } else {
            echo "<p>Selamat! Anda mendapatkan diskon " . htmlspecialchars($diskon * 100) . "%.</p>";
        }
    }
} else {
    echo "<p>Silahkan pilih produk yang ingin dibeli.</p>";
}
?>