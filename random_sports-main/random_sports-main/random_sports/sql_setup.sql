-- 1. Database Toiri
CREATE DATABASE IF NOT EXISTS random_sports;
USE random_sports;

-- 2. News Table (Home Page-er jonno)
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tag VARCHAR(50),
    title VARCHAR(255),
    image_url VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Live TV Channels Table (LiveSportsTv Page-er jonno)
CREATE TABLE IF NOT EXISTS channels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50), -- e.g., 'hot_events', 'live_football', 'bd_tv'
    title VARCHAR(100),
    image_url VARCHAR(255),
    link_url VARCHAR(255),
    is_live TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Highlights Table (Match Highlights Page-er jonno)
CREATE TABLE IF NOT EXISTS highlights_custom (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    youtube_id VARCHAR(100),
    thumbnail_url VARCHAR(255),
    channel_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. World Cup 2026 Table
CREATE TABLE IF NOT EXISTS wc_matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    stream_url VARCHAR(500) NOT NULL,
    status ENUM('LIVE', 'UPCOMING', 'FINISHED') DEFAULT 'LIVE',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 6. LaLiga Table
CREATE TABLE IF NOT EXISTS laliga_streams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    match_name VARCHAR(255),
    stream_url VARCHAR(500),
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 7. Premier League (EPL) Table
CREATE TABLE IF NOT EXISTS epl_streams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    match_title VARCHAR(255) NOT NULL,
    stream_url VARCHAR(500) NOT NULL,
    quality VARCHAR(50) DEFAULT '4K',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 8. UEFA Champions League (UCL) Table
CREATE TABLE IF NOT EXISTS ucl_streams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    match_title VARCHAR(255) NOT NULL,
    stream_url VARCHAR(500) NOT NULL,
    quality VARCHAR(50) DEFAULT '4K HD',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 9. F1 Racing Table
CREATE TABLE IF NOT EXISTS f1_streams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    stream_url VARCHAR(500) NOT NULL,
    quality VARCHAR(50) DEFAULT '60FPS HD',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 10. Saudi Pro League (SPL) Table
CREATE TABLE IF NOT EXISTS spl_streams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    match_title VARCHAR(255) NOT NULL,
    stream_url VARCHAR(500) NOT NULL,
    quality VARCHAR(50) DEFAULT '4K',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 11. Ligue 1 (French League) Table
CREATE TABLE IF NOT EXISTS ligue1_streams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    match_title VARCHAR(255) NOT NULL,
    stream_url VARCHAR(500) NOT NULL,
    quality VARCHAR(50) DEFAULT 'FRENCH HD',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 12. Serie A (Italian League) Table
CREATE TABLE IF NOT EXISTS seriea_streams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    match_title VARCHAR(255) NOT NULL,
    stream_url VARCHAR(500) NOT NULL,
    quality VARCHAR(50) DEFAULT 'Full HD',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 13. Bundesliga (German League) Table
CREATE TABLE IF NOT EXISTS bundes_streams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    match_title VARCHAR(255) NOT NULL,
    stream_url VARCHAR(500) NOT NULL,
    quality VARCHAR(50) DEFAULT 'GERMAN HD',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 14. Match Details Table (Scoreboard Redirection & Custom Info)
CREATE TABLE IF NOT EXISTS match_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    api_match_id INT UNIQUE,
    custom_message TEXT,
    stream_redirection_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 15. Admin Table (Security-r jonno)
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);