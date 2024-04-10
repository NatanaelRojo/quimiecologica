<script setup>
import { Link } from '@inertiajs/vue3';
const logoBrand = '/images/Logo-Quimiecologi-01.png';
</script>

<template>
    <!-- Barra de menú -->
    <nav id="header" class="w-full z-30 top-0 text-white py-1 lg:py-6">
        <div class="
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
            ">
            <div class="pl-4 items-center">
                <Link :href="route('welcome')" class="
                        text-white
                        no-underline
                        hover:no-underline
                        font-bold
                        text-2xl
                        lg:text-4xl
                    ">
                <img :src="logoBrand" alt="Quimiecologi C.A." class="w-80 mx-auto" />
                </Link>
            </div>

            <div class="block lg:hidden pr-4">
                <button id="nav-toggle" class="
                        gradient-green
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
                    ">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>

            <div class="
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
                " id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    <li class="mr-3">
                        <Link :href="route('welcome')" class="
                                font-montserrat
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2
                                px-2
                            ">
                        <b>INICIO</b>
                        </Link>
                    </li>
                    <li class="mr-3">
                        <Link :href="route('about-us')" class="
                                font-montserrat
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2
                                px-2
                            ">
                        <b>CONÓCENOS</b>
                        </Link>
                    </li>
                    <li class="mr-3">
                        <Link :href="route('products')" class="
                                font-montserrat
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2
                                px-2
                            ">
                        <b>PRODUCTOS</b>
                        </Link>
                    </li>
                    <li class="mr-3">
                        <Link :href="route('services')" class="
                                font-montserrat
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2
                                px-2
                            ">
                        <b>SERVICIOS</b>
                        </Link>
                    </li>
                    <li class="mr-3">
                        <Link :href="route('pending_orders.create')" class="
                                font-montserrat
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2
                                px-2
                            ">
                        <b>ASESORÍAS</b>
                        </Link>
                    </li>
                    <li class="mr-3">
                        <Link :href="route('posts.index')" class="
                                font-montserrat
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2
                                px-2
                            ">
                        <b>BLOG</b>
                        </Link>
                    </li>
                    <li class="mr-3">
                        <Link :href="route('contact')" class="
                                font-montserrat
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2
                                px-2
                            ">
                        <b>CONTACTO</b>
                        </Link>
                    </li>
                    <li class="mr-3">
                        <Link :href="route('shopping-cart')" class="
                                inline-block
                                text-black
                                no-underline
                                hover:text-gray-800
                                hover:text-underline
                                py-2
                                px-2
                            ">
                        <i class="fa fa-shopping-cart fa-lg ollapsed"></i>
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Final Barra de menú -->
</template>
