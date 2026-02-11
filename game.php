<?php
include 'koneksi.php';

// Ambil kategori dari URL, default ke Mobile Legends
$kategori_pilihan = isset($_GET['kategori']) ? $_GET['kategori'] : 'Mobile Legends';

// DI FILE game.php UBAH JADI INI:
$signature = md5($merchant_id . $secret_key . "produk");
// UBAH BARIS URL DI game.php JADI SEPERTI INI:
// UBAH BARIS URL DI game.php JADI SEPERTI INI:// UBAH BARIS URL DI game.php JADI SEPERTI INI:
$url = "https://v1.apigames.id/merchant/produk?merchant=$merchant_id&signature=$signature";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$respon = json_decode($result, true);
$produk_game = [];

// 2. FILTER PRODUK BERDASARKAN KATEGORI APIGAMES
if (isset($respon['data'])) {
    foreach ($respon['data'] as $p) {
// Cari produk yang mengandung kata kunci (misal cari 'Mobile' di 'Mobile Legends')
if (stripos($p['destination'], $kategori_pilihan) !== false || stripos($p['product_name'], $kategori_pilihan) !== false) {
    $produk_game[] = $p;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up <?= htmlspecialchars($kategori_pilihan); ?> - Liban Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #121212; color: #fff; font-family: 'Segoe UI', sans-serif; }
        .card { background-color: #1e1e1e; border: 1px solid #2a2a2a; border-radius: 12px; margin-bottom: 20px; }
        .number-badge { background-color: #00d166; color: #121212; padding: 2px 10px; border-radius: 50%; margin-right: 10px; font-weight: bold;}
        .btn-outline-primary { border-color: #333; color: #a0a0a0; text-align: left; padding: 15px; border-radius: 10px; transition: 0.2s; }
        .btn-check:checked + .btn-outline-primary { border-color: #00d166; color: #fff; background: #2a2a2a; }
        .price-text { color: #00d166; font-weight: bold; display: block; margin-top: 5px; }
    </style>
</head>
<body>

<div class="container mt-5 pb-5">
    <a href="index.php" class="btn btn-sm btn-outline-success mb-4"><i class="fas fa-arrow-left"></i> KEMBALI</a>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card p-4">
                <h4 class="fw-bold text-success"><?= htmlspecialchars($kategori_pilihan); ?></h4>
                <hr style="border-color: #333;">
                <p class="small text-muted">Panduan:<br>Masukkan User ID dan Zone ID Anda dengan benar untuk mempercepat proses top up.</p>
            </div>
        </div>

        <div class="col-md-8">
            <form action="order.php" method="POST">
                
                <div class="card p-4">
                    <h5><span class="number-badge">1</span> Masukkan Data Akun</h5>
                    <input type="text" name="user_id" class="form-control bg-dark text-white border-secondary py-2" placeholder="Contoh: 12345678 (1234)" required>
                </div>

                <div class="card p-4">
                    <h5><span class="number-badge">2</span> Pilih Layanan <?= htmlspecialchars($kategori_pilihan); ?></h5>
                    <div class="row g-3">
                        <?php if(empty($produk_game)): ?>
                            <div class="col-12 text-center py-4">
                                <i class="fas fa-search fa-2x mb-3 text-muted"></i>
                                <p class="text-danger">Layanan tidak ditemukan di APIGames.<br><small class="text-muted">Cek apakah nama kategori "<?= htmlspecialchars($kategori_pilihan); ?>" sudah sesuai di dashboard.</small></p>
                            </div>
                        <?php else: ?>
                            <?php foreach($produk_game as $produk): ?>
                            <div class="col-6 col-md-4">
                                <input type="radio" class="btn-check" name="sku" id="<?= $produk['sku']; ?>" value="<?= $produk['sku']; ?>" required>
                                <label class="btn btn-outline-primary w-100 h-100" for="<?= $produk['sku']; ?>">
                                    <div class="small fw-bold"><?= htmlspecialchars($produk['product_name']); ?></div>
                                    <span class="price-text">Rp <?= number_format($produk['price'], 0, ',', '.'); ?></span>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card p-4 shadow-lg" style="border-top: 4px solid #00d166;">
                    <button type="submit" class="btn btn-lg w-100 fw-bold py-3" style="background:#00d166; color:#121212;">
                        <i class="fas fa-shopping-cart me-2"></i> BELI SEKARANG
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>