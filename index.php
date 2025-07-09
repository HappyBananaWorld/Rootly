<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Rootly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        :root {
            --bg: #f8f9fa;
            --text: #1a1a1a;
            --card-bg: #ffffff;
            --card-border: #e0e0e0;
            --accent: #007bff;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        [data-theme='dark'] {
            --bg: #1a1a1a;
            --text: #e0e0e0;
            --card-bg: #2a2a2a;
            --card-border: #444;
            --accent: #4dabf7;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg);
            color: var(--text);
            padding: 2rem;
            transition: background 0.3s ease, color 0.3s ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        input[type="search"] {
            padding: 0.75rem 1rem;
            border: 1px solid var(--card-border);
            border-radius: 12px;
            font-size: 1rem;
            width: 100%;
            max-width: 320px;
            background: var(--card-bg);
            color: var(--text);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="search"]:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }

        .toggle-mode {
            cursor: pointer;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 8px;
            padding: 0.5rem;
            font-size: 1.2rem;
            color: var(--text);
            transition: transform 0.2s ease, background 0.3s ease;
        }

        .toggle-mode:hover {
            transform: scale(1.1);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: var(--text);
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .card h2 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card small {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .pin-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            color: #ffd700;
            transition: transform 0.2s ease;
        }

        .pin-btn:hover {
            transform: scale(1.2);
        }

        footer {
            margin-top: auto;
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
            padding: 1.5rem 0;
        }

        .icons {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .icons svg {
            width: 28px;
            height: 28px;
            fill: var(--text);
            transition: fill 0.3s ease, transform 0.2s ease;
        }

        .icons svg:hover {
            fill: var(--accent);
            transform: scale(1.1);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 2rem 0 1rem;
            border-bottom: 2px solid var(--card-border);
            padding-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 1.8rem;
            }

            .grid {
                grid-template-columns: 1fr;
            }

            input[type="search"] {
                max-width: 100%;
            }
        }
    </style>
</head>

<body data-theme="light">
    <div class="header">
        <h1>🚀 Rootly</h1>
        <div class="search">
            <input type="search" id="searchInput" placeholder="Search projects..." />
            <button class="toggle-mode" id="themeToggle">🌓</button>
        </div>
    </div>

    <div class="section-title">📌 Pinned Projects</div>
    <div class="grid" id="pinnedProjects"></div>

    <div class="section-title">📁 All Projects</div>
    <div class="grid" id="projectList">
        <?php
        $excluded = ['phpmyadmin', 'dashboard', 'wamp', '__wamp64__'];
        $dirs = array_filter(glob('*'), 'is_dir');
        foreach ($dirs as $dir) {
            if (in_array($dir, $excluded))
                continue;
            $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            // Full URL to the folder
            $rootUrl = $baseUrl . '/' . $dir;
            echo "<a href='$rootUrl' class='card' data-name='$dir'>
                  <h2>" . ucfirst($dir) . "</h2>
                  <small>Open project</small>
                  <button class='pin-btn' title='Pin this project'>📌</button>
                </a>";
        }
        ?>
    </div>

    <footer>
        Made with ❤️ by You |
        <div class="icons">
            <a href="https://github.com/happybananaworld" target="_blank" title="GitHub">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M12 .5C5.73.5.5 5.73.5 12c0 5.08 3.29 9.39 7.86 10.93.57.11.78-.25.78-.55 0-.27-.01-1.17-.02-2.13-3.2.7-3.88-1.37-3.88-1.37-.52-1.33-1.27-1.68-1.27-1.68-1.04-.71.08-.7.08-.7 1.15.08 1.75 1.18 1.75 1.18 1.02 1.74 2.68 1.24 3.33.94.1-.74.4-1.24.73-1.53-2.55-.29-5.23-1.28-5.23-5.7 0-1.26.45-2.29 1.18-3.09-.12-.29-.51-1.46.11-3.05 0 0 .96-.31 3.14 1.18a10.98 10.98 0 012.86-.38c.97 0 1.95.13 2.86.38 2.18-1.5 3.13-1.18 3.13-1.18.63 1.59.24 2.76.12 3.05.73.8 1.18 1.83 1.18 3.09 0 4.43-2.69 5.4-5.26 5.68.42.36.78 1.08.78 2.18 0 1.57-.01 2.84-.01 3.22 0 .3.2.67.79.55A10.52 10.52 0 0023.5 12C23.5 5.73 18.27.5 12 .5z" />
                </svg>
            </a>
            <a href="https://gitlab.com/sajadmirave" target="_blank" title="GitLab">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M22.54 13.88l-2.01-6.2a.753.753 0 0 0-1.43-.02l-1.71 5.25H6.61l-1.7-5.25a.75.75 0 0 0-1.43.02l-2 6.2c-.27.82.02 1.73.72 2.25l8.73 6.28c.52.38 1.24.38 1.76 0l8.72-6.28c.7-.52 1-1.43.73-2.25z" />
                </svg>
            </a>
        </div>
    </footer>

    <script>
        const searchInput = document.getElementById('searchInput');
        const projectList = document.getElementById('projectList');
        const pinnedProjects = document.getElementById('pinnedProjects');
        const themeToggle = document.getElementById('themeToggle');

        // Load theme
        document.body.dataset.theme = localStorage.getItem('theme') || 'light';
        themeToggle.textContent = document.body.dataset.theme === 'dark' ? '🌞' : '🌓';

        themeToggle.onclick = () => {
            const current = document.body.dataset.theme;
            const next = current === 'light' ? 'dark' : 'light';
            document.body.dataset.theme = next;
            localStorage.setItem('theme', next);
            themeToggle.textContent = next === 'dark' ? '🌞' : '🌓';
        };

        // Pinning
        const getPinned = () => JSON.parse(localStorage.getItem('pinned') || '[]');
        const savePinned = (pins) => localStorage.setItem('pinned', JSON.stringify(pins.slice(0, 3)));

        const renderPins = () => {
            pinnedProjects.innerHTML = '';
            const pins = getPinned();
            pins.forEach(name => {
                const el = document.querySelector(`[data-name="${name}"]`);
                if (el) {
                    const clone = el.cloneNode(true);
                    clone.querySelector('.pin-btn').textContent = '📍';
                    pinnedProjects.appendChild(clone);
                }
            });
        };

        projectList.addEventListener('click', (e) => {
            if (e.target.matches('.pin-btn')) {
                e.preventDefault();
                const card = e.target.closest('.card');
                const name = card.dataset.name;
                let pins = getPinned();

                if (pins.includes(name)) {
                    pins = pins.filter(p => p !== name);
                    e.target.textContent = '📌';
                } else if (pins.length < 3) {
                    pins.push(name);
                    e.target.textContent = '📍';
                } else {
                    alert("You can pin up to 3 projects.");
                }

                savePinned(pins);
                renderPins();
            }
        });

        // Search
        searchInput.addEventListener('input', () => {
            const term = searchInput.value.toLowerCase();
            document.querySelectorAll('#projectList .card').forEach(card => {
                card.style.display = card.dataset.name.toLowerCase().includes(term) ? '' : 'none';
            });
        });

        renderPins();
    </script>
</body>

</html>