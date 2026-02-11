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
        $ada_data = false;

        // Cek apakah data benar-benar turun dari VIP
        if (isset($data_vip['data']) && is_array($data_vip['data'])) {
            foreach ($data_vip['data'] as $item) {
                // Kita coba semua kemungkinan nama kategori dari VIP Reseller
                $brand = $item['brand'] ?? $item['category'] ?? $item['kategori'] ?? $item['game'] ?? '';
                $brand = trim($brand);
                
                // Pisahkan nama yang valid dan cegah duplikat
                if ($brand != '' && !in_array($brand, $game_list)) {
                    $game_list[] = $brand;
                    $ada_data = true;
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
        } 
        
        // JIKA MASIH KOSONG: Tampilkan 1 data mentah agar kita tahu format aslinya
        if (!$ada_data) {
            echo "<p class='text-muted'>Mencari format kategori...</p>";
            echo "<pre style='background:#eee; padding:15px; border-radius:8px; font-size:13px; overflow-x:auto;'>";
            if(isset($data_vip['data'][0])) {
                echo "<b>Berhasil narik data! Tapi kuncinya apa ya? Cek di bawah ini:</b>\n\n";
                print_r($data_vip['data'][0]);
            } else {
                echo "Data dari pusat VIP Reseller benar-benar kosong.";
            }
            echo "</pre>";
        }
        ?>
    </div>
</div>

</body>
</html>
