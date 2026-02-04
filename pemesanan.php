<?php
// ===== DATA PRODUK PLAYSTATION =====
// Array asosiatif ini akan digunakan di form untuk menampilkan pilihan PS dan menghitung total bayar.
$produk = [
    ["id" => "ps3","nama" => "PlayStation 3","harga" => 5000],
    ["id" => "ps4","nama" => "PlayStation 4","harga" => 10000],
    ["id" => "ps5","nama" => "PlayStation 5","harga" => 15000]
];

// ===== INISIALISASI VARIABEL =====
// Variabel untuk menampung data input dari user
$nama = "";          // Nama pemesan
$jk = "";            // Jenis kelamin (Laki-laki / Perempuan)
$noIdentitas = "";   // Nomor identitas (misal KTP)
$jenisPS = "";       // Jenis PlayStation yang dipilih (ps3/ps4/ps5)
$tanggalPesan = "";  // Tanggal pemesanan
$durasi = "";        // Durasi sewa dalam jam

// Variabel untuk opsi tambahan
$snack = false;      // Menyimpan apakah user memilih snack (true/false)

// Variabel untuk perhitungan harga dan total
$harga = 0;          // Harga per jam untuk PS yang dipilih
$total = "";         // Total bayar (harga × durasi + tambahan snack)
$infoDiskon = "";    // Informasi diskon (misal "Diskon 10% karena durasi > 5 jam")

// Variabel untuk menampilkan pesan sukses
$successMsg = "";    // Pesan alert ketika data berhasil disimpan

// Variabel kontrol untuk logika tampilan
$hitungPressed = false; // Menandai apakah tombol "Hitung Total" sudah ditekan
$showHargaOnly = false; // Menandai apakah hanya menampilkan harga setelah memilih PS

// ===== CEK PROSES FORM =====
// $_SERVER["REQUEST_METHOD"] mengecek metode pengiriman form
// Jika form dikirim menggunakan metode POST, maka blok kode ini dijalankan
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ===== AMBIL DATA DARI FORM =====
    // $_POST adalah array yang menyimpan semua data input dari form yang dikirim via POST

    $action = $_POST['action'] ?? ""; 
    // Mengambil nilai tombol yang ditekan (misal "hitung" atau "simpan")
    // Jika tidak ada, maka nilainya kosong ("")
    
    $nama = $_POST['nama'] ?? "";
    // Ambil input nama pemesan dari form. Jika kosong, otomatis jadi string kosong.
    
    $jk = $_POST['jk'] ?? "";
    // Ambil input jenis kelamin dari radio button. Jika tidak dipilih, jadi string kosong.
    
    $noIdentitas = $_POST['noIdentitas'] ?? "";
    // Ambil nomor identitas dari input text. Jika kosong, jadi string kosong.
    
    $jenisPS = $_POST['jenisPS'] ?? "";
    // Ambil jenis PlayStation yang dipilih dari dropdown. Jika belum dipilih, jadi string kosong.
    
    $tanggalPesan = $_POST['tanggalPesan'] ?? "";
    // Ambil tanggal pemesanan dari input date. Jika kosong, jadi string kosong.
    
    $durasi = intval($_POST['durasi'] ?? 0);
    // Ambil durasi sewa dari input number
    // intval() memastikan nilainya diubah menjadi angka bulat
    // Jika belum diisi, otomatis 0
    
    $snack = isset($_POST['snack']);
    // Cek apakah checkbox snack dicentang
    // isset() mengembalikan true jika dicentang, false jika tidak

    // ===== MENCARI HARGA PS YANG DIPILIH USER =====
    // $produk adalah array yang menyimpan semua jenis PlayStation dan harganya
    // $jenisPS adalah id PlayStation yang dipilih user di form
