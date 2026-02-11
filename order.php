<div class="card p-4">
    <h5 class="fw-bold mb-3">2. Pilih Nominal Diamond</h5>
    <div class="row g-2">
        <?php 
        include 'ambil_produk.php'; 
        if(empty($produk_ml)) {
            echo "<div class='alert alert-warning'>Produk sedang tidak tersedia atau cek API Key Mas.</div>";
        } else {
            foreach($produk_ml as $item): 
                // Mark up untung Rp 1.000 (Sesuaikan keinginan Mas)
                $harga_jual = $item['price'] + 1000; 
        ?>
        <div class="col-6 col-md-4">
            <input type="radio" class="btn-check" name="service" id="svc-<?php echo $item['id']; ?>" value="<?php echo $item['id']; ?>">
            <label class="btn btn-outline-primary w-100 p-3 h-100 d-flex flex-column align-items-center justify-content-center" for="svc-<?php echo $item['id']; ?>">
                <span class="fw-bold" style="font-size: 0.9rem;"><?php echo $item['name_clean']; ?></span>
                <small class="text-dark mt-1">Rp <?php echo number_format($harga_jual, 0, ',', '.'); ?></small>
            </label>
        </div>
        <?php endforeach; } ?>
    </div>
</div>
