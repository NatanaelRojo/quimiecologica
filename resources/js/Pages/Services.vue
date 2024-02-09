<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);
const imagePath = '/images/1.jpg';

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

            <Head title="Nuestros Servicios" />

            <loading
                :active="isLoading"
                :is-full-page="fullPage"
            ></loading>

            <!-- Sección -->
            <section class="bg-white border-b py-3">
                <div class="container max-w-5xl mx-auto m-8">
                    <h2 class="
                            w-full
                            my-2
                            text-5xl
                            font-black
                            leading-tight
                            text-center
                            text-gray-800
                        "
                    >
                        Nuestros Servicios
                    </h2>
                    <div class="w-full mb-4">
                        <div
                            class="
                                gradient-green
                                h-1
                                mx-auto
                                w-64
                                opacity-75
                                my-0
                                py-0
                                rounded-t
                            "
                        ></div>
                    </div>

                    <br>

                    <div class="flex flex-wrap">
                        <div class="w-5/6 sm:w-1/2 p-6">
                        <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                            Lorem ipsum dolor sit amet
                        </h3>
                        <p class="text-gray-600 mb-8">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                            at ipsum eu nunc commodo posuere et sit amet ligula.<br /><br />

                            Images from:
                            <a class="text-orange-500 underline" href="https://undraw.co/">undraw.co</a>
                        </p>
                        </div>
                        <div class="w-full sm:w-1/2 p-6">
                            <img :src="imagePath" alt="" class="w-full h-auto mx-auto">
                        </div>
                    </div>

                    <div class="flex flex-wrap flex-col-reverse sm:flex-row">
                        <div class="w-full sm:w-1/2 p-6 mt-6">
                            <img :src="imagePath" alt="" class="w-full h-auto mx-auto">
                        </div>
                        <div class="w-full sm:w-1/2 p-6 mt-6">
                        <div class="align-middle">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                            Lorem ipsum dolor sit amet
                            </h3>
                            <p class="text-gray-600 mb-8">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                            at ipsum eu nunc commodo posuere et sit amet ligula.<br /><br />
                            Images from:
                            <a class="text-orange-500 underline" href="https://undraw.co/">undraw.co</a>
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Final de Sección -->
        </template>
    </MainLayout>
</template>

<style></style>
