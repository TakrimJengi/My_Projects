<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ligue 1 Live HD | Football À La Française</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <style>
        /* CSS remains identical to your design */
        *{ margin:0; padding:0; box-sizing:border-box; font-family: 'Inter', 'Segoe UI', sans-serif; }
        body{ background:#0a0e1a; color:#fff; }
        header{ background:#111827; color:#fff; padding:15px 5%; display:flex; justify-content:space-between; align-items:center; border-bottom: 4px solid #daff00; }
        header strong{ font-size:24px; letter-spacing: 1px; text-transform: uppercase; font-weight: 900; }
        header strong span { color: #daff00; }
        header ul{ list-style:none; display:flex; gap:20px; }
        .nav-link { text-decoration: none; color: #94a3b8; font-weight: 600; font-size: 13px; text-transform: uppercase; }
        .nav-link.active { color: #daff00; }
        .updates-bar{ background: #daff00; color:#0a0e1a; padding:10px; font-size:13px; text-align: center; font-weight: 800; text-transform: uppercase; }
        .player-container{ max-width:1100px; margin:30px auto; background:#000; border-radius:12px; overflow:hidden; box-shadow: 0 0 30px rgba(218, 255, 0, 0.1); border: 1px solid #1e293b; }
        .live-title{ background:#1e293b; color:#fff; padding:15px 20px; display:flex; align-items:center; gap:12px; font-weight:bold; font-size:16px; }
        .live-dot{ width:12px; height:12px; background:#ff4d4d; border-radius:50%; animation:blink 1.2s infinite; }
        @keyframes blink{ 50%{opacity:.2} }
        .video-box{ background:#000; position: relative; padding-top: 56.25%; }
        video{ position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
        .links-section{ max-width:1100px; margin:20px auto; background:#111827; padding:25px; border-radius:12px; border: 1px solid #1e293b; }
        .links-section h3{ margin-bottom:20px; color:#daff00; font-size: 20px; display: flex; align-items: center; gap: 10px; }
        #matchLinks { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; }
        .link-item{ padding:15px; border:1px solid #1e293b; background: #0f172a; cursor:pointer; font-size:15px; border-radius:8px; display: flex; align-items: center; justify-content: space-between; transition: .3s; }
        .link-item:hover{ border-color: #daff00; background: #1e293b; }
        .link-item.active{ background: #daff00; color:#0a0e1a; border-color:#daff00; font-weight: 800; }
        .telegram-btn{ margin-top:25px; width:100%; padding:15px; background:#0088cc; color:#fff; border:none; font-size:16px; font-weight: bold; cursor:pointer; border-radius:8px; text-transform: uppercase; }
    </style>
</head>

<body>

<header>
    <strong>LIGUE <span>1</span></strong>
    <nav>
        <ul>
            <li><a href="index.php" class="nav-link">Home</a></li>
            <li><a href="ligue1.php" class="nav-link active">Ligue 1</a></li>
            <li><a href="LiveSportsTv.php" class="nav-link">Sports TV</a></li>
            <li><a href="football.php" class="nav-link">Live Score</a></li>
        </ul>
    </nav>
</header>

<div class="updates-bar">
    <marquee scrollamount="8">Ligue 1 McDonald's LIVE: PSG, Marseille, Lyon, Monaco and Lille in High Definition.</marquee>
</div>

<div class="player-container">
    <div class="live-title">
        <span class="live-dot"></span>
        <span id="matchTitle">Regarder la Ligue 1...</span>
    </div>

    <div class="video-box">
        <video id="video" controls autoplay playsinline></video>
    </div>
</div>

<div class="links-section">
    <h3><i class="fas fa-flag"></i> Championnat de France Live</h3>
    <div id="matchLinks">
        <?php
        $sql = "SELECT * FROM ligue1_streams WHERE is_active = 1 ORDER BY id ASC";
        $result = $conn->query($sql);
        $firstMatch = null;

        if ($result->num_rows > 0) {
            $count = 0;
            while($row = $result->fetch_assoc()) {
                if ($count === 0) $firstMatch = $row;
                echo '
                <div class="link-item '.($count === 0 ? "active" : "").'" 
                     onclick="playHLS(this, \''.$row["match_title"].'\', \''.$row["stream_url"].'\')">
                    <span><i class="fas fa-play"></i> '.$row["match_title"].'</span> 
                    <small>'.$row["quality"].'</small>
                </div>';
                $count++;
            }
        } else {
            echo "<p>No matches available right now.</p>";
        }
        ?>
    </div>

    <button class="telegram-btn" onclick="window.open('https://t.me/yourchannel','_blank')">
        <i class="fab fa-telegram"></i> Join Telegram for Ligue 1 Links
    </button>
</div>

<footer>
    <p>© 2026 RandomSports – L'adrénaline du football français</p>
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
    <?php if($firstMatch): ?>
        playHLS(document.querySelector('.link-item.active'), '<?php echo $firstMatch["match_title"]; ?>', '<?php echo $firstMatch["stream_url"]; ?>');
    <?php endif; ?>
};
</script>

</body>
</html>