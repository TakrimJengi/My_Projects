<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premier League – Live HD | The Best League in the World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <style>
        /* CSS remains identical to your design */
        *{ margin:0; padding:0; box-sizing:border-box; font-family: 'Segoe UI', sans-serif; }
        body{ background:#38003c; color:#fff; }
        header{ background:#ffffff; color:#38003c; padding:15px 5%; display:flex; justify-content:space-between; align-items:center; border-bottom: 4px solid #00ff85; }
        header strong{ font-size:24px; letter-spacing: 1px; display: flex; align-items: center; gap: 10px; }
        header strong span { color: #38003c; font-weight: 800; }
        header ul{ list-style:none; display:flex; gap:20px; }
        .nav-link { text-decoration: none; color: #38003c; font-weight: 700; font-size: 14px; text-transform: uppercase; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: #00ff85; background: #38003c; padding: 5px 10px; border-radius: 5px; }
        .updates-bar{ background: #00ff85; color:#38003c; padding:10px; font-size:14px; text-align: center; font-weight: bold; }
        .player-container{ max-width:1100px; margin:30px auto; background:#000; border-radius:20px; overflow:hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.6); border: 1px solid #4e0052; }
        .live-title{ background:#ffffff; color:#38003c; padding:15px 20px; display:flex; align-items:center; gap:12px; font-weight:800; font-size:16px; }
        .live-dot{ width:12px; height:12px; background:#ff005a; border-radius:50%; animation:blink 1s infinite; }
        @keyframes blink{ 50%{opacity:.3} }
        .video-box{ position: relative; padding-top: 56.25%; background:#000; }
        video{ position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
        .links-section{ max-width:1100px; margin:20px auto; background:#4e0052; padding:25px; border-radius:20px; }
        .links-section h3{ margin-bottom:20px; color:#00ff85; font-size: 22px; display: flex; align-items: center; gap: 10px; }
        #matchLinks { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; }
        .link-item{ padding:15px; border:2px solid #38003c; background: #ffffff; color: #38003c; cursor:pointer; font-size:15px; font-weight: 700; border-radius:12px; display: flex; align-items: center; justify-content: space-between; transition:.3s; }
        .link-item:hover { transform: scale(1.03); border-color: #00ff85; }
        .link-item.active { background:#00ff85; color:#38003c; border-color:#00ff85; }
        .telegram-btn{ margin-top:25px; width:100%; padding:15px; background:#0088cc; color:#fff; border:none; font-weight: bold; cursor:pointer; border-radius:12px; transition: 0.3s; }
    </style>
</head>
<body>

<header>
    <strong><i class="fas fa-crown"></i> PREMIER <span>LEAGUE</span></strong>
    <nav>
        <ul>
            <li><a href="index.php" class="nav-link">Home</a></li>
            <li><a href="epl.php" class="nav-link active">Premier League</a></li>
            <li><a href="LiveSportsTv.php" class="nav-link">Sports TV</a></li>
            <li><a href="football.php" class="nav-link">Live Score</a></li>
        </ul>
    </nav>
</header>

<div class="updates-bar">
    <marquee scrollamount="8">Matchday Live: Watch Manchester City, Liverpool, Arsenal, Manchester United and more in 4K Quality.</marquee>
</div>

<div class="player-container">
    <div class="live-title">
        <span class="live-dot"></span>
        <span id="matchTitle">Selecting Premier League Match...</span>
    </div>
    <div class="video-box">
        <video id="video" controls autoplay playsinline></video>
    </div>
</div>

<div class="links-section">
    <h3><i class="fas fa-trophy"></i> PL Live Action</h3>
    <div id="matchLinks">
        <?php
        $sql = "SELECT * FROM epl_streams WHERE is_active = 1 ORDER BY id ASC";
        $result = $conn->query($sql);
        $firstMatch = null;

        if ($result->num_rows > 0) {
            $count = 0;
            while($row = $result->fetch_assoc()) {
                if ($count === 0) $firstMatch = $row;
                echo '
                <div class="link-item '.($count === 0 ? "active" : "").'" 
                     onclick="playHLS(this, \''.$row["match_title"].'\', \''.$row["stream_url"].'\')">
                    <span><i class="fas fa-bolt"></i> '.$row["match_title"].'</span> 
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
        <i class="fab fa-telegram"></i> Get PL Links on Telegram
    </button>
</div>

<footer>
    <p>© 2026 RandomSports – No. 1 Home for Premier League Fans</p>
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