<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Channel 24 Live | RandomSports HD</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <style>
        :root { 
            --primary-red: #ff3b3b; 
            --c24-blue: #00a0e9; /* Channel 24 Signature Blue */
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
        .nav-links a:hover { color: var(--primary-red); }

        /* LIVE SCROLL BAR */
        .live-bar { background: var(--primary-red); color: white; padding: 8px 0; text-align: center; font-size: 13px; font-weight: bold; }

        /* PLAYER AREA */
        .main-content { max-width: 1000px; margin: 30px auto; padding: 0 20px; }

        .player-wrapper { 
            background: #000; 
            border-radius: 12px; 
            overflow: hidden; 
            box-shadow: 0 10px 40px rgba(0,0,0,0.6); 
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

        /* INFO SECTION */
        .channel-info { margin-top: 25px; background: var(--card-bg); padding: 25px; border-radius: 12px; border: 1px solid #333; }
        .channel-info h2 { color: var(--c24-blue); margin-bottom: 12px; display: flex; align-items: center; gap: 10px; }
        .channel-info p { color: var(--text-dim); font-size: 14.5px; line-height: 1.7; }

        .btn-group { display: flex; gap: 15px; margin-top: 20px; }
        .social-btn { flex: 1; padding: 12px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: bold; color: #fff; font-size: 14px; transition: 0.3s; }
        .tg-btn { background: #0088cc; }
        .fb-btn { background: #1877f2; }
        .social-btn:hover { opacity: 0.8; transform: translateY(-2px); }

        footer { text-align: center; padding: 40px; color: #555; font-size: 12px; }
    </style>
</head>
<body>

<header>
    <div class="logo"><strong>Random<span>Sports</span></strong></div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="LiveSportsTv.php">Sports TV</a></li>
        <li><a href="highlights.php">Highlights</a></li>
    </ul>
</header>

<div class="live-bar">
    <marquee scrollamount="7">Watching Channel 24 Live HD • Journalism for the People • High Quality Streaming</marquee>
</div>

<div class="main-content">
    <div class="player-wrapper">
        <div class="player-header">
            <div style="display: flex; align-items: center; gap: 12px;">
                <span class="live-badge">LIVE</span>
                <span style="font-weight: 800; text-transform: uppercase;">Channel 24 HD</span>
            </div>
            <i class="fas fa-broadcast-tower" style="color: var(--c24-blue);"></i>
        </div>
        <div class="video-container">
            <video id="video" controls autoplay playsinline poster="channel24_poster.jpg"></video>
        </div>
    </div>

    <div class="channel-info">
        <h2><i class="fas fa-layer-group"></i> Channel 24 Bangladesh</h2>
        <p>Channel 24 is one of the most respected news and entertainment channels in Bangladesh. Known for its sophisticated presentation and neutral reporting, it provides 24/7 news coverage, sports analysis, and business updates. Watch the crystal-clear stream here on RandomSports.</p>
        
        <div class="btn-group">
            <a href="https://t.me/yourchannel" class="social-btn tg-btn"><i class="fab fa-telegram"></i> Join Telegram</a>
            <a href="#" class="social-btn fb-btn"><i class="fab fa-facebook"></i> Follow Us</a>
        </div>
    </div>
</div>

<footer>
    &copy; 2026 RandomSports | Your Premium Live TV Destination
</footer>

<script>
    const video = document.getElementById('video');
    // Ekhane Channel 24-er original m3u8 stream link-ti bosaun
    const streamURL = "https://your-channel24-stream-link.m3u8"; 

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