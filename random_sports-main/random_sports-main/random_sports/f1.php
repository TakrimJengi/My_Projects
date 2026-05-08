<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Live HD | Formula 1 World Championship</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <style>
        /* CSS Unchanged from your original sharp design */
        *{ margin:0; padding:0; box-sizing:border-box; font-family: 'Titillium Web', 'Segoe UI', sans-serif; }
        body{ background:#0b0b0b; color:#fff; }
        header{ background:#15151e; padding:15px 5%; display:flex; justify-content:space-between; align-items:center; border-bottom: 3px solid #e10600; }
        header strong{ font-size:24px; letter-spacing: 2px; font-weight: 900; }
        header strong span { color: #e10600; }
        header ul{ list-style:none; display:flex; gap:20px; }
        .nav-link { text-decoration: none; color: #ccc; font-weight: 600; font-size: 13px; text-transform: uppercase; }
        .nav-link.active { color: #e10600; }
        .updates-bar{ background: #e10600; color:#fff; padding:10px; font-size:14px; text-align: center; font-weight: bold; text-transform: uppercase; }
        .player-container{ max-width:1100px; margin:30px auto; background:#000; overflow:hidden; box-shadow: 0 10px 40px rgba(225, 6, 0, 0.15); border: 1px solid #333; }
        .live-title{ background:#15151e; padding:15px 20px; display:flex; align-items:center; gap:12px; font-weight:bold; border-left: 5px solid #e10600; }
        .live-dot{ width:12px; height:12px; background:#ff0000; border-radius:50%; animation:blink 0.8s infinite; }
        @keyframes blink{ 50%{opacity:.3} }
        .video-box{ position: relative; padding-top: 56.25%; background:#000; }
        video{ position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
        .links-section{ max-width:1100px; margin:20px auto; background:#15151e; padding:25px; border: 1px solid #333; }
        #matchLinks { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; }
        .link-item{ padding:15px; border:1px solid #333; background: #000; cursor:pointer; font-size:15px; display: flex; align-items: center; justify-content: space-between; }
        .link-item:hover, .link-item.active { border-color: #e10600; background: #111; }
        .link-item.active { background: #e10600; color:#fff; font-weight: bold; }
        .telegram-btn{ margin-top:25px; width:100%; padding:15px; background:#0088cc; color:#fff; border:none; font-weight: bold; cursor:pointer; text-transform: uppercase; }
    </style>
</head>
<body>

<header>
    <strong>FORMULA <span>1</span></strong>
    <nav>
        <ul>
            <li><a href="index.php" class="nav-link">Home</a></li>
            <li><a href="f1.php" class="nav-link active">F1 Racing</a></li>
            <li><a href="LiveSportsTv.php" class="nav-link">Sports TV</a></li>
            <li><a href="worldcup2026.php" class="nav-link">World Cup</a></li>
        </ul>
    </nav>
</header>

<div class="updates-bar">
    <marquee scrollamount="10">LIVE: FORMULA 1 WORLD CHAMPIONSHIP — Grand Prix Main Race — WATCH IN ULTRA HD 60FPS</marquee>
</div>

<div class="player-container">
    <div class="live-title">
        <span class="live-dot"></span>
        <span id="matchTitle">Select a Session</span>
    </div>
    <div class="video-box">
        <video id="video" controls autoplay playsinline></video>
    </div>
</div>

<div class="links-section">
    <h3><i class="fas fa-tachometer-alt"></i> F1 Session Live</h3>
    <div id="matchLinks">
        <?php
        $sql = "SELECT * FROM f1_streams WHERE is_active = 1 ORDER BY id ASC";
        $result = $conn->query($sql);
        $firstStream = null;

        if ($result->num_rows > 0) {
            $count = 0;
            while($row = $result->fetch_assoc()) {
                if ($count === 0) $firstStream = $row;
                echo '
                <div class="link-item '.($count === 0 ? "active" : "").'" 
                     onclick="playHLS(this, \''.$row["title"].'\', \''.$row["stream_url"].'\')">
                    <span><i class="fas fa-flag-checkered"></i> '.$row["title"].'</span> 
                    <small>'.$row["quality"].'</small>
                </div>';
                $count++;
            }
        } else {
            echo "<p>No sessions available.</p>";
        }
        ?>
    </div>
    <button class="telegram-btn" onclick="window.open('https://t.me/yourchannel','_blank')">
        <i class="fab fa-telegram"></i> Get Racing Links on Telegram
    </button>
</div>

<footer>
    <p>© 2026 RandomSports – Speed. Power. Precision.</p>
</footer>

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
}

window.onload = () => {
    <?php if($firstStream): ?>
        playHLS(document.querySelector('.link-item.active'), '<?php echo $firstStream["title"]; ?>', '<?php echo $firstStream["stream_url"]; ?>');
    <?php endif; ?>
};
</script>
</body>
</html>