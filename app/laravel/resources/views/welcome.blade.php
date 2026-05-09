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
        class="sticky z-100 top-0 h-20 lg:h-28 flex flex-col justify-center items-center bg-gradient-to-br from-purple-400 to-blue-300 border-b border-zinc-500">
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
                </div>
            </div>
            <div class="gap-7 w-full justify-center p-2 py-3 h-12 hidden lg:flex text-white font-medium">
                <a href="#qui-som">¿QUIÉNES SOMOS?</a>
                <hr class="h-full w-0.25 bg-white/50">
                <a href="#quotes">CUOTAS</a>
                <hr class="h-full w-0.25 bg-white/50">
                <a href="#horari-classes">HORARIO DE CLASES</a>
                <hr class="h-full w-0.25 bg-white/50">
                <a href="/about">TARRACO FITNESS</a>
                <hr class="h-full w-0.25 bg-white/50">
                <a href="#monitors">MONITORES</a>
                <hr class="h-full w-0.25 bg-white/50">
                <a href="/about">MÁS INFORMACIÓN</a>
            </div>
        </div>
    </nav>

    <header class="relative h-screen -mt-20 lg:-mt-28 flex items-center justify-center bg-blue-500/5">
        <img src="/images/cardio.webp" alt="sala" class="absolute w-full h-full object-cover object-center">
        <span class="bg-black/50 inset-0 absolute"></span>
        <div class="relative z-10 flex flex-col items-center gap-12 text-center text-white">
            <h1 class="text-7xl tracking-widest font-bold">TARRACO FITNESS</h1>
            <div class="grid grid-cols-2 gap-5">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-center">
                            <p>Gimnasio</p>
                            <p>Abierto 7/7</p>
                        </div>
                        <hr>
                        <p class="self-end text-sm">8:00 / 21:00</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <p>Recepción</p>
                            <p>Abierto 7/7</p>
                        </div>
                        <hr>
                        <div class="flex text-sm items-center justify-between">
                            <p>8:00 / 12:00</p>
                            <p>14:00 / 21:00</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-2 text-left">
                    <p class="text-sm">President Companys, 3, 43005 &mdash; Tarragona</p>
                    <p class="text-sm">tarracofitness@gmail.com</p>
                    <p class="text-sm">+34 XXX XX XX XX</p>
                    <hr>
                    <div class="flex items-center gap-2">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Instagram_logo_2022.svg/960px-Instagram_logo_2022.svg.png"
                            alt="instagram" class="h-9">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/1280px-Facebook_Logo_%282019%29.png"
                            alt="facebook" class="h-9">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Youtube_logo.png" alt="youtube"
                            class="h-9 p-1">
                        <p>Únete a nosotros</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-250 mx-auto w-full p-10 flex flex-col gap-15 my-12">

        <section>
            <h2 id="qui-som"
                class="text-4xl mb-5 px-16 py-2 font-bold tracking-wider text-white bg-gradient-to-br from-purple-400 to-blue-300 -skew-x-16 w-fit rounded">
                ¿QUIÉNES SOMOS?
            </h2>
            <div class="flex gap-7">
                <p>
                    <b class="text-lg">Tarraco Fitness &mdash; Tarragona</b>
                    <br />
                    Más de 2.000 m² dedicados aldeporte y la salud, con todo lo que necesitas para alcanzar tus
                    objetivos,
                    zona de musculación libre y guiada, área de cardio conectado, espacio de Cross Training, zona
                    funcional,
                    y una sala de estiramientos y relajación con hidromasaje. Además, disfruta de nuestra báscula
                    biométrica
                    avanzada para seguir tu evolución y un punto de hidratación con bebidas saludables.
                </p>
                <div
                    class="rounded-xl h-fit p-0.75 bg-gradient-to-br from-purple-400 to-blue-300 border border-transparent bg-clip-border inline-block">
                    <img src="/images/sala.jpeg" alt="sala" class="max-w-80 rounded-lg object-cover">
                </div>
            </div>
        </section>

        <section>
            <h2 id="sales"
                class="text-4xl mb-5 px-16 py-2 font-bold tracking-wider text-white bg-gradient-to-br from-purple-400 to-blue-300 -skew-x-16 w-fit rounded">
                NUESTRAS SALAS
            </h2>

            <div class="relative w-full">

                <!-- Flecha izquierda -->
                <button onclick="scrollSales(-1)"
                    class="absolute left-2 top-1/2 -translate-y-[55%] z-10 
                        bg-gradient-to-br from-purple-400 to-blue-300 
                        text-white p-3 rounded-full shadow-lg hover:scale-110 transition">
                    ◀
                </button>

                <!-- Contenedor -->
                <div id="salesContainer"
                    class="flex gap-3 overflow-x-hidden scroll-smooth w-full px-12">

                    @foreach ($sales as $s)
                        <div class="min-w-70 h-40 aspect-video border border-black rounded-lg p-3 flex items-end justify-start bg-center bg-cover relative overflow-hidden transition"
                            style="background-image: url('/images/sala_{{ str_replace(' ', '_', mb_strtolower($s->tipus)) }}.jpeg');">

                            <!-- sombra inferior -->
                            <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-black/70 to-transparent"></div>

                            <!-- texto -->
                            <span class="relative text-xl font-semibold text-white drop-shadow-md">
                                {{ $s->tipus }}
                                <p class="text-xs">{{ $s->descripcio }}</p>
                            </span>

                        </div>
                    @endforeach

                </div>

                <!-- Flecha derecha -->
                <button onclick="scrollSales(1)"
                    class="absolute right-2 top-1/2 -translate-y-[55%] z-10 
                        bg-gradient-to-br from-purple-400 to-blue-300 
                        text-white p-3 rounded-full shadow-lg hover:scale-110 transition">
                    ▶
                </button>

            </div>
        </section>

        <section
            class="rounded-xl h-fit p-1 bg-gradient-to-br from-purple-400 to-blue-300 border border-transparent bg-clip-border inline-block">
            <div class="py-7 px-3 relative overflow-hidden rounded-lg flex flex-col items-center gap-3 text-white">
                <img src="/images/cardio.webp" alt="sala" class="absolute inset-0 object-cover object-center">
                <span class="bg-black/50 inset-0 absolute"></span>
                <h2 id="tipus-activitats" class="relative z-10 text-4xl text-center font-bold tracking-wide">
                    TODO TIPO ACTIVIDADES</h2>
                <hr class="relative z-10 bg-zinc-500 w-7/10">
                <p class="relative z-10 text-center leading-7 px-10">
                    En Tarraco Finess, disfrutarás de una amplia variedad de actividades y zonas de entrenamiento
                    pensadas
                    para todos los niveles. Nuestro club está diseñado para ofrecer un entorno moderno, digitalizado
                    y
                    completamente personalizado, donde podrás vivir una experiencia fitness inmersiva y motivadora,
                    con
                    equipamiento de última generación y las mejores marcas en todo momento.</p>
            </div>
        </section>

        <section>
            <h2 id="quotes"
                class="text-4xl mb-5 px-16 py-2 font-bold tracking-wider text-white bg-gradient-to-br from-purple-400 to-blue-300 -skew-x-16 w-fit rounded">
                CUOTAS
            </h2>
            <div class="inline-flex justify-center gap-15 overflow-x-auto w-full">

                    <div class="w-65 h-90 aspect-3/4 border rounded-lg p-3 flex flex-col items-center">
                        <span class="text-xl font-bold bg-gradient-to-r from-purple-500 to-blue-400 bg-clip-text text-transparent">Bàsica</span>

                        <hr class="w-full my-3">

                        <ul class="text-sm ml-2 text-black-700 text-left list-disc list-inside space-y-1">
                            <li>Acceso a sala de musculación</li>
                            <li>Clases grupales básicas</li>
                            <li>Horario estándar</li>
                            <li>Uso de vestuarios y duchas</li>
                            <li>Acceso a maquinaria cardio</li>
                            <li>Atención básica en recepción</li>
                            
                        </ul>

                        <div class="mt-auto cursor-pointer border transition hover:scale-105 font-bold tracking-wider bg-white -skew-x-16 w-fit rounded-sm inline-block">
                            @auth

                                @if (Auth::user()->rol === 'CLIENT')

                                    <a href="{{ auth()->check() && Auth::user()->rol === 'CLIENT'
                                            ? route('subscripcions.create', ['tipus' => 'Bàsica'])
                                            : route('login') }}"
                                    class="cursor-pointer uppercase text-sm px-6 py-1 font-semibold tracking-wider bg-gradient-to-r from-purple-500 to-blue-400 inline-block text-transparent bg-clip-text">
                                        Suscríbete
                                    </a>

                                @endif

                            @else

                                <a href="{{ route('login') }}"
                                class="cursor-pointer uppercase text-sm px-6 py-1 font-semibold tracking-wider bg-gradient-to-r from-purple-500 to-blue-400 inline-block text-transparent bg-clip-text">
                                    Suscríbete
                                </a>

                            @endauth
                        </div>

                    </div>

                    
                    <div class="w-65 h-90 aspect-3/4 border rounded-lg p-3 flex flex-col items-center">
                        <span class="text-xl font-bold bg-gradient-to-r from-purple-500 to-blue-400 bg-clip-text text-transparent">Premium</span>

                        <hr class="w-full my-3">

                        <ul class="text-sm ml-2 text-black-700 text-left list-disc list-inside space-y-1">
                            <li>Acceso a todas las clases</li>
                            <li>Spinning, HIIT y Yoga incluidos</li>
                            <li>Reserva prioritaria</li>
                            <li>Acceso a sala de musculación</li>
                            <li>Acceso a horarios ampliados</li>
                            <li>Evaluación inicial gratuita</li>
                            <li>Descuentos en actividades especiales</li>
                        </ul>

                        <div class="mt-auto cursor-pointer border transition hover:scale-105 font-bold tracking-wider bg-white -skew-x-16 w-fit rounded-sm inline-block">
                            @auth

                                @if (Auth::user()->rol === 'CLIENT')

                                    <a href="{{ auth()->check() && Auth::user()->rol === 'CLIENT'
                                            ? route('subscripcions.create', ['tipus' => 'Premium'])
                                            : route('login') }}"
                                    class="cursor-pointer uppercase text-sm px-6 py-1 font-semibold tracking-wider bg-gradient-to-r from-purple-500 to-blue-400 inline-block text-transparent bg-clip-text">
                                        Suscríbete
                                    </a>

                                @endif

                            @else

                                <a href="{{ route('login') }}"
                                class="cursor-pointer uppercase text-sm px-6 py-1 font-semibold tracking-wider bg-gradient-to-r from-purple-500 to-blue-400 inline-block text-transparent bg-clip-text">
                                    Suscríbete
                                </a>

                            @endauth
                        </div>

                    </div>


                    <div class="w-65 h-90 aspect-3/4 border rounded-lg p-3 flex flex-col items-center">
                        <span class="text-xl font-bold bg-gradient-to-r from-purple-500 to-blue-400 bg-clip-text text-transparent">VIP</span>

                        <hr class="w-full my-3">

                        <ul class="text-sm ml-2 text-black-700 text-left list-disc list-inside space-y-1">
                            <li>Acceso ilimitado total</li>
                            <li>Entrenador personal incluido</li>
                            <li>Zonas exclusivas VIP</li>
                            <li>Acceso 24/7 al gimnasio</li>
                            <li>Planes de entrenamiento personalizados</li>
                            <li>Seguimiento mensual de progreso</li>
                            <li>Acceso prioritario a nuevos servicios</li>
                        </ul>

                        <div class="mt-auto cursor-pointer border transition hover:scale-105 font-bold tracking-wider bg-white -skew-x-16 w-fit rounded-sm inline-block">
                            @auth

                                @if (Auth::user()->rol === 'CLIENT')

                                    <a href="{{ auth()->check() && Auth::user()->rol === 'CLIENT'
                                            ? route('subscripcions.create', ['tipus' => 'VIP'])
                                            : route('login') }}"
                                    class="cursor-pointer uppercase text-sm px-6 py-1 font-semibold tracking-wider bg-gradient-to-r from-purple-500 to-blue-400 inline-block text-transparent bg-clip-text">
                                        Suscríbete
                                    </a>

                                @endif

                            @else

                                <a href="{{ route('login') }}"
                                class="cursor-pointer uppercase text-sm px-6 py-1 font-semibold tracking-wider bg-gradient-to-r from-purple-500 to-blue-400 inline-block text-transparent bg-clip-text">
                                    Suscríbete
                                </a>

                            @endauth
                        </div>

                    </div>

            </div>
        </section>

        <section>
            <h2 id="horari-classes"
                class="text-4xl mb-5 px-16 py-2 font-bold tracking-wider text-white bg-gradient-to-br from-purple-400 to-blue-300 -skew-x-16 w-fit rounded">
                HORARIO DE CLASES
            </h2>

            <div class="flex flex-col md:flex-row h-fit gap-5">

                {{-- CALENDARIO --}}
                <div class="rounded-xl h-90 p-0.75 aspect-square bg-gradient-to-br from-purple-400 to-blue-300 border bg-clip-border inline-block">
                    <div class="p-3 bg-zinc-100 h-full w-full rounded-lg flex flex-col">

                        {{-- NAVEGACIÓN MES --}}
                        <div class="flex justify-between items-center mb-7">

                            <a href="?mes={{ $mes - 1 }}&anio={{ $anio }}"
                            class="px-3 py-1 rounded">
                                ←
                            </a>

                            <p class="text-center text-xl font-medium">
                                {{ ucfirst(\Carbon\Carbon::create($anio, $mes)->locale('es')->monthName) }} {{ $anio }}
                            </p>

                            <a href="?mes={{ $mes + 1 }}&anio={{ $anio }}"
                            class="px-3 py-1 rounded">
                                →
                            </a>

                        </div>

                        {{-- DÍAS SEMANA --}}
                        <div class="grid grid-cols-7 gap-1 text-center text-xs font-semibold mb-4">
                            <span>L</span><span>M</span><span>X</span><span>J</span><span>V</span><span>S</span><span>D</span>
                        </div>

                        {{-- DÍAS MES --}}
                        <div class="grid grid-cols-7 gap-1 text-sm">

                            @for ($i = 1; $i <= $diasEnMes; $i++)
                                @php
                                    $fecha = \Carbon\Carbon::create($anio, $mes, $i)->toDateString();
                                @endphp

                                <a href="?dia={{ $fecha }}&mes={{ $mes }}&anio={{ $anio }}"
                                class="p-2 rounded hover:bg-purple-200 transition text-center
                                {{ $diaSeleccionado == $fecha ? 'bg-purple-500 text-white' : '' }}">
                                    {{ $i }}
                                </a>

                            @endfor

                        </div>

                    </div>
                </div>

                {{-- CLASES --}}
                <div class="flex flex-col gap-3 w-full">

                    <div class="max-h-[350px] overflow-y-auto pr-2 flex flex-col gap-3">

                        @if($clasesDia->count() > 0)

                            @foreach ($clasesDia as $c)

                                <div class="grid grid-cols-3 gap-5 py-3 px-5 rounded-xl border">

                                    <div>
                                        <p class="text-sl font-medium uppercase mb-1">{{ $c->tipus }}</p>

                                        <p class="text-sm">
                                            {{ date('H:i', strtotime($c->horari_inici)) }}
                                            -
                                            {{ date('H:i', strtotime($c->horari_final)) }}
                                        </p>

                                        <p class="text-sm">
                                            {{ $c->monitor->nom ?? '' }} {{ $c->monitor->cognom ?? '' }}
                                        </p>

                                        <p class="text-sm">
                                            Sala {{ $c->sala_id ?? 'Sin sala' }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-lg font-medium mb-1">INFO</p>
                                        <p class="text-sm break-words">
                                            {{ $c->descripcio }}
                                        </p>
                                    </div>

                                    <div class="flex flex-col gap-2 mt-2">

                                        {{-- RESERVAR --}}
                                        <div class="cursor-pointer border transition hover:scale-105 font-bold tracking-wider bg-white -skew-x-16 w-fit rounded-sm inline-block">

                                            <a href="{{ auth()->check()
                                                        ? route('classes.show', $c->id)
                                                        : route('login') }}"
                                            class="w-33 uppercase text-sm px-6 py-1 font-semibold tracking-wider bg-gradient-to-r from-purple-500 to-blue-400 inline-block text-transparent bg-clip-text">
                                                Reservar
                                            </a>

                                        </div>

                                        {{-- VER MÁS --}}
                                        <div class="cursor-pointer border transition hover:scale-105 font-bold tracking-wider bg-white -skew-x-16 w-fit rounded-sm inline-block">

                                            <button onclick="openClasseModal({{ $c->id }})"
                                                class="w-32 uppercase text-sm px-6 py-1 font-semibold tracking-wider bg-gradient-to-r from-purple-500 to-blue-400 inline-block text-transparent bg-clip-text">
                                                Ver más
                                            </button>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        @else
                            <p class="text-gray-500 text-sm">No hay clases este día</p>
                        @endif

                    </div>

                </div>

            </div>
        </section>


        <section>
            <h2 id="monitors"
                class="text-4xl mb-5 px-16 py-2 font-bold tracking-wider text-white bg-gradient-to-br from-purple-400 to-blue-300 -skew-x-16 w-fit rounded">
                MONITORES
            </h2>

            <div class="relative w-full">

                <!-- Flecha izquierda -->
                <button onclick="scrollMonitors(-1)"
                    class="absolute left-2 top-[45%] -translate-y-1/2 z-10 
                        bg-gradient-to-br from-purple-400 to-blue-300 
                        text-white p-3 rounded-full shadow-lg hover:scale-110 transition">
                    ◀
                </button>

                <!-- Contenedor scroll -->
                <div id="monitorsContainer"
                    class="flex gap-3 overflow-x-hidden scroll-smooth w-full px-10">

                    @foreach ($monitors as $m)
                        <div class="min-w-50 w-50 aspect-3/5 border border-black rounded-lg p-3 flex flex-col justify-end text-white bg-center bg-cover relative overflow-hidden transition hover:scale-100"
                            style="background-image: url('/images/monitor_{{ Str::slug($m->nom) }}.jpeg');">

                            <!-- sombra -->
                            <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-black/70 to-transparent"></div>

                            <!-- nombre -->
                            <span class="relative text-xl text-center italic font-semibold tracking-wider uppercase drop-shadow-md">
                                {{ $m->nom }}
                            </span>

                        </div>
                    @endforeach

                </div>

                <!-- Flecha derecha -->
                <button onclick="scrollMonitors(1)"
                    class="absolute right-2 top-[45%] -translate-y-1/2 z-10 
                        bg-gradient-to-br from-purple-400 to-blue-300 
                        text-white p-3 rounded-full shadow-lg hover:scale-110 transition">
                    ▶
                </button>

            </div>
        </section>

    </main>

    <x-footer />

</body>

</html>

<div id="modal-container"></div>

<script>
    // modal
    function openClasseModal(classeId) { 

        fetch(`/classes/modal/${classeId}`)
            .then(res => {
                return res.text();
            })
            .then(html => {
                document.getElementById('modal-container').innerHTML = html;
            })
            .catch(err => {
                alert('ERROR FETCH');
                console.error(err);
            });
    }


    // flechas
    function scrollMonitors(direction) {
        const container = document.getElementById('monitorsContainer');
        const scrollAmount = 220;

        container.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }

    function scrollSales(direction) {
        const container = document.getElementById('salesContainer');
        const scrollAmount = 300;

        container.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }
    
</script>