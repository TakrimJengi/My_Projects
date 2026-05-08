<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bundesliga Live HD | German Football</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <style>
        /* CSS Unchanged from your sharp design */
        *{ margin:0; padding:0; box-sizing:border-box; font-family: 'Segoe UI', sans-serif; }
        body{ background:#111; color:#fff; }
        header{ background:#d3010c; color:#fff; padding:15px 5%; display:flex; justify-content:space-between; align-items:center; box-shadow: 0 4px 10px rgba(0,0,0,0.5); }
        header strong{ font-size:24px; letter-spacing: 1px; text-transform: uppercase; }
        header strong span { color: #ffffff; font-weight: 300; }
        header ul{ list-style:none; display:flex; gap:20px; }
        .nav-link { text-decoration: none; color: #fff; opacity: 0.8; font-weight: 600; font-size: 13px; text-transform: uppercase; }
        .nav-link.active { opacity: 1; border-bottom: 2px solid #fff; }
        .updates-bar{ background: #fff; color:#d3010c; padding:10px; font-size:14px; text-align: center; font-weight: 800; text-transform: uppercase; }
        .player-container{ max-width:1100px; margin:30px auto; background:#000; overflow:hidden; box-shadow: 0 10px 30px rgba(211, 1, 12, 0.15); border: 2px solid #d3010c; }
        .live-title{ background:#222; color:#fff; padding:15px 20px; display:flex; align-items:center; gap:12px; font-weight:bold; font-size:16px; border-bottom: 1px solid #333; }
        .live-dot{ width:12px; height:12px; background:#d3010c; border-radius:50%; animation:blink 1s infinite; }
        @keyframes blink{ 50%{opacity:.3} }
        .video-box{ position: relative; padding-top: 56.25%; background:#000; }
        video{ position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
        .links-section{ max-width:1100px; margin:20px auto; background:#1a1a1a; padding:20px; border: 1px solid #333; }
        .links-section h3{ margin-bottom:20px; color:#d3010c; font-size: 20px; display: flex; align-items: center; gap: 10px; text-transform: uppercase; }
        #matchLinks { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; }
        .link-item{ padding:15px; border-left: 5px solid #333; background: #222; cursor:pointer; font-size:15px; display: flex; align-items: center; justify-content: space-between; transition:.3s; }
        .link-item:hover, .link-item.active { border-left-color: #d3010c; background: #2a2a2a; }
        .link-item.active { background: #d3010c; color:#fff; border-left-color:#fff; }
        .telegram-btn{ margin-top:25px; width:100%; padding:15px; background:#0088cc; color:#fff; border:none; font-weight: bold; cursor:pointer; text-transform: uppercase; }
    </style>
</head>
<body>

<header>
    <strong>BUNDES<span>LIGA</span></strong>
    <nav>
        <ul>
            <li><a href="index.php" class="nav-link">Home</a></li>
            <li><a href="LiveSportsTv.php" class="nav-link">Sports TV</a></li>
            <li><a href="bundes.php" class="nav-link active">Bundesliga</a></li>
            <li><a href="football.php" class="nav-link">Scores</a></li>
        </ul>
    </nav>
</header>

<div class="updates-bar">
    <marquee scrollamount="10">LIVE: Bayern Munich, Dortmund, Leverkusen, RB Leipzig - Football as it's meant to be!</marquee>
</div>

<div class="player-container">
    <div class="live-title">
        <span class="live-dot"></span>
        <span id="matchTitle">Selecting Bundesliga Match...</span>
    </div>
    <div class="video-box">
        <video id="video" controls autoplay playsinline></video>
    </div>
</div>

<div class="links-section">
    <h3><i class="fas fa-running"></i> Bundesliga - Matchday Live</h3>
    <div id="matchLinks">
        <?php
        $sql = "SELECT * FROM bundes_streams WHERE is_active = 1 ORDER BY id ASC";
        $result = $conn->query($sql);
        $firstMatch = null;

        if ($result->num_rows > 0) {
            $count = 0;
            while($row = $result->fetch_assoc()) {
                if ($count === 0) $firstMatch = $row;
                echo '
                <div class="link-item '.($count === 0 ? "active" : "").'" 
                     onclick="playHLS(this, \''.$row["match_title"].'\', \''.$row["stream_url"].'\')">
                    <span><i class="fas fa-play-circle"></i> '.$row["match_title"].'</span> 
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
        <i class="fab fa-telegram"></i> Get Bundesliga Links on Telegram
    </button>
</div>

<footer>
    <p>© 2026 RandomSports – Football As It's Meant To Be</p>
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