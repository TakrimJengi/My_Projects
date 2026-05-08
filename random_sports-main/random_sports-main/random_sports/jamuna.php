<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamuna TV Live | RandomSports HD Portal</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <style>
        :root { 
            --primary-red: #ff3b3b; 
            --jamuna-yellow: #f1c40f;
            --dark-bg: #0f1014; 
            --card-bg: #1a1c23; 
            --white: #ffffff; 
            --text-dim: #a0a0a0;
        }

        * { margin:0; padding:0; box-sizing:border-box; font-family: 'Poppins', sans-serif; }
        
        body { background-color: var(--dark-bg); color: var(--white); }

        /* HEADER */
        header { 
            background: #000; 
            padding: 15px 5%; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 2px solid var(--primary-red); 
        }
        header strong { font-size: 26px; font-weight: 800; letter-spacing: -1px; }
        header strong span { color: var(--primary-red); }

        .nav-links { display: flex; gap: 20px; list-style: none; }
        .nav-links a { text-decoration: none; color: var(--text-dim); font-weight: 600; font-size: 14px; transition: 0.3s; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary-red); }

        /* LIVE BAR */
        .live-bar { background: var(--primary-red); color: white; padding: 8px 0; text-align: center; font-size: 13px; font-weight: bold; }

        /* PLAYER AREA */
        .main-content { max-width: 1000px; margin: 30px auto; padding: 0 20px; }

        .player-wrapper { 
            background: #000; 
            border-radius: 12px; 
            overflow: hidden; 
            box-shadow: 0 15px 40px rgba(0,0,0,0.6); 
            border: 1px solid #333;
        }

        .player-header { 
            background: var(--card-bg); 
            padding: 15px 20px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }

        .live-badge { 
            background: var(--primary-red); 
            padding: 4px 12px; 
            border-radius: 4px; 
            font-size: 11px; 
            font-weight: 900; 
            animation: pulse 1.5s infinite; 
        }
        
        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.5; } 100% { opacity: 1; } }

        .video-container { position: relative; padding-top: 56.25%; background: #000; }
        video { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }

        /* CHANNEL DETAILS */
        .channel-details { margin-top: 25px; background: var(--card-bg); padding: 20px; border-radius: 12px; border: 1px solid #333; }
        .channel-details h2 { color: var(--jamuna-yellow); margin-bottom: 10px; display: flex; align-items: center; gap: 10px; }
        .channel-details p { color: var(--text-dim); font-size: 14px; line-height: 1.6; }

        /* ACTION BUTTONS */
        .action-btns { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 20px; }
        .btn { padding: 12px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center; text-decoration: none; font-size: 14px; transition: 0.3s; }
        .btn-tg { background: #0088cc; color: white; }
        .btn-app { background: var(--primary-red); color: white; }
        .btn:hover { opacity: 0.9; transform: translateY(-2px); }

        footer { text-align: center; padding: 40px; color: #444; font-size: 12px; }
    </style>
</head>
<body>

<header>
    <div class="logo"><strong>Random<span>Sports</span></strong></div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="LiveSportsTv.php" class="active">Sports TV</a></li>
        <li><a href="highlights.php">Highlights</a></li>
    </ul>
</header>

<div class="live-bar">
    <marquee scrollamount="7">Watching Jamuna Television Live HD • Authentic News Source • Real-Time Updates</marquee>
</div>

<div class="main-content">
    <div class="player-wrapper">
        <div class="player-header">
            <div style="display: flex; align-items: center; gap: 12px;">
                <span class="live-badge">LIVE</span>
                <span style="font-weight: 800; letter-spacing: 0.5px;">JAMUNA TV HD</span>
            </div>
            <i class="fas fa-video" style="color: var(--jamuna-yellow);"></i>
        </div>
        <div class="video-container">
            <video id="video" controls autoplay playsinline poster="jamuna_poster.jpg"></video>
        </div>
    </div>

    <div class="channel-details">
        <h2><i class="fas fa-check-circle"></i> Jamuna Television</h2>
        <p>Jamuna Television is a popular 24-hour news channel in Bangladesh, known for its bold and investigative journalism. Stream Jamuna TV live in high definition on RandomSports for the latest updates on politics, economy, and sports.</p>
        
        <div class="action-btns">
            <a href="https://t.me/yourchannel" target="_blank" class="btn btn-tg"><i class="fab fa-telegram-plane"></i> Join Telegram</a>
            <a href="#" class="btn btn-app"><i class="fab fa-android"></i> Download App</a>
        </div>
    </div>
</div>

<footer>
    &copy; 2026 RandomSports | Powered by High-Speed CDN
</footer>

<script>
    const video = document.getElementById('video');
    // Ekhane Jamuna TV-r original m3u8 link-ti boshale-i kaj korbe
    const streamURL = "https://your-jamuna-stream-link.m3u8"; 

    if (Hls.isSupported()) {
        const hls = new Hls();
        hls.loadSource(streamURL);
        hls.attachMedia(video);
    } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
        video.src = streamURL;
    }
</script>

</body>
</html>