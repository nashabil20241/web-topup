<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liban Store - Top Up Game Termurah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #121212; color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #121212; padding: 15px 0; border-bottom: 1px solid #2a2a2a; }
        .brand-logo { color: #00d166 !important; font-weight: 900; font-size: 1.5rem; letter-spacing: 1px; }
        .search-box { background-color: #1e1e1e; border: 1px solid #333; color: white; border-radius: 20px; }
        .hero-banner { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border-radius: 16px; padding: 40px; height: 100%; display: flex; flex-direction: column; justify-content: center; }
        .promo-scroll { display: flex; overflow-x: auto; gap: 15px; padding-bottom: 10px; scrollbar-width: none; }
        .promo-card { background-color: #1e1e1e; border: 1px solid #2a2a2a; border-radius: 12px; min-width: 160px; padding: 15px; position: relative; overflow: hidden; }
        .game-card { background: transparent; border: none; cursor: pointer; text-decoration: none; display: block; transition: transform 0.2s; }
        .game-card:hover { transform: scale(1.03); }
        .game-card img { border-radius: 16px; width: 100%; aspect-ratio: 1/1; object-fit: cover; margin-bottom: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.5); }
        .game-title { color: #fff; font-weight: bold; font-size: 0.9rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .game-pub { color: #888; font-size: 0.75rem; margin: 0; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg mb-4 sticky-top">
    <div class="container d-flex align-items-center justify-content-between">
        <a class="navbar-brand brand-logo" href="index.php">LIBANSTORE</a>
    </div>
</nav>

<div class="container pb-5">
    <div class="row g-4 mb-5">
        <div class="col-lg-7">
            <div class="hero-banner shadow">
                <h3 class="bg-white text-dark d-inline-block px-3 py-1 rounded-3 mb-3 w-75">FOLLOW AKUN IG @LIBAN.STORE</h3>
                <p class="mb-0 fw-bold fs-5">UNTUK DAPATKAN INFO MENARIK<br>SEPUTAR GAME & TEKNOLOGI</p>
            </div>
        </div>
        <div class="col-lg-5">
            <h5 class="fw-bold mb-3"><i class="fas fa-surprise text-warning"></i> PROMO</h5>
            <div class="promo-scroll">
                <div class="promo-card shadow-sm"><div class="text-white small fw-bold mb-2">MLBB</div><div class="text-success fw-bold">Rp 19.500</div></div>
                <div class="promo-card shadow-sm"><div class="text-white small fw-bold mb-2">Free Fire</div><div class="text-success fw-bold">Rp 20.000</div></div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <h5 class="fw-bold mb-0"><i class="far fa-gem text-info me-2"></i>Top Up Game</h5>
    </div>
    
    <div class="row g-3">
        <div class="col-4 col-md-3 col-lg-2">
            <a href="game.php?kategori=Mobile" class="game-card"> <img src="https://play-lh.googleusercontent.com/bYtqbOcTYOxdKKnPXjyEuiYebR2wRuiH3F-e1lJzTzM06Q0Oms2m1y6XoYvN10fB_w" alt="Mobile Legends">
                <p class="game-title">Mobile Legends</p>
                <p class="game-pub">Moonton</p>
            </a>
        </div>
        <div class="col-4 col-md-3 col-lg-2">
            <a href="game.php?kategori=Free Fire" class="game-card">
                <img src="https://play-lh.googleusercontent.com/NEjsFWimJGEsIqAATj75Fh5F2k4GstQ0iL-yL4fVfJ_xWv0N94p0PZ7r_FzR-P3iWkY" alt="Free Fire">
                <p class="game-title">Free Fire</p>
                <p class="game-pub">Garena</p>
            </a>
        </div>
        <div class="col-4 col-md-3 col-lg-2">
            <a href="game.php?kategori=PUBG" class="game-card">
                <img src="https://play-lh.googleusercontent.com/JRd05pyBH41qjgsJuWduRJpDeZG0Hti0yHQ1--WE64pA5CQXpP1lE4O_G-0G82Wc5w" alt="PUBG Mobile">
                <p class="game-title">PUBG Mobile</p>
                <p class="game-pub">Level Infinite</p>
            </a>
        </div>
        <div class="col-4 col-md-3 col-lg-2">
            <a href="game.php?kategori=Soundcloud" class="game-card"> <img src="https://play-lh.googleusercontent.com/mX2XvG6m4Kj6K10vA4xTtt5zDqM4hXn28qT81B65sPj7kUeZq4aJqzC0r-mD-73W3w" alt="Soundcloud">
                <p class="game-title">Soundcloud Likes</p>
                <p class="game-pub">Sosmed</p>
            </a>
        </div>
    </div>
</div>
</body>
</html>