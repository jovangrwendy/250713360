<h2>Pendaftaran Membership</h2>
<form method="POST" action="">
    <p>Nama: <br /><input type="text" name="nama" /></p>
    <p>NPM: <br /><input type="text" name="npm" /></p>
    <p>Paket Membership: <br />
        <select name="paket">
            <option value="">-- Pilih Paket --</option>
            <option value="1">1 bulan</option>
            <option value="3">3 bulan</option>
        </select>
    </p>
    <button type="submit">Kirim</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $npm = $_POST['npm'] ?? '';
    $paket = $_POST['paket'] ?? '';
    
    $errors = [];
    
    if (empty($nama) || empty($npm) || empty($paket)) {
        $errors[] = "Harap lengkapi semua data.";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
            $errors[] = "Nama hanya boleh mengandung huruf dan spasi.";
        }
        if (!preg_match("/^[0-9]*$/", $npm)) {
            $errors[] = "NPM hanya boleh mengandung angka.";
        }
    }
    
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>!! " . htmlspecialchars($error) . " !!</p>";
        }
    } else {
        $benefit = "";
        if ($paket == "1") {
            $benefit = "Potongan 50% untuk pembelian produk tertentu.";
        } elseif ($paket == "3") {
            $benefit = "Gratis cemilan hewan peliharaan untuk 3 bulan pertama.";
        }
        
        $paket_teks = ($paket == "1") ? "1 bulan" : "3 bulan";
        
        echo "<h3>Informasi Pendaftaran</h3>";
        echo "<p><strong>Nama:</strong> " . htmlspecialchars($nama) . "</p>";
        echo "<p><strong>NPM:</strong> " . htmlspecialchars($npm) . "</p>";
        echo "<p><strong>Paket Membership:</strong> " . htmlspecialchars($paket_teks) . "</p>";
        echo "<p><strong>Keuntungan:</strong> " . htmlspecialchars($benefit) . "</p>";
        echo "<p>Selamat! Anda telah berhasil mendaftar sebagai member dengan benefit: " . htmlspecialchars($benefit) . "</p>";
    }
} else {
    echo "<p>Silahkan lengkapi formulir di atas.</p>";
}
?>