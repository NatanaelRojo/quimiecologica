<script setup>
import { Link } from '@inertiajs/vue3';
const LogoQuimiecologi01 = '/images/Logo-Quimiecologi-01.png';
</script>

<template>
    <nav
        class="
                fixed top-0 z-50 w-full gradient-green border-b border-gray-200
                light:bg-gray-800 light:border-gray-700
            "
        >
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button
                        class="
                                text-white bg-blue-700 hover:bg-blue-800
                                focus:ring-4 focus:ring-blue-300 font-medium
                                rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600
                                dark:hover:bg-blue-700 focus:outline-none
                                dark:focus:ring-blue-800
                            "
                        type="button"
                        data-drawer-target="drawer-navigation"
                        data-drawer-show="drawer-navigation"
                        aria-controls="drawer-navigation"
                        style="
                            background-color: rgb(147, 188, 0) !important;
                        "
                    >
                        <svg
                            class="w-6 h-6"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                clip-rule="evenodd"
                                fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                            ></path>
                        </svg>
                    </button>
                    <a :href="route('welcome')" class="flex ms-2 md:me-24">
                        <img
                            :src="LogoQuimiecologi01"
                            class="w-40 inline-block img-zoom"
                            alt="Quimiecologi C.A."
                        />
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                    <span
                        class="
                            font-montserrat
                            font-bold
                        "
                    >
                        Diseño y desarrollo científico de alto nivel
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- drawer component -->
    <div
        id="drawer-navigation"
        class="fixed top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800"
        tabindex="-1"
        aria-labelledby="drawer-navigation-label"
        style="
            background-color: #E5E1DF !important;
        "
    >
        <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Menu</h5>
        <button
            type="button"
            data-drawer-hide="drawer-navigation"
            aria-controls="drawer-navigation"
            class="
                text-gray-400 bg-transparent hover:bg-gray-200
                hover:text-gray-900 rounded-lg text-sm p-1.5
                absolute top-2.5 end-2.5 inline-flex items-center
                dark:hover:bg-gray-600 dark:hover:text-white
            "
        >
            <svg
                aria-hidden="true"
                class="w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                ></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="py-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                <li><br></li>
                <li>
                    <Link
                        :href="route('welcome')"
                        class="
                            font-montserrat
                            inline-block
                            no-underline
                            hover:text-gray-800
                            hover:text-underline
                            py-2
                            px-2
                            flex
                            items-center
                            p-2
                            rounded-lg
                            light:text-white
                            hover:bg-gray-100
                            light:hover:bg-gray-700
                            group
                        "
                        style="color: #82675C;"
                    >
                        <span class="ms-3">
                            <b>
                                INICIO
                            </b>
                        </span>
                    </Link>
                </li>
                <li>
                <Link
                    :href="route('about-us')"
                    class="
                        font-montserrat
                        font-bold
                        inline-block
                        no-underline
                        hover:text-gray-800
                        hover:text-underline
                        py-2
                        px-2
                        flex
                        items-center
                        p-2
                        rounded-lg
                        light:text-white
                        hover:bg-gray-100
                        light:hover:bg-gray-700
                        group
                    "
                    style="color: #82675C;"
                >
                    <span class="ms-3">CONÓCENOS</span>
                </Link>
                </li>
                <li>
                <Link
                    :href="route('brands')"
                    class="
                        font-montserrat
                        font-bold
                        inline-block
                        no-underline
                        hover:text-gray-800
                        hover:text-underline
                        py-2
                        px-2
                        flex
                        items-center
                        p-2
                        rounded-lg
                        light:text-white
                        hover:bg-gray-100
                        light:hover:bg-gray-700
                        group
                    "
                    style="color: #82675C;"
                >
                    <span class="ms-3">PRODUCTOS</span>
                </Link>
                </li>
                <li>
                <Link
                    :href="route('services')"
                    class="
                        font-montserrat
                        font-bold
                        inline-block
                        no-underline
                        hover:text-gray-800
                        hover:text-underline
                        py-2
                        px-2
                        flex
                        items-center
                        p-2
                        rounded-lg
                        light:text-white
                        hover:bg-gray-100
                        light:hover:bg-gray-700
                        group
                    "
                    style="color: #82675C;"
                >
                    <span class="ms-3">SERVICIOS</span>
                </Link>
                </li>
                <li>
                    <Link
                        :href="route('services')"
                        class="
                            font-montserrat
                            font-bold
                            inline-block
                            no-underline
                            hover:text-gray-800
                            hover:text-underline
                            py-2
                            px-2
                            flex
                            items-center
                            p-2
                            rounded-lg
                            light:text-white
                            hover:bg-gray-100
                            light:hover:bg-gray-700
                            group
                        "
                        style="color: #82675C;"
                    >
                        <span class="ms-3">SERVICIOS DE FORMULACIÓN</span>
                    </Link>
                </li>
                <li>
            <Link
                :href="route('posts.index')"
                class="
                    font-montserrat
                    font-bold
                    inline-block
                    no-underline
                    hover:text-gray-800
                    hover:text-underline
                    py-2
                    px-2
                    flex
                    items-center
                    p-2
                    rounded-lg
                    light:text-white
                    hover:bg-gray-100
                    light:hover:bg-gray-700
                    group
                "
                style="color: #82675C;"
            >
                <span class="ms-3">BLOG</span>
            </Link>
                </li>
                <li>
                <Link
                    :href="route('contact')"
                    class="
                        font-montserrat
                        font-bold
                        inline-block
                        no-underline
                        hover:text-gray-800
                        hover:text-underline
                        py-2
                        px-2
                        flex
                        items-center
                        p-2
                        rounded-lg
                        light:text-white
                        hover:bg-gray-100
                        light:hover:bg-gray-700
                        group
                    "
                    style="color: #82675C;"
                >
                    <span class="ms-3">CONTÁCTANOS</span>
                </Link>
                </li>
            </ul>
        </div>
    </div>
</template>
