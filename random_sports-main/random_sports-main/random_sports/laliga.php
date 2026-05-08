<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaLiga Official Live | RandomSports</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <style>
        /* CSS Unchanged from your original design */
        :root { --laliga-red: #ee3c23; --laliga-dark: #111111; --laliga-bg: #f4f4f4; --white: #ffffff; --text-main: #111111; --text-dim: #666666; }
        * { margin:0; padding:0; box-sizing:border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--laliga-bg); color: var(--text-main); }
        header { background: var(--white); padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 4px solid var(--laliga-red); }
        header strong { font-size: 26px; font-weight: 900; color: var(--laliga-dark); }
        header strong span { color: var(--laliga-red); }
        .nav-links { display: flex; gap: 20px; list-style: none; }
        .nav-links a { text-decoration: none; color: var(--text-dim); font-weight: 700; font-size: 13px; text-transform: uppercase; }
        .nav-links a.active { color: var(--laliga-red); }
        .live-bar { background: var(--laliga-red); color: var(--white); font-size: 13px; font-weight: 800; padding: 10px 0; text-align: center; }
        .main-content { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
        .player-wrapper { background: var(--laliga-dark); border-radius: 12px; overflow: hidden; }
        .player-header { background: var(--white); padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; }
        .live-badge { background: var(--laliga-red); color: var(--white); padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: 900; animation: pulse 1.5s infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }
        .video-container { position: relative; padding-top: 56.25%; background: #000; }
        video { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
        .section-title { margin: 40px 0 20px; font-size: 22px; font-weight: 800; border-left: 6px solid var(--laliga-red); padding-left: 15px; }
        .match-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; }
        .match-card { background: var(--white); padding: 20px; border-radius: 10px; border: 1px solid #ddd; cursor: pointer; display: flex; justify-content: space-between; align-items: center; }
        .match-card.active { background: var(--laliga-red); color: var(--white); border-color: var(--laliga-red); }
        .status { font-size: 11px; font-weight: 800; padding: 5px 10px; background: rgba(0,0,0,0.05); border-radius: 5px; }
        .telegram-btn { margin-top: 25px; width: 100%; padding: 16px; background: #000; color: var(--white); border: none; font-weight: 800; cursor: pointer; border-radius: 8px; }
    </style>
</head>
<body>

<header>
    <strong>LA<span>LIGA</span></strong>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="worldcup2026.php">World Cup</a></li>
        <li><a href="laliga.php" class="active">La Liga</a></li>
        <li><a href="premierleague.php">EPL</a></li>
    </ul>
</header>

<div class="live-bar">
    <marquee scrollamount="8">LALIGA EA SPORTS™ LIVE HD • NO ADS • ENJOY THE GAME</marquee>
</div>

<div class="main-content">
    <div class="player-wrapper">
        <div class="player-header">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span class="live-badge">LIVE</span>
                <span id="matchTitle" style="font-weight: 800; text-transform: uppercase;">Select a Match</span>
            </div>
            <i class="fas fa-tv" style="color: var(--laliga-red);"></i>
        </div>
        <div class="video-container">
            <video id="video" controls autoplay playsinline></video>
        </div>
    </div>

    <h3 class="section-title">TODAY'S LALIGA FIXTURES</h3>
    <div id="matchGrid" class="match-grid">
        <?php
        // Fetching matches and stream links from database
        $sql = "SELECT * FROM laliga_streams WHERE is_active = 1 ORDER BY id DESC";
        $result = $conn->query($sql);
        $firstMatch = null;

        if ($result->num_rows > 0) {
            $count = 0;
            while($row = $result->fetch_assoc()) {
                if ($count === 0) $firstMatch = $row;
                echo '
                <div class="match-card '.($count === 0 ? "active" : "").'" 
                     onclick="startPlayer(this, \''.$row["match_name"].'\', \''.$row["stream_url"].'\')">
                    <div class="teams">'.$row["match_name"].'</div>
                    <div class="status">LIVE</div>
                </div>';
                $count++;
            }
        } else {
            echo "<p style='padding:20px;'>No matches available in database. Add via Admin Panel.</p>";
        }
        ?>
    </div>

    <button class="telegram-btn" onclick="window.open('https://t.me/yourchannel','_blank')">
        <i class="fab fa-telegram"></i> JOIN TELEGRAM FOR LALIGA LINKS
    </button>
</div>

<footer>
    <p>&copy; 2026 RandomSports | Official LaLiga Red & White Branding</p>
</footer>

<script>
    const video = document.getElementById('video');
    let hls;

    function startPlayer(element, title, url) {
        document.getElementById('matchTitle').innerText = title;
        document.querySelectorAll('.match-card').forEach(i => i.classList.remove('active'));
        element.classList.add('active');

        if (hls) hls.destroy();
        if (Hls.isSupported()) {
            hls = new Hls(); 
            hls.loadSource(url); 
            hls.attachMedia(video);
        } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
            video.src = url;
        }
    }

    // Auto-play first match from DB
    window.onload = () => {
        <?php if($firstMatch): ?>
            startPlayer(document.querySelector('.match-card.active'), '<?php echo $firstMatch["match_name"]; ?>', '<?php echo $firstMatch["stream_url"]; ?>');
        <?php endif; ?>
    };
</script>
</body>
</html>