foreach($produk as $item){  
    // Looping setiap elemen di array $produk
    // $item sekarang berisi satu PS (misal PS3, PS4, atau PS5)

    if($item['id'] == $jenisPS){  
        // Cek apakah id PS saat ini sama dengan yang dipilih user
        // Contoh: jika $jenisPS = "ps4" dan $item['id'] = "ps4", maka cocok

        $harga = $item['harga'];  
        // Ambil harga PS yang cocok dan simpan di variabel $harga

        break;  
        // Setelah harga ditemukan, hentikan loop
        // Tidak perlu memeriksa PS lainnya karena sudah ketemu
        }
    }

    // Jika tombol Hitung ditekan
    // ===== PROSES HITUNG TOTAL BAYAR =====
    // Blok ini dijalankan jika user menekan tombol "Hitung Total"
    if($action == "hitung"){  
    $hitungPressed = true;  
    // Menandai bahwa tombol hitung sudah ditekan
    // Nanti ini digunakan untuk menampilkan kolom Total Bayar

    if($harga > 0 && $durasi > 0){  
        // Pastikan harga sudah ada dan durasi > 0
        // Jika belum, proses perhitungan tidak dijalankan

        $totalCalc = $harga * $durasi;  
        // Total awal = harga per jam × durasi sewa

        // ===== CEK DISKON =====
        if($durasi > 5){  
            // Jika durasi sewa lebih dari 5 jam
            $totalCalc *= 0.9;  
            // Diskon 10% → total dikalikan 0.9
            $infoDiskon = "Diskon 10% karena sewa lebih dari 5 jam";  
            // Simpan keterangan diskon untuk ditampilkan
        }

        // ===== TAMBAHAN SNACK =====
        if($snack){  
            // Jika user memilih snack
            $totalCalc += 20000;  
            // Tambahkan Rp 20.000 ke total
        }

        // ===== FORMAT TOTAL BAYAR =====
        $total = "Rp ".number_format($totalCalc, 0, ',', '.');  
        // number_format digunakan untuk menampilkan angka sesuai format Rupiah
        // Contoh: 15000 → "Rp 15.000"
        }
    }

    // Jika tombol Simpan ditekan
    // ===== PROSES SIMPAN DATA =====
    // Blok ini dijalankan jika user menekan tombol "Simpan"
    if($action == "simpan"){

    // ===== CEK VALIDASI DATA =====
    if($harga == 0 || $durasi <= 0){  
        // Jika harga belum dipilih (0) atau durasi belum diisi (≤ 0)
        // Maka data dianggap belum lengkap
        $successMsg = "<script>alert('Lengkapi semua data sebelum menyimpan!');</script>";
        // Tampilkan pesan alert agar user melengkapi data
    } else {

        // ===== SIMPAN DATA BERHASIL =====
        $successMsg = "<script>alert('Data berhasil disimpan!');</script>";
        // Tampilkan pesan alert bahwa data berhasil disimpan

        // ===== RESET FORM =====
        // Setelah data disimpan, kita kosongkan semua variabel agar form bersih
        $nama = $jk = $noIdentitas = $jenisPS = $tanggalPesan = $durasi = "";
        $snack = false;            // Checkbox snack di-uncheck
        $total = $infoDiskon = ""; // Kosongkan total bayar dan info diskon
        $hitungPressed = false;    // Reset status tombol hitung
        $harga = 0;                // Reset harga PS
        }
    }

    // Jika PS dipilih tapi belum hitung total
    // ===== TAMPILKAN HARGA SAJA =====
    // Blok ini dijalankan jika user memilih jenis PlayStation di dropdown
    if($action == "harga"){  
    $showHargaOnly = true;  
    // Menandai bahwa user hanya ingin melihat harga PS yang dipilih
    // Total Bayar tetap kosong sampai user menekan tombol "Hitung Total"
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Form Pemesanan Rental PlayStation</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>body { background-color: #f4f6f9; }</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
    <a class="navbar-brand" href="index.php">Ashura PS</a>
</div>
</nav>

<section class="container my-5">
<h2 class="text-center mb-4">Form Pemesanan Rental PlayStation</h2>
<div class="card shadow mx-auto p-4" style="max-width:700px;">

<?= $successMsg ?>

<form method="post">
    <!-- Nama -->
    <div class="mb-3">
        <label class="form-label">Nama Pemesan</label>
        <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($nama) ?>" required>
    </div>

    <!-- Jenis Kelamin -->
    <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label><br>
        <input type="radio" name="jk" value="Laki-laki" <?= ($jk=="Laki-laki")?"checked":"" ?> required> Laki-laki
        <input type="radio" name="jk" value="Perempuan" class="ms-3" <?= ($jk=="Perempuan")?"checked":"" ?>> Perempuan
    </div>

    <!-- Nomor Identitas -->
    <div class="mb-3">
        <label class="form-label">Nomor Identitas</label>
        <input type="text" class="form-control" name="noIdentitas" maxlength="16" pattern="\d{16}" value="<?= htmlspecialchars($noIdentitas) ?>" required>
        <small class="text-muted">Masukkan 16 digit angka</small>
    </div>

    <!-- Jenis PS -->
    <div class="mb-3">
        <label class="form-label">Jenis PlayStation</label>
        <select class="form-select" name="jenisPS" onchange="this.form.submit()" required>
            <option value="">-- Pilih PS --</option>
            <?php foreach($produk as $item): ?>
                <option value="<?= $item['id'] ?>" <?= ($jenisPS==$item['id'])?"selected":"" ?>><?= $item['nama'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="action" value="harga">
    </div>

    <!-- Harga / Jam -->
    <div class="mb-3">
        <label class="form-label">Harga / Jam</label>
        <input type="text" class="form-control" readonly value="<?= $harga ? "Rp ".number_format($harga,0,',','.') : "" ?>">
    </div>

    <!-- Tanggal Pesan -->
    <div class="mb-3">
        <label class="form-label">Tanggal Pesan</label>
        <input type="date" class="form-control" name="tanggalPesan" value="<?= $tanggalPesan ?>" required>
    </div>

    <!-- Durasi -->
    <div class="mb-3">
        <label class="form-label">Durasi Sewa (Jam)</label>
        <input type="number" class="form-control" name="durasi" min="1" value="<?= $durasi ?>" required>
    </div>

    <!-- Snack -->
    <div class="mb-3 form-check">
        <input class="form-check-input" type="checkbox" name="snack" id="snack" <?= ($snack)?"checked":"" ?>>
        <label class="form-check-label" for="snack">Termasuk Snack <span class="text-muted">(+ Rp 20.000)</span></label>
    </div>

    <!-- Total Bayar -->
    <div class="mb-3">
        <label class="form-label">Total Bayar</label>
        <input type="text" class="form-control" readonly value="<?= $hitungPressed ? $total : "" ?>">
    </div>

    <div class="mb-3">
        <small class="text-success fw-semibold"><?= $hitungPressed ? $infoDiskon : "" ?></small>
    </div>

    <!-- Tombol aksi -->
    <div class="text-center">
        <button type="submit" class="btn btn-primary" name="action" value="hitung">Hitung Total</button>
        <button type="submit" class="btn btn-success" name="action" value="simpan">Simpan</button>
        <a href="index.php" class="btn btn-danger">Kembali</a>
    </div>
</form>
</div>
</section>

</body>
</html>
