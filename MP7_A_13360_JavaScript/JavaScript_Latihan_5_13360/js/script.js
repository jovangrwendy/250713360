function fn_ValForm() {
    var nama = document.getElementById("nama").value.trim();
    var email = document.getElementById("email").value.trim();
    var umur = document.getElementById("umur").value.trim();
    var kategori = document.getElementById("kategori").value;

    var errors = [];

    if (nama === "") {
        errors.push("Nama tidak boleh kosong!");
    }

    if (email === "") {
        errors.push("Email tidak boleh kosong!");
    } else {
        var emailRegex = /^[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9][\.][a-z0-9]{2,4}$/;
        if (!emailRegex.test(email)) {
            errors.push("Format email tidak valid (hanya menerima huruf kecil)!");
        }
    }

    var info = "";
    if (umur === "") {
        errors.push("Umur tidak boleh kosong!");
    } else {
        var angkaUmur = Number(umur);
        if (isNaN(angkaUmur) || angkaUmur < 10 || angkaUmur > 18) {
            errors.push("Umur harus berupa angka antara 10 sampai 18 tahun!");
        } else {
            if (angkaUmur <= 14) {
                info = "Kategori Junior";
            } else {
                info = "Kategori Senior";
            }
        }
    }

    if (kategori === "") {
        errors.push("Pilihan lomba harus dipilih!");
    }

    if (errors.length > 0) {
        alert("Terjadi kesalahan:\n- " + errors.join("\n- "));
        return false;
    }

    var namaLomba = "";
    switch (kategori) {
        case "C":
            namaLomba = "Cerdas Cermat";
            break;
        case "P":
            namaLomba = "Puisi";
            break;
        case "D":
            namaLomba = "Design poster";
            break;
        default:
            namaLomba = "Tidak diketahui";
            break;
    }

    alert("Terima kasih " + nama + " ! Anda terdaftar di lomba " + namaLomba + " (" + info + ").");
    return true;
}