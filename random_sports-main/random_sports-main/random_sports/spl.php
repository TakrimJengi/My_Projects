<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saudi Pro League – Live HD | RSL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <style>
        /* CSS remains identical to your design */
        *{ margin:0; padding:0; box-sizing:border-box; font-family: 'Poppins', sans-serif; }
        body{ background:#012e17; color:#fff; }
        header{ background:#004020; color:#fff; padding:15px 5%; display:flex; justify-content:space-between; align-items:center; border-bottom: 3px solid #c9a227; }
        header strong{ font-size:24px; letter-spacing: 1px; text-transform: uppercase; }
        header strong span { color: #c9a227; }
        header ul{ list-style:none; display:flex; gap:20px; }
        .nav-link { text-decoration: none; color: #e0e0e0; font-weight: 600; font-size: 13px; text-transform: uppercase; }
        .nav-link.active { color: #c9a227; }
        .updates-bar{ background: #c9a227; color:#012e17; padding:10px; font-size:14px; text-align: center; font-weight: bold; }
        .player-container{ max-width:1100px; margin:30px auto; background:#000; border-radius:15px; overflow:hidden; border: 1px solid #c9a227; }
        .live-title{ background:#004020; color:#fff; padding:15px 20px; display:flex; align-items:center; gap:12px; font-weight:bold; }
        .live-dot{ width:12px; height:12px; background:#ffcc00; border-radius:50%; animation:blink 1s infinite; box-shadow: 0 0 10px #ffcc00; }
        @keyframes blink{ 50%{opacity:.3} }
        .video-box{ position: relative; padding-top: 56.25%; background:#000; }
        video{ position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
        .links-section{ max-width:1100px; margin:20px auto; background:#004020; padding:25px; border-radius:15px; border: 1px solid #c9a227; }
        #matchLinks { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; }
        .link-item{ padding:15px; border:1px solid rgba(201, 162, 39, 0.3); background: #012e17; cursor:pointer; font-size:15px; border-radius:10px; display: flex; align-items: center; justify-content: space-between; }
        .link-item:hover, .link-item.active { border-color: #c9a227; background: #005a2d; }
        .link-item.active { background: linear-gradient(135deg, #c9a227, #8e6d10); color:#fff; font-weight: bold; }
        .telegram-btn{ margin-top:25px; width:100%; padding:15px; background:#0088cc; color:#fff; border:none; font-weight: bold; cursor:pointer; border-radius:10px; }
    </style>
</head>
<body>

<header>
    <strong>ROSHN <span>SAUDI LEAGUE</span></strong>
    <nav>
        <ul>
            <li><a href="index.php" class="nav-link">Home</a></li>
            <li><a href="spl.php" class="nav-link active">RSL</a></li>
            <li><a href="LiveSportsTv.php" class="nav-link">Sports TV</a></li>
            <li><a href="worldcup2026.php" class="nav-link">World Cup</a></li>
        </ul>
    </nav>
</header>

<div class="updates-bar">
    <marquee scrollamount="8">Watch Cristiano Ronaldo, Neymar, Benzema and the stars of Roshn Saudi League Live in Ultra HD.</marquee>
</div>

<div class="player-container">
    <div class="live-title">
        <span class="live-dot"></span>
        <span id="matchTitle">Select a Match to Stream</span>
    </div>
    <div class="video-box">
        <video id="video" controls autoplay playsinline></video>
    </div>
</div>

<div class="links-section">
    <h3><i class="fas fa-palm-tree"></i> RSL Matchday - Live Now</h3>
    <div id="matchLinks">
        <?php
        $sql = "SELECT * FROM spl_streams WHERE is_active = 1 ORDER BY id ASC";
        $result = $conn->query($sql);
        $firstMatch = null;

        if ($result->num_rows > 0) {
            $count = 0;
            while($row = $result->fetch_assoc()) {
                if ($count === 0) $firstMatch = $row;
                echo '
                <div class="link-item '.($count === 0 ? "active" : "").'" 
                     onclick="playHLS(this, \''.$row["match_title"].'\', \''.$row["stream_url"].'\')">
                    <span><i class="fas fa-star"></i> '.$row["match_title"].'</span> 
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
        <i class="fab fa-telegram"></i> Join Telegram for RSL Premium Links
    </button>
</div>

<footer>
    <p>© 2026 RandomSports – Experience the Magic of Saudi Football</p>
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