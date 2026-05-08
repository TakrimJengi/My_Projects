<?php
/**
 * RandomSports - Premium Live Sports Portal
 * PHP Dynamic Version
 */

// --- Hot Events Data Array ---
$hot_events = [
    ['href' => 'f1.php', 'img' => 'F1-Formula 1.webp', 'title' => 'F1-Formula 1', 'badge' => 'Featured', 'badge_class' => 'featured'],
    ['href' => 'worldcup2026.php', 'img' => 'world cup 2026.png', 'title' => 'World Cup 2026', 'badge' => 'Featured', 'badge_class' => 'featured'],
    // UCL Link Thik Kora Hoyeche
    ['href' => 'ucl.php', 'img' => 'ucl.jpg', 'title' => 'Champions League', 'badge' => 'Featured', 'badge_class' => 'featured'], 
    ['href' => 'laliga.php', 'img' => 'laliga.png', 'title' => 'La Liga', 'badge' => 'Featured', 'badge_class' => 'featured'],
    ['href' => 'bundes.php', 'img' => 'Bundesliga_logo_(2017).svg.png', 'title' => 'Bundesliga', 'badge' => 'Featured', 'badge_class' => 'featured'],
    ['href' => 'epl.php', 'img' => 'epl.png', 'title' => 'Premier League', 'badge' => 'Featured', 'badge_class' => 'featured'],
];

// --- Live Football Data Array ---
$live_football = [
    ['href' => 'bundes.php', 'img' => 'Bundesliga_logo_(2017).svg.png', 'title' => 'Bundesliga'],
    ['href' => 'serieA.php', 'img' => 'sa.jpg', 'title' => 'Serie A'],
    ['href' => 'ligue1.php', 'img' => 'l1.jpg', 'title' => 'Ligue 1'],
    ['href' => 'spl.php', 'img' => 'spl.png', 'title' => 'Saudi Pro League'],
];

