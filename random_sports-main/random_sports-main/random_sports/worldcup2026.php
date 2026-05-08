<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIFA World Cup 2026 – Live Streaming</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <style>
        /* CSS Unchanged from your original file */
        *{ margin:0; padding:0; box-sizing:border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body{ background:#0b0d17; color:#fff; }
        header{ background:#161b22; padding:15px 5%; display:flex; justify-content:space-between; align-items:center; border-bottom: 2px solid #00529b; }
        header strong{ font-size:24px; color:#fff; letter-spacing: 1px; }
        header strong span { color: #00a859; }
        header ul{ list-style:none; display:flex; gap:20px; }
        .nav-link { text-decoration: none; color: #ccc; font-weight: 600; font-size: 14px; text-transform: uppercase; }
        .nav-link.active { color: #00a859; }
        .updates-bar{ background: linear-gradient(90deg, #00529b, #00a859); color:#fff; padding:10px; font-size:14px; text-align: center; font-weight: bold; }
        .player-container{ max-width:1100px; margin:30px auto; background:#000; border-radius:12px; overflow:hidden; border: 1px solid #30363d; }
        .live-title{ background:#161b22; padding:15px 20px; display:flex; align-items:center; gap:12px; font-weight:bold; }
        .live-dot{ width:12px; height:12px; background:#ff0000; border-radius:50%; animation:blink 1s infinite; }
        @keyframes blink{ 50%{opacity:.3} }
        .video-box{ background:#000; position: relative; padding-top: 56.25%; }
        video{ position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
        .links-section{ max-width:1100px; margin:20px auto; background:#161b22; padding:20px; border-radius:12px; border: 1px solid #30363d; }
        #matchLinks { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; }
        .link-item{ padding:15px; border:1px solid #30363d; background: #0d1117; cursor:pointer; font-size:15px; border-radius:8px; display: flex; align-items: center; justify-content: space-between; }
        .link-item:hover{ border-color: #00a859; background: #1c2128; }
        .link-item.active{ background:#00a859; color:#fff; }
        .telegram-btn{ margin-top:25px; width:100%; padding:15px; background:#0088cc; color:#fff; border:none; font-weight: bold; cursor:pointer; border-radius:8px; }
    </style>
</head>
<body>

<header>
    <strong>FIFA <span>2026</span></strong>
    <nav>
        <ul>
            <li><a href="index.php" class="nav-link">Home</a></li>
            <li><a href="LiveSportsTv.php" class="nav-link">Sports TV</a></li>
            <li><a href="worldcup2026.php" class="nav-link active">World Cup</a></li>
        </ul>
    </nav>
</header>

<div class="updates-bar">
    <marquee scrollamount="8">FIFA World Cup 2026 Live: USA, Canada & Mexico | High Quality Streaming Enabled</marquee>
</div>

<div class="player-container">
    <div class="live-title">
        <span class="live-dot"></span>
        <span id="matchTitle">Select a match to start streaming</span>
    </div>
    <div class="video-box">
        <video id="video" controls autoplay playsinline poster="https://digitalhub.fifa.com/transform/3a268a7b-3b0a-4874-9a5e-6e42b826b64d/World-Cup-2026-Logo"></video>
    </div>
</div>

<div class="links-section">
    <h3><i class="fas fa-trophy"></i> World Cup 2026 - Today's Matches</h3>
    <div id="matchLinks">
        <?php
        $sql = "SELECT * FROM wc_matches WHERE status != 'FINISHED' ORDER BY id ASC";
        $result = $conn->query($sql);
        $firstMatch = null;

        if ($result->num_rows > 0) {
            $count = 0;
            while($row = $result->fetch_assoc()) {
                if ($count === 0) $firstMatch = $row;
                echo '
                <div class="link-item '.($count === 0 ? "active" : "").'" 
                     onclick="playHLS(this, \''.$row["title"].'\', \''.$row["stream_url"].'\')">
                    <span><i class="fas fa-play-circle"></i> '.$row["title"].'</span> 
                    <small>'.$row["status"].'</small>
                </div>';
                $count++;
            }
        } else {
            echo "<p>No matches scheduled for today.</p>";
        }
        ?>
    </div>

    <button class="telegram-btn" onclick="window.open('https://t.me/yourchannel','_blank')">
        <i class="fab fa-telegram"></i> Join Telegram for Live Updates
    </button>
</div>

<script>
let hls;
const video = document.getElementById('video');

function playHLS(element, title, url){
    document.getElementById("matchTitle").innerText = title;

    if(hls) hls.destroy();

    if(video.canPlayType('application/vnd.apple.mpegurl')){
        video.src = url;
    } else if(Hls.isSupported()){
        hls = new Hls();
        hls.loadSource(url);
        hls.attachMedia(video);
    }

    document.querySelectorAll(".link-item").forEach(i=>i.classList.remove("active"));
    element.classList.add("active");
    window.scrollTo({ top: 150, behavior: 'smooth' });
}

// Auto-play first match from PHP data
window.onload = () => {
    <?php if($firstMatch): ?>
        const firstElem = document.querySelector('.link-item.active');
        playHLS(firstElem, '<?php echo $firstMatch["title"]; ?>', '<?php echo $firstMatch["stream_url"]; ?>');
    <?php endif; ?>
};
</script>

</body>
</html>