<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCL Official Live | RandomSports</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <style>
        /* UCL Premium Dark Theme */
        :root { 
            --ucl-blue: #001c4d; 
            --ucl-cyan: #00d4ff; 
            --ucl-dark: #020b1c; 
            --ucl-card: #051430;
            --white: #ffffff; 
            --text-dim: #a0a0a0; 
        }
        
        * { margin:0; padding:0; box-sizing:border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--ucl-dark); color: var(--white); }
        
        header { background: var(--ucl-blue); padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 4px solid var(--ucl-cyan); }
        header strong { font-size: 26px; font-weight: 900; color: var(--white); text-transform: uppercase; }
        header strong span { color: var(--ucl-cyan); }
        
        .nav-links { display: flex; gap: 20px; list-style: none; }
        .nav-links a { text-decoration: none; color: var(--text-dim); font-weight: 700; font-size: 13px; text-transform: uppercase; }
        .nav-links a.active { color: var(--ucl-cyan); }
        
        .live-bar { background: linear-gradient(90deg, var(--ucl-blue), var(--ucl-cyan)); color: var(--white); font-size: 13px; font-weight: 800; padding: 10px 0; text-align: center; }
        
        .main-content { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
        
        .player-wrapper { background: #000; border-radius: 12px; overflow: hidden; border: 1px solid #1a2a47; box-shadow: 0 10px 30px rgba(0, 212, 255, 0.1); }
        .player-header { background: var(--ucl-blue); padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #1a2a47; }
        
        .live-badge { background: #ff0000; color: var(--white); padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: 900; animation: pulse 1.5s infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }
        
        .video-container { position: relative; padding-top: 56.25%; background: #000; }
        video { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
        
        .section-title { margin: 40px 0 20px; font-size: 22px; font-weight: 800; border-left: 6px solid var(--ucl-cyan); padding-left: 15px; color: var(--ucl-cyan); }
        
        .match-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; }
        .match-card { background: var(--ucl-card); padding: 20px; border-radius: 10px; border: 1px solid #1a2a47; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: 0.3s; }
        .match-card:hover { border-color: var(--ucl-cyan); }
        .match-card.active { background: var(--ucl-cyan); color: var(--ucl-dark); border-color: var(--ucl-cyan); }
        
        .status { font-size: 11px; font-weight: 800; padding: 5px 10px; background: rgba(255,255,255,0.1); border-radius: 5px; color: var(--ucl-cyan); }
        .match-card.active .status { background: var(--ucl-dark); color: var(--ucl-cyan); }
        
        .telegram-btn { margin-top: 25px; width: 100%; padding: 16px; background: #0088cc; color: var(--white); border: none; font-weight: 800; cursor: pointer; border-radius: 8px; text-transform: uppercase; }
    </style>
</head>
<body>

<header>
    <strong>CHAMPIONS <span>LEAGUE</span></strong>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="worldcup2026.php">World Cup</a></li>
        <li><a href="ucl.php" class="active">UCL</a></li>
        <li><a href="laliga.php">La Liga</a></li>
    </ul>
</header>

<div class="live-bar">
    <marquee scrollamount="8">UEFA CHAMPIONS LEAGUE™ LIVE HD • ROAD TO MUNICH • NO ADS • ENJOY THE MATCH</marquee>
</div>

<div class="main-content">
    <div class="player-wrapper">
        <div class="player-header">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span class="live-badge">LIVE</span>
                <span id="matchTitle" style="font-weight: 800; text-transform: uppercase;">Select a Match</span>
            </div>
            <i class="fas fa-trophy" style="color: #ffd700;"></i>
        </div>
        <div class="video-container">
            <video id="video" controls autoplay playsinline></video>
        </div>
    </div>

    <h3 class="section-title">TONIGHT'S UCL FIXTURES</h3>
    <div id="matchGrid" class="match-grid">
        <?php
        // Database theke UCL matches ana hoche
        $sql = "SELECT * FROM ucl_streams WHERE is_active = 1 ORDER BY id DESC";
        $result = $conn->query($sql);
        $firstMatch = null;

        if ($result && $result->num_rows > 0) {
            $count = 0;
            while($row = $result->fetch_assoc()) {
                if ($count === 0) $firstMatch = $row;
                echo '
                <div class="match-card '.($count === 0 ? "active" : "").'" 
                     onclick="startPlayer(this, \''.addslashes($row["match_title"]).'\', \''.$row["stream_url"].'\')">
                    <div class="teams" style="font-weight: 700;">'.$row["match_title"].'</div>
                    <div class="status">LIVE</div>
                </div>';
                $count++;
            }
        } else {
            echo "<p style='padding:20px; color: var(--text-dim);'>No UCL matches active. Update from Admin.</p>";
        }
        ?>
    </div>

    <button class="telegram-btn" onclick="window.open('https://t.me/yourchannel','_blank')">
        <i class="fab fa-telegram"></i> JOIN TELEGRAM FOR PREMIUM LINKS
    </button>
</div>

<footer>
    <p style="text-align: center; padding: 30px; color: #555; font-size: 13px;">
        &copy; 2026 RandomSports | Official Champions League Premium Branding
    </p>
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
            hls.on(Hls.Events.MANIFEST_PARSED, function() {
                video.play();
            });
        } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
            video.src = url;
            video.play();
        }
    }

    window.onload = () => {
        <?php if($firstMatch): ?>
            startPlayer(document.querySelector('.match-card.active'), '<?php echo addslashes($firstMatch["match_title"]); ?>', '<?php echo $firstMatch["stream_url"]; ?>');
        <?php endif; ?>
    };
</script>
</body>
</html>