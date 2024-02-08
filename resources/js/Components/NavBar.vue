<script setup>
const logoBrand = '/images/Logo-Quimiecologi-01.png';
</script>

<template>
    <!-- Barra de menú -->
    <nav id="header" class="w-full z-30 top-0 text-white py-1 lg:py-6">
        <div
            class="
                w-full
                container
                mx-auto
                flex
                flex-wrap
                items-center
                justify-between
                mt-0
                px-2
                py-2
                lg:py-6
            "
        >
            <div class="pl-4 items-center">
                <a
                    class="
                        text-white
                        no-underline
                        hover:no-underline
                        font-bold
                        text-2xl
                        lg:text-4xl
                    "
                    href="/"
                >
                    <img
                        :src="logoBrand"
                        alt="Quimiecologi C.A."
                        class="w-72"
                    />
                </a>
            </div>

            <div class="block lg:hidden pr-4">
                <button
                    id="nav-toggle"
                    class="
                        flex
                        items-center
                        px-3
                        py-2
                        border
                        rounded
                        text-gray-500
                        border-gray-600
                        hover:text-gray-800
                        hover:border-green-500
                        appearance-none
                        focus:outline-none
                    "
                >
                    <svg
                        class="fill-current h-3 w-3"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>

            <div
                class="
                    w-full
                    flex-grow
                    lg:flex
                    lg:items-center
                    lg:w-auto
                    hidden
                    lg:block
                    mt-2
                    lg:mt-0
                    text-black
                    p-4
                    lg:p-0 z-20
                "
                id="nav-content"
            >
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    <li class="mr-3">
                        <a
                            class="
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2 px-4
                            "
                            href="{{ route('about-us') }}"
                            @click.prevent="$inertia.visit(route('welcome'))"
                        >
                            Inicio
                        </a>
                    </li>
                    <li class="mr-3">
                        <a
                            class="
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2
                                px-4
                            "
                            href="{{ route('about-us') }}"
                            @click.prevent="$inertia.visit(route('about-us'))"
                        >
                            Acerca de nosotros
                        </a>
                    </li>
                    <li class="mr-3">
                        <a
                            class="
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2
                                px-4
                            "
                            href="{{ route('products') }}"
                            @click.prevent="$inertia.visit(route('products'))"
                        >
                            Productos
                        </a>
                    </li>
                    <li class="mr-3">
                        <a
                            class="
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2 px-4
                            "
                            href="{{ route('services') }}"
                            @click.prevent="$inertia.visit(route('services'))"
                        >
                            Servicios
                        </a>
                    </li>
                    <li class="mr-3">
                        <a
                            class="
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2 px-4
                            "
                            href="{{ route('posts') }}"
                            @click.prevent="$inertia.visit(route('posts.index'))"
                        >
                            Blog
                        </a>
                    </li>
                    <li class="mr-3">
                        <a
                            class="
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2
                                px-4
                            "
                            href="{{ route('contact') }}"
                            @click.prevent="$inertia.visit(route('contact'))"
                        >
                            Contacto
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Final Barra de menú -->
</template>
