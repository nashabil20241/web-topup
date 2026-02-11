<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up Mobile Legends - LibanStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .btn-check:checked + .btn-outline-primary { background-color: #0d6efd; color: white; border-color: #0d6efd; }
        .nominal-box { height: 100%; display: flex; flex-direction: column; justify-content: center; padding: 10px; font-size: 0.85rem; }
    </style>
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-primary">Mobile Legends</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <h5 class="fw-bold mb-3">1. Masukkan ID</h5>
                <input type="number" name="user_id" class="form-control mb-2" placeholder="User ID" required>
                <input type="number" name="zone_id" class="form-control" placeholder="Zone ID" required>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card p-4">
                <h5 class="fw-bold mb-3">2. Pilih Nominal Diamond</h5>
                <div class="row g-2">
                    <?php 
                    include 'ambil_produk.php'; 
                    if(empty($produk_ml)) {
                        echo "<p class='text-danger'>Gagal memuat produk. Cek IP Whitelist di APIGames!</p>";
                    } else {
                        foreach($produk_ml as $item): 
                            // Untung Rp 500 per transaksi
                            $harga_jual = $item['price'] + 500; 
                    ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <input type="radio" class="btn-check" name="sku" id="<?php echo $item['sku']; ?>" value="<?php echo $item['sku']; ?>">
                        <label class="btn btn-outline-primary w-100 nominal-box" for="<?php echo $item['sku']; ?>">
                            <b><?php echo $item['product_name']; ?></b>
                            <small>Rp <?php echo number_format($harga_jual, 0, ',', '.'); ?></small>
                        </label>
                    </div>
                    <?php 
                        endforeach; 
                    } 
                    ?>
                </div>
                <button class="btn btn-primary btn-lg w-100 mt-4 fw-bold">Beli Sekarang</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
