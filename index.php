<?php
/**
 * index.php – Main portfolio page (standalone, no partials required)
 */
$pageTitle = 'PHP Portfolio – Home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <style>
        /* ── Reset & Base ──────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-dark:        #0f0f1a;
            --bg-card:        #1a1a2e;
            --bg-nav:         #12122a;
            --orange-main:    #ff6a00;
            --orange-light:   #ffaa44;
            --purple-main:    #7b2fff;
            --purple-light:   #b57bff;
            --text-main:      #e8e8f0;
            --text-muted:     #9999bb;
            --border:         rgba(255,255,255,0.08);
            --radius:         12px;
            --shadow:         0 4px 24px rgba(0,0,0,0.4);
        }

        body {
            background: var(--bg-dark);
            color: var(--text-main);
            font-family: 'Segoe UI', system-ui, sans-serif;
            line-height: 1.7;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a { color: var(--orange-light); text-decoration: none; }
        a:hover { text-decoration: underline; }

        /* ── Navbar ────────────────────────────────────── */
        .navbar {
            background: var(--bg-nav);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,0.5);
        }

        .navbar .brand {
            font-size: 1.2rem;
            font-weight: 700;
            background: linear-gradient(90deg, var(--orange-main), var(--purple-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar nav {
            display: flex;
            gap: 0.25rem;
        }

        .navbar nav a {
            color: var(--text-muted);
            padding: 0.4rem 0.9rem;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: color 0.2s, background 0.2s;
            -webkit-text-fill-color: unset;
        }

        .navbar nav a:hover,
        .navbar nav a.active {
            color: var(--orange-light);
            background: rgba(255,106,0,0.1);
            text-decoration: none;
        }

        /* ── Layout ────────────────────────────────────── */
        .hero {
            background: linear-gradient(135deg, rgba(123,47,255,0.3), rgba(255,106,0,0.2));
            border-bottom: 1px solid var(--border);
            padding: 3.5rem 2rem 3rem;
            text-align: center;
        }

        .hero h1 {
            font-size: clamp(1.8rem, 5vw, 2.8rem);
            font-weight: 800;
            background: linear-gradient(90deg, var(--orange-main), var(--purple-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.75rem;
        }

        .hero p {
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
        }

        main {
            max-width: 900px;
            width: 100%;
            margin: 2rem auto;
            padding: 0 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* ── Cards ─────────────────────────────────────── */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.75rem 2rem;
            box-shadow: var(--shadow);
        }

        .card h2 {
            font-size: 1.25rem;
            color: var(--orange-light);
            margin-bottom: 1rem;
        }

        .card h3 {
            font-size: 1rem;
            color: var(--purple-light);
            margin: 1rem 0 0.3rem;
        }

        .card p { color: var(--text-muted); }

        /* ── Skills Grid ───────────────────────────────── */
        .skills-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .skill-badge {
            background: linear-gradient(135deg, rgba(123,47,255,0.25), rgba(255,106,0,0.15));
            border: 1px solid rgba(181,123,255,0.3);
            color: var(--purple-light);
            padding: 0.3rem 0.85rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* ── Buttons ───────────────────────────────────── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.2rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.1s;
            text-decoration: none;
            -webkit-text-fill-color: unset;
        }

        .btn:hover { opacity: 0.85; transform: translateY(-1px); text-decoration: none; }

        .btn-primary {
            background: linear-gradient(135deg, var(--orange-main), #ff9500);
            color: #fff;
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--purple-main), #a14fff);
            color: #fff;
        }

        /* ── Flex Row ──────────────────────────────────── */
        .flex-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
        }

        /* ── Utilities ─────────────────────────────────── */
        .mt-1 { margin-top: 0.75rem; }
        .mt-2 { margin-top: 1.25rem; }

        ul { padding-left: 1.5rem; color: var(--text-muted); }
        li { margin-bottom: 0.35rem; }

        /* ── Footer ────────────────────────────────────── */
        footer {
            background: var(--bg-nav);
            border-top: 1px solid var(--border);
            padding: 1.25rem 2rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        footer span {
            background: linear-gradient(90deg, var(--orange-main), var(--purple-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        /* ── Responsive ────────────────────────────────── */
        @media (max-width: 600px) {
            .navbar { padding: 0 1rem; }
            .navbar nav a { padding: 0.35rem 0.6rem; font-size: 0.85rem; }
            main { padding: 0 1rem; }
            .card { padding: 1.25rem 1.25rem; }
        }
    </style>
</head>
<body>

<!-- ── Navbar ───────────────────────────────────────── -->
<header class="navbar">
    <div class="brand">⚡ PHP Portfolio</div>
    <nav>
        <a href="index.php" class="active">Home</a>
        <a href="apps/calculator.php">Calculator</a>
        <a href="apps/todo.php">Tasks</a>
        <a href="apps/quiz.php">Quiz</a>
        <a href="apps/bmi.php">BMI</a>
        <a href="apps/converter.php">Converter</a>
    </nav>
</header>

<!-- ── Hero ─────────────────────────────────────────── -->
<section class="hero">
    <h1>PHP Portfolio</h1>
    <p>Welcome to my PHP showcase! Here you will find my professional profile and a collection of interactive mini-apps.</p>
</section>

<!-- ── Content ──────────────────────────────────────── -->
<main>

    <div class="card">
        <h2>👤 About Me</h2>
        <p>
            Hello! I am a PHP Developer passionate about creating clean, efficient, and scalable code.
            This website serves as my portfolio, demonstrating my backend skills through a variety of practical tools.
        </p>
        <p class="mt-1">
            This project is built using <strong>Vanilla PHP</strong> (no frameworks),
            featuring custom CSS with a modern orange-purple aesthetic.
        </p>
    </div>

    <div class="card">
        <h2>🛠️ Tech Stack</h2>
        <div class="skills-grid">
            <span class="skill-badge">PHP 8+</span>
            <span class="skill-badge">HTML5</span>
            <span class="skill-badge">CSS3</span>
            <span class="skill-badge">JavaScript</span>
            <span class="skill-badge">MySQL</span>
            <span class="skill-badge">Git</span>
            <span class="skill-badge">REST API</span>
            <span class="skill-badge">OOP</span>
            <span class="skill-badge">MVC Pattern</span>
            <span class="skill-badge">Linux</span>
            <span class="skill-badge">Composer</span>
            <span class="skill-badge">JSON</span>
        </div>
    </div>

    <div class="card">
        <h2>🚀 Featured Projects</h2>

        <h3>📂 PHP Portfolio Website</h3>
        <p>A full-featured portfolio site built on pure PHP. Features: responsive design, session handling, form validation, and custom themes.</p>

        <h3>🧮 Web Calculator</h3>
        <p>An interactive calculator supporting basic arithmetic operations, powered by PHP and enhanced with JavaScript.</p>

        <h3>📋 Task Manager</h3>
        <p>A simple To-Do application using session-based data persistence to add, complete, and delete tasks.</p>

        <h3>🎯 PHP Quiz</h3>
        <p>A dynamic quiz testing PHP knowledge with real-time score calculation and answer feedback.</p>

        <h3>⚖️ BMI Calculator</h3>
        <p>A health tool that calculates Body Mass Index with instant categorization and health tips.</p>

        <h3>🔄 Unit Converter</h3>
        <p>A versatile converter for temperature, length, weight, and volume between different measurement systems.</p>
    </div>

    <div class="card">
        <h2>🎮 Live Mini-Apps</h2>
        <p class="mt-1">Try out these functional PHP modules:</p>
        <div class="flex-row mt-2">
            <a href="apps/calculator.php" class="btn btn-primary">🧮 Calculator</a>
            <a href="apps/todo.php"       class="btn btn-secondary">📋 Tasks</a>
            <a href="apps/quiz.php"       class="btn btn-primary">🎯 Quiz</a>
            <a href="apps/bmi.php"        class="btn btn-secondary">⚖️ BMI Tool</a>
            <a href="apps/converter.php"  class="btn btn-primary">🔄 Converter</a>
        </div>
    </div>

    <div class="card">
        <h2>📬 Contact Information</h2>
        <ul>
            <li>GitHub: <a href="https://github.com/Developer3421" target="_blank">Developer3421</a></li>
            <li>Email: developer3421@example.com</li>
        </ul>
    </div>

    <div class="card">
        <h2>📄 Project Documentation</h2>
        <?php
        $readmePath = __DIR__ . '/README.md';
        if (file_exists($readmePath)) {
            $content = file_get_contents($readmePath);

            $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
            $content = preg_replace('/^### (.+)$/m', '<h3>$1</h3>', $content);
            $content = preg_replace('/^## (.+)$/m',  '<h2 style="color:var(--purple-light);margin:1rem 0 0.5rem">$1</h2>', $content);
            $content = preg_replace('/^# (.+)$/m',   '<h1 style="color:var(--orange-light);font-size:1.6rem;margin:0.5rem 0">$1</h1>', $content);
            $content = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $content);
            $content = preg_replace('/\*(.+?)\*/s',     '<em>$1</em>',         $content);
            $content = preg_replace('/`(.+?)`/', '<code style="background:rgba(255,255,255,0.1);padding:0.1em 0.4em;border-radius:4px;font-family:monospace">$1</code>', $content);
            $content = nl2br($content);
            echo '<div style="color:var(--text-muted)">' . $content . '</div>';
        } else {
            echo '<p style="color:var(--text-muted)">Project documentation (README.md) not found.</p>';
        }
        ?>
    </div>

</main>

<!-- ── Footer ───────────────────────────────────────── -->
<footer>
    &copy; <?= date('Y') ?> <span>PHP Portfolio</span> &nbsp;·&nbsp; Built with Vanilla PHP
</footer>

</body>
</html>

