<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);
const imagePath = '/images/1.jpg';
const productOne = '/images/producto-1.png';
const LogoQuimiecologi01 = '/images/Logo-Quimiecologi-01.png';

onBeforeMount(async () => {
    // Iniciar spinner de carga.
    isLoading.value = true;
});

onMounted(async () => {
    // Finalizar spinner de carga.
    isLoading.value = false;
});
</script>

<template>
    <MainLayout>
        <template #main>
            <Head title="Inicio" />

            <loading
                :active="isLoading"
                :is-full-page="fullPage"
            ></loading>

            <!-- Sección 1 -->
            <div class="container mx-auto flex flex-wrap pt-4 pb-5">
                <img :src="LogoQuimiecologi01" alt="Quimiecologi C.A." class="w-2/3 block mx-auto h-auto" />

                <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t">
                </div>
                </div>
                <div class="w-full font-bold text-xl text-gray-800 px-6 text-center">
                Fabricación de productos químicos
                </div>

                <p class="w-full text-gray-600 text-xs md:text-sm px-6 mt-6 mb-4 text-center">
                Línea Facial BASTT®
                </p>

                <img :src="imagePath" class="rounded-lg w-full h-auto mx-auto">

            </div>
            <!-- Final Sección 1 -->

            <!-- Sección Productos -->
            <section class="bg-white border-b py-5">
                <div class="container max-w-5xl mx-auto m-8">
                    <h2 class="w-full my-2 text-5xl font-black leading-tight text-center text-gray-800">
                        Productos
                    </h2>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Lorem ipsum dolor sit amet
                            </h3>
                            <p class="text-gray-600">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-96 h-auto mx-auto">
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Lorem ipsum dolor sit amet
                            </h3>
                            <p class="text-gray-600">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-96 h-auto mx-auto">
                        </div>
                    </div>
                </div>
            </section>
            <!-- Final Sección Productos -->

            <!-- Sección Servicios -->
            <section class="bg-gray-100 border-b py-5">
                <div class="container max-w-5xl mx-auto m-8">
                    <h2 class="w-full my-2 text-5xl font-black leading-tight text-center text-gray-800">
                        Servicios
                    </h2>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Lorem ipsum dolor sit amet
                            </h3>
                            <p class="text-gray-600">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-96 h-auto mx-auto">
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Lorem ipsum dolor sit amet
                            </h3>
                            <p class="text-gray-600">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-96 h-auto mx-auto">
                        </div>
                    </div>
                </div>
            </section>
            <!-- Final Sección Servicios -->
        </template>
    </MainLayout>
</template>
