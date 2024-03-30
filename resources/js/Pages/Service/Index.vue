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

/**
 * Truncar la cantidad de caracteres ded un texto que se muestran.
*/
const truncateText = (text, maxLength) => {
    if (text.length > maxLength) {
        return text.substring(0, maxLength) + '...';
    } else {
        return text;
    }
}

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

                    <!-- posts grid-->
                    <div v-if="services.length > 0" class="
                            grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8
                        ">
                        <!-- Iterate de servicios -->
                        <template v-for="service in services" :key="service.id">
                            <Link :href="route('services.detail', service.slug)">
                                <div class="
                                    bg-white
                                    p-4 border
                                    border-gray-200
                                    rounded-lg
                                    shadow-md
                                    transition-transform
                                    hover:transform
                                    hover:scale-105
                                ">
                                    <!-- Información a la izquierda -->
                                    <div class="flex flex-col items-start">
                                        <img
                                            :src="`/storage/${service.banner}`"
                                            alt="Imagen del servicio"
                                            class="
                                            w-full mb-4
                                                rounded-md img-zoom
                                            "
                                        >
                                        <div>
                                            <h3 class="
                                                        text-lg
                                                        font-semibold
                                                        mb-2
                                                        text-gray-800
                                                    "
                                                >
                                                    {{ service.name }}
                                            </h3>
                                            <p class="text-gray-600 mb-4 text-justify">
                                                <span v-html="truncateText(service.description, 200)"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </Link>
                        </template>
                        <!-- Fin de la iteración de los servicios-->
                    </div>
                    <h2 v-else class="
                            w-full
                            my-2 text-5xl
                            font-black
                            leading-tight
                            text-center text-gray-800
                        ">
                        No hay servicios disponibles
                    </h2>
                </div>
            </section>
            <!-- Final de Sección -->
        </template>
    </MainLayout>
</template>

<style></style>
