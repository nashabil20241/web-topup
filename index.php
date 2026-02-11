<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up Game Murah & Cepat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --primary-color: #0d6efd; --bg-dark: #1a1d20; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,.1); }
        .hero-banner { background: linear-gradient(45deg, #0d6efd, #00d2ff); color: white; padding: 40px 0; border-radius: 15px; margin-bottom: 30px; }
        .game-card { border: none; border-radius: 12px; transition: transform 0.3s; cursor: pointer; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .game-card:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0,0,0,0.1); }
        .game-card img { border-radius: 12px 12px 0 0; height: 150px; object-fit: cover; }
        .game-title { font-size: 0.9rem; font-weight: bold; text-align: center; padding: 10px; color: #333; }
        .section-title { font-weight: bold; margin-bottom: 20px; border-left: 5px solid var(--primary-color); padding-left: 15px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="#">HabilStore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="#"><i class="fas fa-home"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-search"></i> Cek Pesanan</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="hero-banner text-center">
        <h1>Top Up Game Terlengkap</h1>
        <p>Proses Cepat, Aman, dan Harga Bersahabat</p>
    </div>

    <h4 class="section-title">Populer Sekarang</h4>
    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
        
        <div class="col">
            <a href="order.php?game=mobilelegends" class="text-decoration-none text-dark">
                <div class="card game-card">
                    <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp" alt="Mobile Legends">
                    <div class="game-title">Mobile Legends</div>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="order.php?game=freefire" class="text-decoration-none text-dark">
                <div class="card game-card">
                    <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp" alt="Free Fire">
                    <div class="game-title">Free Fire</div>
                </div>
            </a>
        </div>

        </div>
</div>

<footer class="bg-white text-center py-4 mt-5 border-top">
    <p class="mb-0 text-muted">&copy; 2026 HabilStore. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
