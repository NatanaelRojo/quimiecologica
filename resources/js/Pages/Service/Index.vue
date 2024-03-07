<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);
const imagePath = '/images/1.jpg';

/**
 * Regresar al componente anterior.
*/
const goBack = () => {
    window.history.back();
}

onBeforeMount(async () => {
    // Iniciar spinner de carga.
    isLoading.value = true;
});

onMounted(async () => {
    try {
        const response = await axios.get('/api/services');
        services.value = response.data;
    } catch (error) {
        console.log(error);
    }
    // Finalizar spinner de carga.
    isLoading.value = false;
});

const services = ref([]);
</script>

<template>
    <MainLayout>
        <template #main>

            <Head title="Nuestros Servicios" />

            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <!-- Sección -->
            <section class="bg-white border-b py-3">
                <div class="container max-w-5xl mx-auto m-8">
                    <a href="#" class="font-montserrat" @click.prevent="goBack">
                        <i class="fa fa-chevron-left fa-lg ollapsed"></i> Atrás
                    </a>
                    <h2 class="
                            font-montserrat
                            w-full
                            my-2
                            text-5xl
                            font-black
                            leading-tight
                            text-center
                            text-gray-800
                        ">
                        Nuestros Servicios
                    </h2>
                    <div class="w-full mb-4">
                        <div class="
                                gradient-green
                                h-1
                                mx-auto
                                w-64
                                opacity-75
                                my-0
                                py-0
                                rounded-t
                            "></div>
                    </div>

                    <br>

                    <div v-if="services.length > 0" class="flex flex-wrap">
                        <template v-for="(service, index) in services" :key="index">
                            <div class="w-5/6 sm:w-1/2 p-6">
                                <Link :href="route('services.detail', service.slug)">
                                <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                                    {{ service.name }}
                                </h3>
                                </Link>
                                <p class="text-gray-600 mb-8">
                                    {{ service.description }}
                                    <br /><br />

                                    Images from:
                                    <a class="text-orange-500 underline" href="https://undraw.co/">undraw.co</a>
                                </p>
                            </div>
                            <div class="w-full sm:w-1/2 p-6">
                                <img :src="`/storage/${service.banner}`" alt="" class="w-full h-auto mx-auto">
                            </div>
                        </template>
                    </div>
                    <h2
                        v-else
                        class="
                            w-full
                            my-2 text-5xl
                            font-black
                            leading-tight
                            text-center text-gray-800
                        "
                    >
                        No hay servicios disponibles
                    </h2>
                </div>
            </section>
            <!-- Final de Sección -->
        </template>
    </MainLayout>
</template>

<style></style>
