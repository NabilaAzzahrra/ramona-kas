<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>POS Rammona</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

        <style>
            // <uniquifier>: Use a unique and descriptive class name
            // <weight>: Use a value from 400 to 900

            body {
            font-family: "Playfair Display", serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="bg-[#0C4B54]">
            <div class="relative min-h-screen flex flex-col items-center justify-center">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    {{-- Start Header --}}
                    <header class="grid grid-cols-2 items-center justify-between gap-2">
                        <div class="px-2 py-5 top-0">
                            <img class="w-20" src="{{asset('img/logo.png')}}" alt="">
                        </div>
                        @if (Route::has('login'))
                            <nav class="flex  justify-end">
                                @auth
                                @else
                                <div class="flex items-center border rounded-3xl px-5 py-1 font-semibold text-center bg-[#E9F549] hover:text-slate-800 hover:bg-[#cfda41] hover:shadow-sm hover:shadow-slate-400">
                                    <a
                                        href="{{ route('login') }}"
                                        class="text-sm md:text-base font-semibold transition"
                                    >
                                        Login
                                    </a>
                                </div>
                                    

                                    @if (Route::has('register'))
                                    {{-- <div class="flex items-center border rounded-3xl px-5 py-1 font-semibold text-center bg-[#E9F549] hover:text-slate-800 hover:bg-[#cfda41] hover:shadow-sm hover:shadow-slate-400">
                                        <a
                                            href="#"
                                            class="text-[#0C4B54] text-sm md:text-base  transition"
                                        >
                                            Register
                                        </a>
                                    </div> --}}
                                        
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </header>
                    {{-- End Header --}}

                    {{-- Start Main --}}
                    <div class="flex md:flex-row flex-col justify-between items-center my-12">
                        <main class="mt-6">
                            <div class="grid gap-6 lg:gap-8">
                                <div class="flex flex-col space-y-3">
                                    <h1 class="flex flex-col text-3xl md:text-7xl font-bold text-slate-200 leading-relaxed">
                                        Selamat Datang
                                        di Aplikasi POS
                                        <span class="text-[#E9F549]">Roti Rammona</span>
                                    </h1>
                                    <p class="text-slate-300 font-normal text-base md:text-lg">
                                    Kelola Keuangan Toko Roti Anda dengan Mudah dan Efisien
                                    </p>
                                </div>
                            </div>
                            <div class="my-6">
                                <a href="{{ route('login') }}" class="px-5 py-2 rounded-3xl border bg-[#E9F549] text-[#0C4B54] font-semibold hover:shadow-sm hover:shadow-slate-300 hover:bg-[#d6e044]">
                                    Get Started
                                </a>
                            </div>
                            
                        </main>
                        <div class="flex justify-center">
                        <dotlottie-player  src="{{asset('img/welcome.json')}}" background="transparent" speed="1"  loop autoplay></dotlottie-player>
                        </div>
                    </div>
                    
                    {{-- End Main --}}
                    
                    {{-- Start Footer --}}
                    <footer class="pt-16 text-center text-sm text-slate-300 my-3">
                        Copyright &copy; 2024 Silena-Connect
                    </footer>
                    {{-- End Footer --}}
                </div>
            </div>
        </div>

        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
    </body>
</html>
