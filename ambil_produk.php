<?php
include 'koneksi.php';

$id = trim($api_id);
$key = trim($api_key);

// KITA SAMAKAN RUMUSNYA DENGAN YANG SUKSES DI HALAMAN DEPAN
$formData = [
    'api_id'  => $id,
    'api_key' => $key,
    'key'     => $key,
    'sign'    => md5($id . $key),
    'type'    => 'services'
];

$url = "https://vip-reseller.co.id/api/game-feature"; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $formData); // Harus begini agar diterima VIP
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$data_vip = json_decode($result, true);

// Deteksi game apa yang sedang dibuka (Biar dinamis)
$game_pilihan = isset($_GET['game']) ? strtolower(trim($_GET['game'])) : 'mobile legends';

$produk_ml = [];
$seen_names = [];

// Proses penyaringan data
if (isset($data_vip['data']) && is_array($data_vip['data'])) {
    foreach ($data_vip['data'] as $item) {
        // Ambil nama kategori/brand dari API
        $brand = strtolower($item['brand'] ?? $item['category'] ?? $item['kategori'] ?? $item['game'] ?? '');
        
        // 1. Cocokkan dengan game yang diklik pembeli
        if (strpos($brand, $game_pilihan) !== false) {
            $name = strtolower($item['name']);
            
            // 2. Filter Ketat: Buang Joki, Twilight, dan Pass
            if (strpos($name, 'joki') === false && 
                strpos($name, 'twilight') === false && 
                strpos($name, 'pass') === false) {
                
                // 3. Bersihkan tulisan "Bonus", "+", dsb biar rapi
                $clean_name = preg_replace('/(\+.*bonus.*|bonus.*|\(.*\))/i', '', $item['name']);
                $clean_name = trim($clean_name);

                // 4. Anti Duplikat (No Dupe)
                if (!in_array($clean_name, $seen_names)) {
                    $item['name_clean'] = $clean_name;
                    $produk_ml[] = $item;
                    $seen_names[] = $clean_name; // Catat agar tidak muncul 2x
                }
            }
        }
    }
}

// Tampilkan error jika IP masih nyangkut atau API salah
if (isset($data_vip['result']) && $data_vip['result'] == false) {
    echo "<div class='alert alert-danger w-100'><b>Error VIP Reseller:</b> " . $data_vip['message'] . "</div>";
}
?>
