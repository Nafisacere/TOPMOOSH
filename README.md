🎬 TOPMOOSH
A PHP-based movie and TV show browsing website built as a university web development assignment in 2025.

📌 About
TOPMOOSH is a dynamic movie and TV show platform where users can:
-Register and log in with a personal profile picture
-Browse movies and TV shows by genre
-View detailed pages for each title including cast, director, and ratings
-Add titles to their Watchlist and Favorites
-Leave reviews and ratings
-View a sortable Ranking Table


🛠️ Built With
PHP — server-side logic and session management
HTML / CSS — structure and styling with custom animations
Bootstrap 4 — responsive layout
JSON — local data storage for movies, users, and reviews
JavaScript — sorting and interactivity


📂 Project Structure
TOPMOOSH/
├── Main.php          # Login page (entry point)
├── home.php          # Homepage with movies and shows
├── detail.php        # Individual movie/show detail page
├── genre.php         # Browse by genre
├── ranking.php       # Sortable ranking table
├── register.php      # User registration
├── login.php         # Login logic
├── logout.php        # Session logout
├── settings.php      # User profile, favorites, watchlist
├── reviews.php       # User reviews
├── preview.php       # Coming soon page
├── cool animations.css  # Custom CSS animations
├── logo.png          # Site logo
├── data/
│   ├── movies_shows.json  # Movie and show data
│   ├── reviews.json       # User reviews
│   └── users.json         # Registered users
├── posters/          # Movie and show poster images
└── profiles/         # User profile pictures

⚠️ This is a server-side PHP project — it cannot be run directly in the browser from GitHub. To run it locally, follow the instructions below.
----------------------------------------------------------------------------------------------------------------
▶️ How to Run Locally

Download and install XAMPP
Clone or download this repo into your htdocs folder:
   C:/xampp/htdocs/TOPMOOSH/
Start Apache in the XAMPP Control Panel
Open your browser and go to:
   http://localhost/TOPMOOSH/Main.php
   
📅 Notes
This project was completed in 2025 as part of a university Web Development coursework assignment. It demonstrates server-side PHP development, session handling, JSON-based data storage, and responsive front-end design.
