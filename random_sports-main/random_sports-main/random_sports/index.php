<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RandomSports | Real-Time Hub & Live TV</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <style>
        /* SOKOL CSS CODE TUMI JA DIYECHO TA EKHANE THAKBE (Unchanged) */
        :root { --primary: #00a859; --secondary: #00529b; --bg: #0b0d17; --surface: #161b22; --card-bg: #1c2128; --accent: #ff0000; --text: #ffffff; --text-dim: #8b949e; --border: #30363d; }
        * { margin:0; padding:0; box-sizing:border-box; font-family: 'Outfit', sans-serif; }
        body { background-color: var(--bg); color: var(--text); overflow-x: hidden; }
        .ticker-wrap { background: #000; padding: 10px 0; border-bottom: 1px solid var(--border); overflow: hidden; white-space: nowrap; }
        .ticker-move { display: inline-flex; animation: ticker 40s linear infinite; }
        .ticker-item { padding: 0 40px; font-size: 13px; font-weight: 600; border-right: 1px solid #333; display: flex; align-items: center; gap: 10px; }
        .live-dot { width: 8px; height: 8px; background: var(--accent); border-radius: 50%; animation: pulse 1.5s infinite; }
        @keyframes ticker { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        @keyframes pulse { 50% { opacity: 0.3; } }
        .header { background: rgba(22, 27, 34, 0.95); backdrop-filter: blur(12px); padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 1000; }
        .logo { font-size: 26px; font-weight: 800; text-decoration: none; color: #fff; letter-spacing: -1px; }
        .logo span { color: var(--primary); }
        .nav-menu { display: flex; gap: 20px; align-items: center; }
        .nav-menu a { color: var(--text-dim); text-decoration: none; font-weight: 600; font-size: 14px; text-transform: uppercase; transition: 0.3s; }
        .nav-menu a:hover, .nav-menu a.active { color: var(--primary); }
        .nav-menu a.live-btn { background: var(--accent); color: #fff; padding: 8px 15px; border-radius: 6px; display: flex; align-items: center; gap: 8px; }
        .main-container { display: grid; grid-template-columns: 280px 1fr 300px; gap: 25px; max-width: 1450px; margin: 30px auto; padding: 0 20px; }
        .widget { background: var(--surface); border-radius: 16px; padding: 20px; border: 1px solid var(--border); margin-bottom: 25px; }
        .widget-title { font-size: 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; color: var(--primary); }
        .score-card { background: #0d1117; padding: 15px; border-radius: 10px; margin-bottom: 12px; border-left: 4px solid var(--primary); transition: 0.3s; }
        .hero-banner { position: relative; height: 380px; border-radius: 20px; overflow: hidden; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .hero-banner img { width: 100%; height: 100%; object-fit: cover; }
        .hero-info { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.95)); padding: 40px; }
        .news-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .news-card { background: var(--card-bg); border-radius: 12px; overflow: hidden; border: 1px solid var(--border); transition: 0.3s; }
        .news-card img { width: 100%; height: 180px; object-fit: cover; }
        .news-content { padding: 18px; }
        .tag { background: var(--secondary); font-size: 10px; padding: 4px 10px; border-radius: 4px; font-weight: 800; }
        @media (max-width: 1150px) { .main-container { grid-template-columns: 1fr; } .sidebar, .rightbar { display: none; } .news-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<div class="ticker-wrap">
    <div class="ticker-move" id="scoreTicker">
        <div class="ticker-item"><div class="live-dot"></div> SYNCING LIVE SPORTS...</div>
    </div>
</div>

<header class="header">
    <a href="index.php" class="logo">Random<span>Sports</span></a>
    <nav class="nav-menu">
        <a href="index.php" class="active">Home</a>
        <a href="football.php">Football</a>
        <a href="LiveSportsTv.php" class="live-btn"><i class="fas fa-play-circle"></i> Live TV</a>
        <a href="worldcup2026.php">World Cup</a>
    </nav>
    <div style="font-size: 20px; cursor: pointer; color: var(--primary);"><i class="fas fa-search"></i></div>
</header>

<div class="main-container">
    
    <aside class="sidebar">
        <div class="widget">
            <h3 class="widget-title"><i class="fas fa-satellite-dish"></i> Live Scoreboard</h3>
            <div id="sidebarScores">
                <p style="color:var(--text-dim); font-size:12px; text-align:center;">Synchronizing scores...</p>
            </div>
        </div>
        
        <div class="widget" style="background: linear-gradient(135deg, #161b22, #00529b);">
            <h4 style="font-size: 14px;">WC 2026 Countdown</h4>
            <h2 id="countdown" style="margin: 10px 0; color: var(--primary); font-size: 28px;">000 Days</h2>
            <p style="font-size: 11px; opacity: 0.8;">Road to USA, Canada & Mexico</p>
        </div>
    </aside>

    <main class="content">
        <div class="hero-banner">
            <img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&q=80&w=1200" alt="hero">
            <div class="hero-info">
                <span class="tag">TOP STORY</span>
                <h1 style="margin-top:15px; font-size: 32px; font-weight: 800;">Real Madrid's Strategy for the 2026 Season Revealed</h1>
            </div>
        </div>

        <h2 style="margin-bottom: 25px; display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-newspaper" style="color:var(--primary)"></i> Latest News
        </h2>
        
        <div class="news-grid">
            <?php
            $sql = "SELECT * FROM news ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '
                    <div class="news-card">
                        <img src="'.$row["image_url"].'" alt="news">
                        <div class="news-content">
                            <span class="tag">'.$row["tag"].'</span>
                            <h4 style="margin-top:12px;">'.$row["title"].'</h4>
                            <p style="font-size:12px; color:var(--text-dim); margin-top:8px;">'.$row["description"].'</p>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No news found in database.</p>";
            }
            ?>
        </div>
    </main>

    <aside class="rightbar">
        <div class="widget">
            <h3 class="widget-title"><i class="fas fa-fire"></i> Trending Topics</h3>
            <div id="trendingTopics">
                <div style="padding:12px 0; border-bottom:1px solid #333; font-size:14px;">
                    <a href="#" style="color:#fff; text-decoration:none; font-weight:600;">Mbappé's impact on La Liga viewership</a>
                </div>
            </div>
        </div>
        
        <div class="widget" style="text-align: center; border: 2px solid var(--primary);">
            <i class="fas fa-mobile-alt" style="font-size: 40px; color: var(--primary); margin-bottom: 15px;"></i>
            <h4>RandomSports Pro</h4>
            <p style="font-size:12px; margin:10px 0; color:var(--text-dim);">Get instant goal alerts directly on your phone.</p>
            <button style="width:100%; padding:12px; background:var(--primary); color:#fff; border:none; border-radius:8px; font-weight:bold; cursor:pointer;">GET THE APP</button>
        </div>
    </aside>

</div>

<script>
    // Live Scores API logic remains in JS for real-time updates without page reload
    const API_KEY = "YOUR_API_KEY_HERE"; 
    const HEADERS = { "x-rapidapi-host": "v3.football.api-sports.io", "x-rapidapi-key": API_KEY };

    async function fetchLiveScores() {
        try {
            const response = await fetch("https://v3.football.api-sports.io/fixtures?live=all", { headers: HEADERS });
            const data = await response.json();
            const matches = data.response;

            if (matches && matches.length > 0) {
                updateTicker(matches);
                updateSidebar(matches);
            }
        } catch (e) { console.log("API Offline"); }
    }

    function updateTicker(matches) {
        const ticker = document.getElementById('scoreTicker');
        ticker.innerHTML = matches.map(m => `
            <div class="ticker-item"><div class="live-dot"></div> ${m.teams.home.name} ${m.goals.home} - ${m.goals.away} ${m.teams.away.name} (${m.fixture.status.elapsed}')</div>
        `).join('');
        ticker.innerHTML += ticker.innerHTML; 
    }

    function updateSidebar(matches) {
        const sidebar = document.getElementById('sidebarScores');
        sidebar.innerHTML = matches.slice(0, 5).map(m => `
            <div class="score-card">
                <div style="display:flex; justify-content:space-between; font-size:10px; color:var(--text-dim); margin-bottom:8px;">
                    <span>${m.league.name}</span>
                    <span style="color:var(--accent); font-weight:800;">LIVE ${m.fixture.status.elapsed}'</span>
                </div>
                <div style="display:grid; grid-template-columns: 1fr 30px 1fr; align-items:center; text-align:center;">
                    <span style="font-size:13px; font-weight:600;">${m.teams.home.name}</span>
                    <span style="font-size:18px; font-weight:800; color:var(--primary);">${m.goals.home}-${m.goals.away}</span>
                    <span style="font-size:13px; font-weight:600;">${m.teams.away.name}</span>
                </div>
            </div>
        `).join('');
    }

    function runCountdown() {
        const target = new Date("June 11, 2026 00:00:00").getTime();
        setInterval(() => {
            const now = new Date().getTime();
            const days = Math.floor((target - now) / (1000 * 60 * 60 * 24));
            document.getElementById("countdown").innerText = days + " Days";
        }, 1000);
    }

    window.onload = () => {
        fetchLiveScores();
        runCountdown();
        setInterval(fetchLiveScores, 60000);
    };
</script>

</body>
</html>