<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Highlights | RandomSports Hub</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        /* SOKOL CSS CODE TUMI JA DIYECHO TA EKHANE THAKBE (Unchanged) */
        :root { --primary: #00a859; --secondary: #00529b; --bg: #0b0d17; --surface: #161b22; --card-bg: #1c2128; --accent: #ff0000; --text: #ffffff; --text-dim: #8b949e; }
        * { margin:0; padding:0; box-sizing:border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg); color: var(--text); }
        .navbar { background: rgba(0, 0, 0, 0.9); padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid var(--secondary); position: sticky; top: 0; z-index: 1000; backdrop-filter: blur(10px); }
        .logo { font-size: 24px; font-weight: 800; text-decoration: none; color: #fff; }
        .logo span { color: var(--primary); }
        .nav-links a { color: #fff; text-decoration: none; margin-left: 20px; font-weight: 600; font-size: 14px; transition: 0.3s; }
        .hero { background: linear-gradient(rgba(11, 13, 23, 0.8), rgba(11, 13, 23, 0.8)), url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=1200'); background-size: cover; background-position: center; padding: 60px 20px; text-align: center; border-bottom: 1px solid var(--surface); }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .grid-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .highlights-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px; }
        .video-card { background: var(--card-bg); border-radius: 12px; overflow: hidden; border: 1px solid #2a2e35; transition: 0.4s; cursor: pointer; }
        .video-card:hover { transform: translateY(-5px); border-color: var(--primary); }
        .thumbnail-box { position: relative; width: 100%; padding-top: 56.25%; }
        .thumbnail-box img { position: absolute; top:0; left:0; width: 100%; height: 100%; object-fit: cover; }
        .play-btn { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 40px; color: rgba(255, 255, 255, 0.8); transition: 0.3s; }
        .video-info { padding: 15px; }
        .video-title { font-size: 15px; font-weight: 700; margin-bottom: 8px; line-height: 1.4; height: 42px; overflow: hidden; }
        .video-meta { font-size: 12px; color: var(--text-dim); display: flex; justify-content: space-between; }
        .modal { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.95); align-items: center; justify-content: center; }
        .modal-content { width: 90%; max-width: 900px; position: relative; }
        .close-modal { position: absolute; top: -40px; right: 0; color: #fff; font-size: 30px; cursor: pointer; }
        .iframe-container { position: relative; padding-top: 56.25%; }
        .iframe-container iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border-radius: 8px; }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="index.php" class="logo">Random<span>Sports</span></a>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="football.php">Live Score</a>
        <a href="LiveSportsTv.php">Live Stream</a>
    </div>
</nav>

<div class="hero">
    <h1>Match Highlights</h1>
    <p>Watch latest goals and highlights from all top leagues around the world.</p>
</div>

<div class="container">
    <div class="grid-header">
        <h2>Latest Uploads</h2>
        <span style="font-size: 12px; color: var(--primary); font-weight: bold;"><i class="fas fa-sync-alt"></i> Auto-Updated</span>
    </div>

    <div id="highlights-list" class="highlights-grid">
        <?php
        $sql = "SELECT * FROM highlights_custom ORDER BY created_at DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '
                <div class="video-card" onclick="openPlayer(\''.$row["youtube_id"].'\')">
                    <div class="thumbnail-box">
                        <img src="'.$row["thumbnail_url"].'">
                        <div class="play-btn"><i class="fas fa-play-circle"></i></div>
                    </div>
                    <div class="video-info">
                        <div class="video-title">'.$row["title"].'</div>
                        <div class="video-meta">
                            <span><i class="fas fa-user"></i> '.$row["channel_name"].'</span>
                            <span><i class="far fa-calendar-alt"></i> '.date('M d, Y', strtotime($row["created_at"])).'</span>
                        </div>
                    </div>
                </div>';
            }
        }
        ?>
        </div>
</div>

<div id="videoModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div class="iframe-container">
            <iframe id="youtubePlayer" src="" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>

<footer>
    <p style="text-align: center; padding: 40px; color: var(--text-dim); font-size: 12px;">&copy; 2026 RandomSports | Powered by YouTube Data Engine</p>
</footer>

<script>
    const YT_API_KEY = "YOUR_YOUTUBE_API_KEY_HERE"; 
    const query = "football highlights 2026 goals";

    async function fetchHighlights() {
        if(YT_API_KEY === "YOUR_YOUTUBE_API_KEY_HERE") return;

        const url = `https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=8&q=${encodeURIComponent(query)}&type=video&order=date&key=${YT_API_KEY}`;

        try {
            const response = await fetch(url);
            const data = await response.json();
            if(data.items) {
                renderVideos(data.items);
            }
        } catch (error) {
            console.error("YouTube Error:", error);
        }
    }

    function renderVideos(videos) {
        const list = document.getElementById('highlights-list');
        videos.forEach(v => {
            const videoId = v.id.videoId;
            const title = v.snippet.title;
            const thumb = v.snippet.thumbnails.high.url;
            const channel = v.snippet.channelTitle;
            const date = new Date(v.snippet.publishedAt).toLocaleDateString();

            const card = document.createElement('div');
            card.className = 'video-card';
            card.innerHTML = `
                <div class="thumbnail-box">
                    <img src="${thumb}">
                    <div class="play-btn"><i class="fas fa-play-circle"></i></div>
                </div>
                <div class="video-info">
                    <div class="video-title">${title}</div>
                    <div class="video-meta">
                        <span><i class="fas fa-user"></i> ${channel}</span>
                        <span><i class="far fa-calendar-alt"></i> ${date}</span>
                    </div>
                </div>
            `;
            card.onclick = () => openPlayer(videoId);
            list.appendChild(card);
        });
    }

    const modal = document.getElementById('videoModal');
    const iframe = document.getElementById('youtubePlayer');
    const closeBtn = document.querySelector('.close-modal');

    function openPlayer(id) {
        iframe.src = `https://www.youtube.com/embed/${id}?autoplay=1`;
        modal.style.display = "flex";
    }

    closeBtn.onclick = () => { modal.style.display = "none"; iframe.src = ""; };
    window.onclick = (e) => { if (e.target == modal) { modal.style.display = "none"; iframe.src = ""; } };

    fetchHighlights();
</script>

</body>
</html>