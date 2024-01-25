<script setup>
import { Link } from '@inertiajs/vue3';
import { ChevronRightIcon } from '@heroicons/vue/24/solid'
</script>

<template>
    <!-- Icon Blocks -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <h1
            class="font-montserrat pb-2 text-xl text-center font-bold text-gray-800 sm:pb-4 sm:text-2xl lg:pb-6 lg:text-4xl">
            Nuestros
            Servicios
        </h1>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 items-center gap-6">
            <!-- Card -->
            <Link class="group flex gap-y-6 w-full h-full hover:bg-gray-100 rounded-lg p-5 transition-all">
            <svg class="flex-shrink-0 w-8 h-8 text-gray-800 mt-0.5 me-6" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <circle cx="13.5" cy="6.5" r=".5" />
                <circle cx="17.5" cy="10.5" r=".5" />
                <circle cx="8.5" cy="7.5" r=".5" />
                <circle cx="6.5" cy="12.5" r=".5" />
                <path
                    d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z" />
            </svg>

            <div>
                <div>
                    <h3 class="block font-bold text-gray-800">Análisis Fisicoquímico</h3>
                    <p class="text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium
                        obcaecati laudantium illum quae in assumenda minima.</p>
                </div>

                <p class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold text-gray-800">
                    Conocer más
                    <ChevronRightIcon class="flex-shrink-0 w-4 h-4 transition ease-in-out group-hover:translate-x-1" />
                </p>
            </div>
            </Link>
            <!-- End Card -->

            <!-- Card -->
            <Link class="group flex gap-y-6 w-full h-full hover:bg-gray-100 rounded-lg p-5 transition-all">
            <svg class="flex-shrink-0 w-8 h-8 text-gray-800 mt-0.5 me-6" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M2 3h20" />
                <path d="M21 3v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V3" />
                <path d="m7 21 5-5 5 5" />
            </svg>

            <div>
                <div>
                    <h3 class="block font-bold text-gray-800">Molienda</h3>
                    <p class="text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium
                        obcaecati laudantium illum quae in assumenda minima.</p>
                </div>

                <p class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold text-gray-800">
                    Conocer más
                    <ChevronRightIcon class="flex-shrink-0 w-4 h-4 transition ease-in-out group-hover:translate-x-1" />
                </p>
            </div>
            </Link>
            <!-- End Card -->

            <!-- Card -->
            <Link class="group flex gap-y-6 w-full h-full hover:bg-gray-100 rounded-lg p-5 transition-all">
            <svg class="flex-shrink-0 w-8 h-8 text-gray-800 mt-0.5 me-6" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7" />
                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                <path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4" />
                <path d="M2 7h20" />
                <path
                    d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7" />
            </svg>

            <div>
                <div>
                    <h3 class="block font-bold text-gray-800">Pulverización</h3>
                    <p class="text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium
                        obcaecati laudantium illum quae in assumenda minima.</p>
                </div>

                <p class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold text-gray-800">
                    Conocer más
                    <ChevronRightIcon class="flex-shrink-0 w-4 h-4 transition ease-in-out group-hover:translate-x-1" />
                </p>
            </div>
            </Link>
            <!-- End Card -->
        </div>
    </div>
    <!-- End Icon Blocks -->
</template>