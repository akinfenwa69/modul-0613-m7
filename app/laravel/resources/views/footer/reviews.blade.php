<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Tarraco Fitness') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Sytles -->
    <link rel="stylesheet" href="/styles/globals.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[var(--background)] text-[var(--foreground)]">
    <nav
        class="sticky z-100 top-0 h-20 flex flex-col justify-center items-center bg-gradient-to-br from-purple-400 to-blue-300 border-b border-zinc-500">
        <div class="max-w-7xl w-full flex flex-col h-full items-center justify-between">
            <div class="flex justify-between items-center h-20 lg:h-16 w-full px-5">
                <div class="flex items-center gap-2">
                    <a href="" class="h-12 aspect-square dark">
                        <x-application-logo />
                    </a>
                    <span class="font-bold text-xl tracking-wider italic text-white">TARRACO FITNESS</span>
                </div>
                <div class="flex items-center gap-2">
                    <div
                        class="transition hover:scale-105 font-bold tracking-wider bg-white -skew-x-16 w-fit rounded-sm inline-block">
                        <a href="/register"
                            class="text-sm px-6 py-1 font-semibold tracking-wider bg-gradient-to-r from-purple-500 to-blue-400 inline-block text-transparent bg-clip-text">
                            Register
                        </a>
                    </div>
                    <div
                        class="transition hover:scale-105 font-bold tracking-wider bg-white -skew-x-16 w-fit rounded-sm inline-block">
                        <a href="/login"
                            class="text-sm px-6 py-1 font-semibold tracking-wider bg-gradient-to-r from-purple-500 to-blue-400 inline-block text-transparent bg-clip-text">
                            Login
                        </a>
                    </div>
                    <img src="" alt="" class="bg-blue-500 rounded-full w-9 aspect-square ml-2">
                </div>
            </div>
        </div>
    </nav>
    <header class="relative h-screen -mt-20 flex items-center justify-center bg-blue-500/5">
        <img src="/images/cardio.webp" alt="sala" class="absolute w-full h-full object-cover object-center">
        <span class="bg-black/50 inset-0 absolute"></span>
        <div class="relative z-10 flex flex-col items-center gap-12 text-center text-white">
            <h1 class="text-7xl tracking-widest font-bold">RESEÑAS</h1>
        </div>
    </header>
    <main class="max-w-250 mx-auto w-full p-10 flex flex-col gap-15 my-12">
        <section>
            <h2 id="privacy"
                class="text-4xl mb-5 px-16 py-2 font-bold tracking-wider text-white bg-gradient-to-br from-purple-400 to-blue-300 -skew-x-16 w-fit rounded">
                RESEÑAS
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                @foreach ($valoracions as $v)
                    <div class="p-3 rounded-lg border flex flex-col gap-1">
                        <div class="flex items-center gap-2">
                            <p class="bg-amber-400 p-2 rounded-full h-9 w-9 flex items-center justify-center">
                            {{ $v->estrelles }}
                            <span class="text-zinc-500 text-xs self-end">/5</span></p>
                            {{ $v->client->nom }} {{ $v->client->cognom }}
                            
                        </div>
                        <p class="text-xs">{{ $v->descripcio }}</p>
                        @foreach ($classes as $c)
                            @if ($c->id === $v->classe_id)
                                <p class="text-xs text-zinc-500 truncate">
                                    Clase de {{ $c->tipus }}
                                    ~ Sala {{ $c->sala->id ?? 'sin sala' }}
                                </p>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>
    </main>
    <x-footer />
</body>

</html>
