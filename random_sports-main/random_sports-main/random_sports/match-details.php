<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Centre | RandomSports</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root { --primary: #ff4757; --secondary: #2ed573; --bg: #0f1116; --surface: #1e2128; --text: #ffffff; --text-dim: #a0a0a0; --accent: #3742fa; }
        body { background-color: var(--bg); color: var(--text); font-family: 'Inter', sans-serif; margin: 0; overflow-x: hidden; }
        
        .navbar { background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(10px); padding: 15px 5%; border-bottom: 1px solid #333; position: sticky; top: 0; z-index: 100; }
        .container { max-width: 900px; margin: 20px auto; padding: 0 20px; animation: fadeIn 0.8s ease-out; }
        
        .scoreboard-hero { position: relative; background: linear-gradient(135deg, rgba(225, 6, 0, 0.2) 0%, rgba(55, 66, 250, 0.2) 100%), url('https://images.unsplash.com/photo-1508098682722-e99c43a406b2?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center; border-radius: 30px; padding: 50px 20px; text-align: center; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        
        .league-tag { background: rgba(255, 255, 255, 0.1); padding: 5px 15px; border-radius: 20px; font-size: 11px; font-weight: 700; letter-spacing: 2px; display: inline-block; margin-bottom: 25px; backdrop-filter: blur(5px); text-transform: uppercase; }
        
        .match-flex { display: flex; justify-content: space-around; align-items: center; margin: 20px 0; }
        .team-hero img { width: 80px; height: 80px; object-fit: contain; filter: drop-shadow(0 5px 15px rgba(0,0,0,0.5)); transition: transform 0.3s ease; }
        .team-hero span { display: block; margin-top: 15px; font-size: 16px; font-weight: 800; max-width: 120px; line-height: 1.2; }
        
        .score-hero { font-size: 60px; font-weight: 900; background: linear-gradient(#fff, #999); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; text-shadow: 0 10px 20px rgba(0,0,0,0.3); }
        
        .live-badge { display: inline-flex; align-items: center; gap: 8px; background: var(--primary); padding: 6px 16px; border-radius: 50px; font-size: 12px; font-weight: bold; animation: pulse 2s infinite; }
        
        .details-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 30px; }
        .widget { background: var(--surface); border-radius: 24px; padding: 25px; border: 1px solid rgba(255,255,255,0.05); }
        .widget h3 { margin: 0 0 20px 0; font-size: 16px; display: flex; align-items: center; gap: 10px; color: var(--secondary); text-transform: uppercase; }
        
        .event { display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 13px; gap: 10px; }
        
        .stat-bar-container { margin-bottom: 20px; }
        .stat-info { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 13px; font-weight: 600; }
        .bar-wrap { height: 8px; background: #000; border-radius: 10px; display: flex; overflow: hidden; }
        .h-fill { background: var(--secondary); transition: width 1s ease-in-out; }
        .a-fill { background: var(--primary); transition: width 1s ease-in-out; }
        
        .btn-group { display: flex; gap: 15px; margin-top: 40px; margin-bottom: 50px; }
        .btn { flex: 1; padding: 18px; border-radius: 16px; text-align: center; text-decoration: none; font-weight: 800; text-transform: uppercase; font-size: 14px; }
        .btn-live { background: linear-gradient(45deg, var(--primary), #ff6b81); color: #fff; box-shadow: 0 10px 20px rgba(255, 71, 87, 0.3); }
        .btn-back { background: #222; color: #fff; border: 1px solid #333; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pulse { 0% { opacity: 1; transform: scale(1); } 50% { opacity: 0.8; transform: scale(0.98); } 100% { opacity: 1; transform: scale(1); } }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="index.php" style="color:#fff; text-decoration:none; font-weight:900; font-size: 22px;">
        <i class="fas fa-bolt" style="color:var(--secondary);"></i> RANDOM<span style="color:var(--secondary);">SPORTS</span>
    </a>
</nav>

<div class="container">
    <div class="scoreboard-hero">
        <div class="league-tag" id="league-name">Syncing...</div>
        
        <div class="match-flex">
            <div class="team-hero">
                <img id="h-logo" src="https://via.placeholder.com/80" alt="home">
                <span id="h-name">Home Team</span>
            </div>
            
            <div>
                <div class="score-hero" id="score-main">0 - 0</div>
                <div class="live-badge" id="status-badge">
                    <i class="fas fa-circle" style="font-size: 8px;"></i> <span id="status-text">WAITING</span>
                </div>
            </div>

            <div class="team-hero">
                <img id="a-logo" src="https://via.placeholder.com/80" alt="away">
                <span id="a-name">Away Team</span>
            </div>
        </div>
    </div>

    <div class="details-grid">
        <div class="widget">
            <h3><i class="fas fa-stream"></i> Match Timeline</h3>
            <div id="events-list">
                <p style="color:var(--text-dim); font-size:12px;">Events will appear here...</p>
            </div>
        </div>

        <div class="widget">
            <h3><i class="fas fa-chart-bar"></i> Key Statistics</h3>
            <div id="stats-section">
                <p style="color:var(--text-dim); font-size:12px;">Statistics are synchronizing...</p>
            </div>
        </div>
    </div>

    <div class="btn-group">
        <a href="football.php" class="btn btn-back">Back to Fixtures</a>
        <?php
        $match_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $stream_url = "LiveSportsTv.php?id=$match_id"; 
        
        $stmt = $conn->prepare("SELECT stream_redirection_url FROM match_details WHERE api_match_id = ?");
        $stmt->bind_param("i", $match_id);
        $stmt->execute();
        $res = $stmt->get_result();
        if($row = $res->fetch_assoc()) {
            if(!empty($row['stream_redirection_url'])) $stream_url = $row['stream_redirection_url'];
        }
        ?>
        <a href="<?php echo $stream_url; ?>" class="btn btn-live">
            <i class="fas fa-play-circle"></i> Watch Live
        </a>
    </div>
</div>

<script>
    const API_KEY = "1f6dfc865833669141833b3746aab4e0c9b4e8744a6bf29b43c30b780b0efa73"; // Put your actual key here
    const params = new URLSearchParams(window.location.search);
    const matchId = params.get('id');

    async function fetchMatchDetails() {
        if(!matchId || API_KEY === "YOUR_API_KEY_HERE") return;
        
        try {
            const response = await fetch(`https://v3.football.api-sports.io/fixtures?id=${matchId}`, {
                "headers": { "x-rapidapi-host": "v3.football.api-sports.io", "x-rapidapi-key": API_KEY }
            });
            const data = await response.json();
            
            if(!data.response || data.response.length === 0) return;
            const match = data.response[0];

            // Update UI
            document.getElementById('league-name').innerText = `${match.league.name} - ${match.league.round}`;
            document.getElementById('h-name').innerText = match.teams.home.name;
            document.getElementById('a-name').innerText = match.teams.away.name;
            document.getElementById('h-logo').src = match.teams.home.logo;
            document.getElementById('a-logo').src = match.teams.away.logo;
            
            const hGoal = match.goals.home ?? 0;
            const aGoal = match.goals.away ?? 0;
            document.getElementById('score-main').innerText = `${hGoal} - ${aGoal}`;
            
            const status = match.fixture.status.short;
            const elapsed = match.fixture.status.elapsed || 0;
            document.getElementById('status-text').innerText = `${status} ${elapsed}'`;

            renderEvents(match.events);
            renderStats(match.statistics);
            
        } catch (e) { 
            console.error("API Fetch Error:", e); 
        }
    }

    function renderEvents(events) {
        const list = document.getElementById('events-list');
        if(!events || events.length === 0) {
            list.innerHTML = "<p style='color:var(--text-dim)'>No major events reported yet.</p>";
            return;
        }
        
        list.innerHTML = events.slice().reverse().map(ev => {
            let icon = 'fa-info-circle';
            let color = '#a0a0a0';
            
            if(ev.type === 'Goal') { icon = 'fa-futbol'; color = '#2ed573'; }
            else if(ev.type === 'Card' && ev.detail === 'Yellow Card') { icon = 'fa-square'; color = '#ffd32a'; }
            else if(ev.type === 'Card' && ev.detail === 'Red Card') { icon = 'fa-square'; color = '#ff4757'; }
            else if(ev.type === 'subst') { icon = 'fa-exchange-alt'; color = '#3742fa'; }

            return `
                <div class="event">
                    <span style="font-weight:bold; width:30px;">${ev.time.elapsed}'</span>
                    <i class="fas ${icon}" style="color:${color}"></i>
                    <span><strong>${ev.player.name || 'Player'}</strong> ${ev.detail}</span>
                </div>
            `;
        }).join('');
    }

    function renderStats(stats) {
        const container = document.getElementById('stats-section');
        if(!stats || stats.length < 2) {
            container.innerHTML = "<p style='color:var(--text-dim)'>Stats currently unavailable.</p>";
            return;
        }

        const homeStats = stats[0].statistics;
        const awayStats = stats[1].statistics;
        const keys = ["Ball Possession", "Total Shots", "Shots on Goal", "Corners", "Fouls"];

        container.innerHTML = keys.map(key => {
            let hVal = homeStats.find(s => s.type === key)?.value || 0;
            let aVal = awayStats.find(s => s.type === key)?.value || 0;

            // Handle percentage strings like "55%"
            let hNum = parseInt(hVal.toString().replace('%','')) || 0;
            let aNum = parseInt(aVal.toString().replace('%','')) || 0;
            
            let total = hNum + aNum;
            let hPerc = total === 0 ? 50 : (hNum / total) * 100;

            return `
                <div class="stat-bar-container">
                    <div class="stat-info"><span>${hVal}</span><span style="color:var(--text-dim); font-weight:400">${key}</span><span>${aVal}</span></div>
                    <div class="bar-wrap">
                        <div class="h-fill" style="width: ${hPerc}%;"></div>
                        <div class="a-fill" style="width: ${100 - hPerc}%;"></div>
                    </div>
                </div>
            `;
        }).join('');
    }

    fetchMatchDetails();
    setInterval(fetchMatchDetails, 30000); // Refresh every 30 seconds for live feel
</script>

</body>
</html>