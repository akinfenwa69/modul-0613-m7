<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Projecte')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Sytles -->
    <link rel="stylesheet" href="/styles/globals.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[var(--background)] text-[var(--foreground)]">

    @if (session('status'))
        <p class="border p-2 m-2 bg-black">{{ session('status') }}</p>
    @endif

    <main class="p-5">
        @yield('content')
    </main>

</body>

</html>
