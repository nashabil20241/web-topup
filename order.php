<div class="card p-4 mb-3">
    <h5>2. Pilih Nominal Diamond</h5>
    <div class="row g-2">
        <?php 
        include 'ambil_produk.php'; 
        foreach($produk_ml as $item): 
            // Mas bisa mark-up harga di sini (contoh: untung Rp 500)
            $harga_jual = $item['price'] + 500; 
        ?>
        <div class="col-6 col-md-4">
            <input type="radio" class="btn-check" name="sku" id="<?php echo $item['sku']; ?>" value="<?php echo $item['sku']; ?>">
            <label class="btn btn-outline-primary w-100" for="<?php echo $item['sku']; ?>">
                <?php echo $item['product_name']; ?><br>
                <small>Rp <?php echo number_format($harga_jual); ?></small>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
</div>
