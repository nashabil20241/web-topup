<?php
include 'koneksi.php';

$formData = [
    'api_id' => $api_id,
    'api_key' => $api_key,
    'type' => 'services', // Di VIP namanya services
];

$ch = curl_init("https://vip-reseller.co.id/api/game-feature");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($formData));
$result = curl_exec($ch);
curl_close($ch);

$data = json_decode($result, true);
$produk_ml = [];
$seen_names = []; // Untuk mencegah duplikat (no dupe)

if (isset($data['data']) && is_array($data['data'])) {
    foreach ($data['data'] as $item) {
        $name = strtolower($item['name']);
        
        // 1. Filter: Hanya Mobile Legends, Tanpa Joki, Tanpa Twilight, Tanpa Pass
        if (strpos($name, 'mobile legends') !== false && 
            strpos($name, 'joki') === false && 
            strpos($name, 'twilight') === false && 
            strpos($name, 'pass') === false) {
            
            // 2. Bersihkan nama dari tulisan "Bonus", "+", dll agar rapi
            $clean_name = preg_replace('/(\+.*bonus.*|bonus.*|\(.*\))/i', '', $item['name']);
            $clean_name = trim($clean_name);

            // 3. No Dupe: Jika nama bersih belum pernah ada, masukkan ke daftar
            if (!in_array($clean_name, $seen_names)) {
                $item['name_clean'] = $clean_name;
                $produk_ml[] = $item;
                $seen_names[] = $clean_name;
            }
        }
    }
}
?>