// --- Bangladesh TV Data Array ---
$bd_tv = [
    ['href' => 'atnnews.php', 'img' => 'atn.png', 'title' => 'ATN Bangla'],
    ['href' => 'jamuna.php', 'img' => '24.png', 'title' => 'Channel 24'],
    ['href' => 'channel24.php', 'img' => 'jomuna.webp', 'title' => 'Jamuna TV'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RandomSports | Premium Live Sports Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        :root {
            --primary-red: #ff3b3b;
            --dark-bg: #0f1014;
            --card-bg: #1a1c23;
            --text-gray: #a0a0a0;
            --neon-green: #2ecc71;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--dark-bg);
            color: #fff;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* --- Custom Scrollbar --- */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f1014; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary-red); }

        /* --- Header & Navbar --- */
        .main-header {
            background-color: #000;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid #222;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 5%;
        }

        .navbar .logo a {
            color: #fff;
            text-decoration: none;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .navbar .logo span { color: var(--primary-red); }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
        }

        .nav-links li a {
            color: #ccc;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
        }

        .nav-links li a:hover { color: var(--primary-red); }

        .update-bar {
            background-color: #1a1c23;
            padding: 8px 5%;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-top: 1px solid #222;
        }

        .update-bar .tag {
            background: var(--primary-red);
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 11px;
        }

        .update-bar marquee { color: #ffeb3b; font-weight: 500; }

        /* --- Hero Section --- */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&q=80&w=1200') no-repeat center/cover;
            padding: 40px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #333;
        }

        .sponsor-box h1 { margin: 0; font-size: 28px; font-weight: 800; }
        .sponsor-box p { color: #ccc; margin: 10px 0 20px; }

        .download-btn {
            padding: 12px 25px;
            background-color: var(--primary-red);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: bold;
            font-size: 15px;
            box-shadow: 0 4px 15px rgba(255, 59, 59, 0.4);
            transition: 0.3s;
        }

        .download-btn:hover { transform: scale(1.05); background: #e62e2e; }

        .online-status {
            background: rgba(46, 204, 113, 0.1);
            color: var(--neon-green);
            padding: 8px 15px;
            border-radius: 20px;
            border: 1px solid var(--neon-green);
            font-weight: bold;
        }

        /* --- Alphabet Bar --- */
        .alphabet-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 15px 5%;
            background-color: #111;
            justify-content: center;
        }

        .alphabet-bar span {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #1a1c23;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 12px;
            border: 1px solid #333;
            transition: 0.3s;
            color: #999;
        }

        .alphabet-bar span:hover { background: var(--primary-red); color: #fff; border-color: var(--primary-red); }

        /* --- Card Grid --- */
        .category-section { margin: 40px 5% 0; }
        .section-title {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-title::before {
            content: "";
            width: 5px;
            height: 25px;
            background: var(--primary-red);
            border-radius: 10px;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 15px;
            text-decoration: none;
            color: #fff;
            overflow: hidden;
            transition: 0.4s;
            position: relative;
            border: 1px solid #2a2d37;
            display: flex;
            flex-direction: column;
            height: 210px;
        }

        .card:hover {
            transform: translateY(-8px);
            border-color: var(--primary-red);
            box-shadow: 0 10px 20px rgba(0,0,0,0.5);
        }

        .card-img-container {
            width: 100%;
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #252831;
            padding: 15px;
            box-sizing: border-box;
        }

        .card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 5px 10px rgba(0,0,0,0.3));
        }

        .card p {
            margin: 0;
            padding: 15px 10px;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            background: var(--card-bg);
            flex-grow: 1;
        }

        /* Badges */
        .badge {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 800;
            color: white;
            z-index: 2;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .featured { background: linear-gradient(45deg, #f39c12, #e67e22); }
        .live { background: var(--neon-green); animation: pulse 1.5s infinite; }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(46, 204, 113, 0); }
            100% { box-shadow: 0 0 0 0 rgba(46, 204, 113, 0); }
        }

        @media (max-width: 480px) {
            .navbar { padding: 10px 5%; }
            .nav-links { display: none; }
            .hero-section { flex-direction: column; text-align: center; gap: 20px; }
            .card-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .card { height: 190px; }
            .section-title { font-size: 18px; }
        }
    </style>
</head>
<body>

<header class="main-header">
    <div class="navbar">
        <div class="logo"><a href="index.php">Random<span>Sports</span></a></div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="LiveSportsTv.php">Sports TV</a></li>
            <li><a href="#">CT 2025</a></li>
            <li><a href="#">EURO 24</a></li>
        </ul>
    </div>
    <div class="update-bar">
        <span class="tag">NEWS</span>
        <marquee>Watching Any Football on Here ➤ ভিডিও প্লে হতে সর্বোচ্চ ১ মিনিট অপেক্ষা করুন ➤ Enjoy HD Quality Streams</marquee>
    </div>
</header>

<section class="hero-section">
    <div class="sponsor-box">
        <h1>Experience Live Sports Like Never Before</h1>
        <p>Premium streaming for Football, F1, and International Cricket.</p>
        <button class="download-btn"><i class="fab fa-android"></i> Download Android App</button>
    </div>
    <div class="online-status"><i class="fas fa-circle"></i> 1,240 ONLINE</div>
</section>

<main class="content-wrapper">
    <div class="alphabet-bar">
        <span>#</span>
        <?php 
        $alphabet = range('A', 'Z');
        foreach ($alphabet as $char) {
            echo "<span>$char</span>";
        }
        ?>
    </div>

    <section class="category-section">
        <h2 class="section-title">Hot Events</h2>
        <div class="card-grid">
            <?php foreach ($hot_events as $event): ?>
            <a href="<?= $event['href']; ?>" class="card">
                <span class="badge <?= $event['badge_class']; ?>"><?= $event['badge']; ?></span>
                <div class="card-img-container">
                    <img src="<?= $event['img']; ?>" alt="<?= $event['title']; ?>">
                </div>
                <p><?= $event['title']; ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="category-section">
        <h2 class="section-title">Live Football</h2>
        <div class="card-grid">
            <?php foreach ($live_football as $item): ?>
            <a href="<?= $item['href']; ?>" class="card">
                <span class="badge live">Live</span>
                <div class="card-img-container">
                    <img src="<?= $item['img']; ?>" alt="<?= $item['title']; ?>">
                </div>
                <p><?= $item['title']; ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="category-section" style="margin-bottom: 50px;">
        <h2 class="section-title">Bangladesh TV</h2>
        <div class="card-grid">
            <?php foreach ($bd_tv as $tv): ?>
            <a href="<?= $tv['href']; ?>" class="card">
                <span class="badge live">Live</span>
                <div class="card-img-container">
                    <img src="<?= $tv['img']; ?>" alt="<?= $tv['title']; ?>">
                </div>
                <p><?= $tv['title']; ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<footer style="text-align: center; padding: 20px; color: #666; font-size: 13px; border-top: 1px solid #222;">
    &copy; <?php echo date("Y"); ?> RandomSports. All rights reserved.
</footer>

</body>
</html>