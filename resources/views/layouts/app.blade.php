<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="title" content="Smol Events">
    <meta name="description" content="Smol Events is an event management platform for sending email invitations and collecting RSVPs. Perfect for your next birthday bash!">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="https://smolevents.com">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Smol Events">
    <meta property="og:description" content="Smol Events is an event management platform for sending email invitations and collecting RSVPs. Perfect for your next birthday bash!">
    <meta property="og:image" content="{{ url('images/og_image.png') }}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="smolevents.com">
    <meta property="twitter:url" content="https://smolevents.com">
    <meta name="twitter:title" content="Smol Events">
    <meta name="twitter:description" content="Smol Events is an event management platform for sending email invitations and collecting RSVPs. Perfect for your next birthday bash!">
    <meta name="twitter:image" content="{{ url('images/og_image.png') }}">

    <link rel="icon" href="https://fav.farm/🎟️" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap');
        :root {
            --font-family: 'Inter', system-ui, -apple-system, "Segoe UI", "Roboto", "Ubuntu",
            "Cantarell", "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji",
            "Segoe UI Symbol", "Noto Color Emoji";
            --border-radius: 0.75rem;
        }
        main {
            min-height: calc(100vh - 6.5rem);
        }
    </style>

    <title>Smol Events</title>
    @livewireStyles
</head>
<body>
    <div>
        <header class="container">
            <nav>
                <ul>
                    <li>
                        <a class="contrast" href="/">
                            <strong>Smol Events  🎟️</strong>
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        @yield('content')
        <footer class="container">
            <p><small>Built with 🤎 by <a href="https://erikhanson.dev" class="secondary">Erik Hanson</a></small></p>
        </footer>
    </div>

    @livewireScripts
</body>
</html>
