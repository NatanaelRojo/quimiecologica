<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        {{-- @vite('resources/js/app.js') --}}
        @inertiaHead
    </head>
    <body class="gradient leading-relaxed tracking-wide flex flex-col font-sans antialiased">
        @inertia
    </body>

    <script>
    // Cargar métodos después que se haya cargado el DOM.
    document.addEventListener("DOMContentLoaded", function () {
        var app = document.getElementById("app");

        if (app) {
            app.addEventListener("click", function (e) {
                var target = e.target;

                // Obtener la referencia a los elementos dentro del componente Vue
                var navMenuDiv = app.querySelector("#nav-content");
                var navMenu = app.querySelector("#nav-toggle");

                if (!checkParent(target, navMenuDiv)) {
                    if (checkParent(target, navMenu)) {
                        if (navMenuDiv.classList.contains("hidden")) {
                            navMenuDiv.classList.remove("hidden");
                        } else {
                            navMenuDiv.classList.add("hidden");
                        }
                    } else {
                        navMenuDiv.classList.add("hidden");
                    }
                }
            });
        }

        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }
    });
    </script>
</html>
