<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- 1. NAVIGATION BAR -->
    <nav class="navbar">
        <a href="index.html" class="logo">Nexus</a>
        <div class="search-bar">
            <input type="text" placeholder="Search">
        </div>
        <a href="profile.html" class="my-link-wrapper">
            <div class="my-card">
                <div class="nav-profile">
                    <!-- Placeholder for user avatar -->
                    <div class="post-avatar"></div>
                </div>
        </a>
    </nav>

    <!-- 2. MAIN LAYOUT GRID -->
    <main class="app-container">

        <!-- Site Navigation -->
        <div class="site-nav">
            <ul>
                <li><a href="index.php"><img src="images/home_emoji.png" width="20px" height="20px"></a></li>
                <li><a href="messages.html"><img src="images/messages_emoji.png" width="20px" height="20px"></a></li>
                <li><a href="discover.html"><img src="images/discover_emoji.png" width="20px" height="20px"></a></li>
                <li><a href="settings.html"><img src="images/settings_emoji.png" width="20px" height="20px"></a></li>
            </ul>
        </div>

        <!-- Main Dynamic Feed -->
        <section class="feed">

            <!-- Create Post Component -->
            <div class="create-post">
                <textarea placeholder="What's on your mind?"></textarea>
                <button type="button">Post</button>
            </div>

            <!-- Social Media Post Card 1 -->
            <article class="post-card">
                <div class="post-header">
                    <div class="post-avatar"></div>
                    <div class="post-author">
                        <h4>Jane Doe</h4>
                        <span>2 hours ago</span>
                    </div>
                </div>
                <div class="post-content">
                    <p>Just launched the structural HTML blueprint for my new web application! 🚀 Build it layer by
                        layer.</p>
                </div>
                <div class="post-actions">
                    <button class="action-btn">👍 Like</button>
                    <button class="action-btn">💬 Comment</button>
                    <button class="action-btn">🔁 Share</button>
                </div>
            </article>

            <!-- Social Media Post Card 2 -->
            <article class="post-card">
                <div class="post-header">
                    <div class="post-avatar"></div>
                    <div class="post-author">
                        <h4>Alex Smith</h4>
                        <span>5 hours ago</span>
                    </div>
                </div>
                <div class="post-content">
                    <p>Does anyone have good recommendations for responsive CSS layouts? Specifically trying Grid vs
                        Flexbox.</p>
                </div>
                <div class="post-actions">
                    <button class="action-btn">👍 Like</button>
                    <button class="action-btn">💬 Comment</button>
                    <button class="action-btn">🔁 Share</button>
                </div>
            </article>

        </section>

        <!-- Right Sidebar Widgets -->
        <aside class="sidebar sidebar-right">
            <h3>Sponsored / Trends</h3>
            <hr style="margin: 10px 0; border: 0; border-top: 1px solid #f0f2f5;">
            <ul>
                <li>🔥 #Singers</li>
                <li>🔥 #Guitarists</li>
                <li>🔥 #LiveMusic</li>
            </ul>
        </aside>

    </main>

</body>

</html>