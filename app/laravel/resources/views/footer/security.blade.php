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
            <h1 class="text-7xl tracking-widest font-bold">SEGURIDAD</h1>
        </div>
    </header>
    <main class="max-w-250 mx-auto w-full p-10 flex flex-col gap-15 my-12">
        <section>
            <h2 id="privacy"
                class="text-4xl mb-5 px-16 py-2 font-bold tracking-wider text-white bg-gradient-to-br from-purple-400 to-blue-300 -skew-x-16 w-fit rounded">
                POLÍTICA DE PRIVACIDAD
            </h2>
            <div>
                <p>
                    En <b>Tarraco Fitness</b>, respetamos tu privacidad y nos comprometemos a proteger tus datos
                    personales.
                    Tus datos serán tratados de forma confidencial y utilizados exclusivamente para la gestión
                    de tu
                    cuenta de socio, tus reservas de clases y el envío de información pertinente sobre los nuestros
                    servicios.
                    Puedes ejercitar tus derechos de acceso, rectificación, supresión y oposición en cualquier momento a través
                    del
                    nuestro apartado de usuario o contactando con nosotros directamente.
                </p>
            </div>
        </section>
        <section>
            <h2 id="legal"
                class="text-4xl mb-5 px-16 py-2 font-bold tracking-wider text-white bg-gradient-to-br from-purple-400 to-blue-300 -skew-x-16 w-fit rounded">
                AVISO LEGAL
            </h2>
            <div>
                <p>
                    <b>Tarraco Fitness</b> es un gimnasio situado en Tarragona con más de 2.000 m² dedicados al deporte y la
                    salud.
                    Toda la información contenida en este sitio web es propiedad de Tarraco Fitness y queda prohibida
                    su
                    reproducción sin autorización previa. El usuario acepta las condiciones de uso al acceder a la nuestra
                    plataforma
                    y se compromete a realizar un uso adecuado de nuestros servicios. Tarraco Fitness no se hace responsable de
                    el uso incorrecto
                    de las instalaciones o contenidos del sitio web por parte de los usuarios.
                </p>
            </div>
        </section>
        <section>
            <h2 id="cookies"
                class="text-4xl mb-5 px-16 py-2 font-bold tracking-wider text-white bg-gradient-to-br from-purple-400 to-blue-300 -skew-x-16 w-fit rounded">
                POLÍTICA DE COOKIES
            </h2>
            <div>
                <p>
                    Utilizamos cookies para mejorar tu experiencia de navegación en <b>Tarraco Fitness</b>. Las
                    cookies nos
                    permiten personalizar el contenido, recordar tus preferencias y analizar el rendimiento del
                    nuestro
                    sitio web. Puedes gestionar tus preferencias de cookies en cualquier momento a través de la
                    configuración
                    de tu navegador. Al continuar navegando, aceptas el uso de cookies tal y como describe la nuestra
                    política. Las
                    cookies estrictamente necesarias para el funcionamiento del sitio se activan automáticamente y no
                    requieren el
                    tu consentimiento expreso.
                </p>
            </div>
        </section>
    </main>
    <x-footer />
</body>

</html>
