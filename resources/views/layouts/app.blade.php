<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <style>
        :root {
            --border-radius: 0.75rem;
        }
        main {
            min-height: calc(100vh - 6rem);
        }
    </style>

    <title>Smol Events @yield('title')</title>
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
            <p><small>Built with ☕ by <a href="https://erikhanson.dev" class="secondary">Erik Hanson</a></small></p>
        </footer>
    </div>

    @livewireScripts
</body>
</html>
