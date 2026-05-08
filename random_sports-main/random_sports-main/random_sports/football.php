<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Live | Match Center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* CSS Unchanged */
        :root { --primary: #ff3b3b; --secondary: #00ff85; --bg: #0b0e14; --surface: #1a1c23; --text: #fff; }
        body { background: var(--bg); color: var(--text); font-family: 'Inter', sans-serif; margin: 0; }
        .navbar { background: #000; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; }
        .logo { font-size: 22px; font-weight: 800; text-decoration: none; color: #fff; }
        .logo span { color: var(--primary); }
        .nav-links { display: flex; gap: 15px; }
        .nav-links a { color: #fff; text-decoration: none; font-weight: 600; font-size: 14px; }
        .live-dot { height: 8px; width: 8px; background: var(--primary); border-radius: 50%; display: inline-block; margin-right: 5px; animation: blink 1s infinite; }
        @keyframes blink { 0% { opacity: 1; } 50% { opacity: 0.3; } 100% { opacity: 1; } }
        .container { max-width: 800px; margin: 20px auto; padding: 0 15px; }
        .section-title { font-size: 18px; margin: 25px 0 15px; color: var(--secondary); border-left: 4px solid var(--secondary); padding-left: 10px; }
        .match-card { background: var(--surface); border-radius: 12px; padding: 18px; margin-bottom: 12px; display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; cursor: pointer; border: 1px solid #2a2e35; transition: 0.2s; }
        .match-card:hover { border-color: var(--secondary); background: #252830; }
        .team { display: flex; flex-direction: column; align-items: center; gap: 8px; }
        .team img { width: 45px; height: 45px; object-fit: contain; }
        .team span { font-weight: 600; font-size: 13px; text-align: center; max-width: 100px; }
        .score-box { text-align: center; min-width: 90px; }
        .score { font-size: 24px; font-weight: 900; color: #fff; }
        .live-score { color: var(--secondary); }
        .status { font-size: 10px; background: #000; padding: 2px 8px; border-radius: 4px; color: var(--primary); font-weight: bold; margin-top: 5px; display: inline-block; }
        .upcoming-time { color: #888; font-size: 12px; font-weight: bold; }
        .loading { text-align: center; padding: 50px; color: #666; font-size: 14px; }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="index.php" class="logo">Random<span>Sports</span></a>
    <div class="nav-links">
        <a href="LiveSportsTv.php"><span class="live-dot"></span>Live Stream</a>
        <a href="highlights.php"><span class="live-dot"></span>Highlights</a>
    </div>
</nav>

<div class="container">
    <div id="live-matches-section">
        <h2 class="section-title">Live Matches</h2>
        <div id="live-list"><div class="loading">Searching for live games...</div></div>
    </div>

    <div id="upcoming-matches-section">
        <h2 class="section-title">Upcoming Today</h2>
        <div id="upcoming-list"><div class="loading">Loading schedule...</div></div>
    </div>
</div>

<script>
    // API KEY Update
    const API_KEY = "YOUR_API_KEY_HERE"; 
    const API_URL = "https://v3.football.api-sports.io/fixtures?date=";

    async function getMatches() {
        const today = new Date().toISOString().split('T')[0];
        try {
            const response = await fetch(API_URL + today, {
                "method": "GET",
                "headers": {
                    "x-rapidapi-host": "v3.football.api-sports.io",
                    "x-rapidapi-key": API_KEY
                }
            });
            const data = await response.json();
            displayMatches(data.response);
        } catch (err) {
            console.error(err);
        }
    }

    function displayMatches(matches) {
        const liveList = document.getElementById('live-list');
        const upcomingList = document.getElementById('upcoming-list');
        liveList.innerHTML = "";
        upcomingList.innerHTML = "";

        const liveStatus = ["1H", "HT", "2H", "ET", "P", "BT"];

        matches.forEach(m => {
            const isLive = liveStatus.includes(m.fixture.status.short);
            const card = document.createElement('div');
            card.className = 'match-card';
            
            const time = new Date(m.fixture.date).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            card.onclick = () => {
                // Redirect to PHP details page
                window.location.href = `match-details.php?id=${m.fixture.id}&h=${m.teams.home.name}&a=${m.teams.away.name}`;
            };

            const scoreHTML = isLive 
                ? `<div class="score live-score">${m.goals.home} - ${m.goals.away}</div><div class="status">LIVE ${m.fixture.status.elapsed}'</div>`
                : `<div class="score" style="font-size:18px; color:#555;">VS</div><div class="upcoming-time">${time}</div>`;

            card.innerHTML = `
                <div class="team">
                    <img src="${m.teams.home.logo}">
                    <span>${m.teams.home.name}</span>
                </div>
                <div class="score-box">${scoreHTML}</div>
                <div class="team">
                    <img src="${m.teams.away.logo}">
                    <span>${m.teams.away.name}</span>
                </div>
            `;

            if (isLive) {
                liveList.appendChild(card);
            } else if (m.fixture.status.short === "NS") {
                upcomingList.appendChild(card);
            }
        });

        if(liveList.innerHTML === "") liveList.innerHTML = "<p style='color:#555; font-size:13px;'>No matches live right now.</p>";
    }

    getMatches();
    setInterval(getMatches, 120000);
</script>

</body>
</html>