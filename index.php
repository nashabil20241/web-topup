<?php include 'api_vip.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibanStore - Top Up Otomatis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .game-card { transition: transform 0.2s; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 12px; }
        .game-card:hover { transform: translateY(-5px); }
        .game-title { font-size: 0.9rem; font-weight: bold; text-align: center; padding: 15px 10px; }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <h3 class="mb-4 fw-bold border-bottom pb-2">Daftar Game Terpopuler</h3>
    <div class="row g-3">
        <?php
        $game_list = [];
        if (isset($data_vip['data']) && is_array($data_vip['data'])) {
            foreach ($data_vip['data'] as $item) {
                // Ambil brand/kategori game (misal: "Mobile Legends", "Free Fire")
                $brand = isset($item['brand']) ? trim($item['brand']) : '';
                
                // Pastikan nama game tidak kosong dan belum dimasukkan ke array
                if ($brand != '' && !in_array($brand, $game_list)) {
                    $game_list[] = $brand;
                    // Bikin URL yang rapi, contoh: order.php?game=Mobile Legends
                    $url_order = "order.php?game=" . urlencode($brand);
                    ?>
                    <div class="col-6 col-md-3 col-lg-2">
                        <a href="<?php echo $url_order; ?>" class="text-decoration-none text-dark">
                            <div class="card game-card h-100">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($brand); ?>&background=0d6efd&color=fff&size=150" class="card-img-top" style="border-radius: 12px 12px 0 0;" alt="<?php echo htmlspecialchars($brand); ?>">
                                <div class="game-title"><?php echo htmlspecialchars($brand); ?></div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }
        } else {
            echo "<p class='text-muted'>Belum ada game yang dimuat. Pastikan API terhubung.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
