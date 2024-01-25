<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';
import { EllipsisVerticalIcon, Bars3Icon, XMarkIcon, ChevronDownIcon } from '@heroicons/vue/24/solid'
import { ChatBubbleBottomCenterIcon, EnvelopeIcon, MapPinIcon } from '@heroicons/vue/24/outline'

const menuItems = ref([
    { text: 'Inicio' },
    { text: 'Acerca de nosotros' },
    { text: 'Productos' },
    { text: 'Blogs' }
]);

const submenuItems = ref([
    { text: 'Análisis Fisicoquímico' },
    { text: 'Molienda' },
    { text: 'Pulverización' }
])

</script>

<template>
    <!-- ========== HEADER ========== -->
    <header
        class="flex flex-wrap sticky top-0 sm:justify-start sm:flex-nowrap z-50 w-full bg-white border-b border-gray-200 text-sm py-3 sm:py-0">
        <nav class="relative max-w-[85rem] flex flex-wrap basis-full items-center w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8"
            aria-label="Global">
            <!-- Logo and brand-name -->
            <div class="flex items-center justify-between">
                <Link class="font-montserrat flex-none text-xl font-semibold" aria-label="Brand">
                Logo
                </Link>
            </div>
            <!-- Hidden menu for small screens -->
            <div class="flex items-center ms-auto sm:ms-0 sm:order-3">
                <!-- Show navigation bar items-->
                <div class="sm:hidden">
                    <button type="button"
                        class="p-2 inline-flex justify-center items-center gap-1 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-xs"
                        data-hs-overlay="#navbar-offcanvas-example" aria-controls="navbar-offcanvas-example"
                        aria-label="Toggle navigation">
                        Menu
                        <EllipsisVerticalIcon class="hs-overlay-open:hidden w-5 h-5" />
                    </button>
                </div>
                <!-- Show the off-canvas menu -->
                <div class="ps-3 sm:ps-6 sm:ms-6 sm:border-s sm:border-gray-300">
                    <button type="button"
                        class="w-9 h-9 flex justify-center items-center text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-overlay="#navbar-secondary-content" aria-controls="navbar-secondary-content"
                        aria-label="Toggle navigation">
                        <Bars3Icon class="hs-collapse-open:hidden flex-shrink-0 w-5 h-5" />
                        <XMarkIcon class="hs-collapse-open:block hidden flex-shrink-0 w-5 h-5" />
                    </button>
                </div>
            </div>
            <!-- Navbar items -->
            <div id="navbar-offcanvas-example"
                class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full fixed top-0 start-0 transition-all duration-300 transform h-full max-w-xs w-full z-[50] bg-white border-e basis-full grow sm:order-2 sm:static sm:block sm:h-auto sm:max-w-none sm:w-auto sm:border-r-transparent sm:transition-none sm:translate-x-0 sm:z-40 sm:basis-auto hidden"
                tabindex="-1" data-hs-overlay-close-on-resize>
                <div
                    class="flex flex-col gap-y-4 gap-x-0 mt-5 sm:flex-row sm:items-center sm:justify-end sm:gap-y-0 sm:gap-x-7 sm:mt-0 sm:ps-7">
                    <!-- Menu items -->
                    <Link v-for="item in menuItems" :key="item.id"
                        class="font-medium text-gray-500 hover:text-gray-400 px-6 sm:py-6 sm:px-0">
                    {{ item.text }}
                    </Link>

                    <!-- Submenu items-->
                    <div
                        class="hs-dropdown [--strategy:static] sm:[--strategy:fixed] [--adaptive:none] sm:[--trigger:hover] sm:py-4">
                        <button type="button"
                            class="hs-dropdown-toggle flex items-center w-full text-gray-500 hover:text-gray-400 font-medium px-6 sm:px-0">
                            Servicios
                            <ChevronDownIcon class="hs-dropdown-open:rotate-180 flex-shrink-0 ms-2 w-4 h-4" />
                        </button>

                        <div
                            class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 sm:w-48 hidden z-10 bg-white sm:shadow-md rounded-lg py-2 px-3 sm:px-2 before:absolute top-full sm:border before:-top-5 before:start-0 before:w-full before:h-5">
                            <Link v-for="item in submenuItems" :key="item.id"
                                class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-500 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500">
                            {{ item.text }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- Offcanvas -->
    <div id="navbar-secondary-content"
        class="hs-overlay hs-overlay-open:translate-x-0 hidden -translate-x-full fixed top-0 start-0 transition-all duration-300 transform h-full max-w-xs w-full z-[60] bg-white border-e"
        tabindex="-1">
        <div class="flex justify-between items-center py-3 px-4 border-b">
            <h3 class="font-bold text-gray-800">
                Contáctanos
            </h3>
            <button type="button"
                class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-lg text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white text-sm"
                data-hs-overlay="#navbar-secondary-content">
                <span class="sr-only">Close offcanvas</span>
                <XMarkIcon class="flex-shrink-0 w-5 h-5" />
            </button>
        </div>
        <div class="p-4">
            <!-- Contact info -->
            <p class="text-gray-800 pb-5">
                Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists,
                etc.
            </p>
            <div class="flex items-center gap-x-4 mb-7">
                <ChatBubbleBottomCenterIcon class="w-8 h-8" />
                <section>
                    <h4>Telefono</h4>
                    <p class="font-thin">+58 (414) 7453-112</p>
                </section>
            </div>
            <div class="flex items-center gap-x-4 mb-7">
                <EnvelopeIcon class="w-8 h-8" />
                <section>
                    <h4>Correo</h4>
                    <p class="font-thin">rojonatanael@gmail.com</p>
                </section>
            </div>
            <div class="flex items-center gap-x-4 mb-7">
                <MapPinIcon class="w-16 h-16" />
                <section>
                    <h4>Ubicación</h4>
                    <p class="font-thin">Av. Las Américas, El campito. Estado Mérida, Mérida, Mérida 5101, VE</p>
                </section>
            </div>
        </div>
    </div>
    <!-- End Offcanvas -->
</template>