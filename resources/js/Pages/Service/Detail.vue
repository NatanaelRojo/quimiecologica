<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3'
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';

const isLoading = ref(false);
const fullPage = ref(true);

const props = defineProps({
    service: { required: true, type: Object },
});

const goBack = () => {
    window.history.back();
}

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

            <Head title="Detalle del servicio" />

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
                        {{ service.name }}
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

                    <div class="lg:w-1/2 lg:mr-8 mb-4">
                        <img :src="`/storage/${service.banner}`" alt="Imagen de portada"
                            class="w-full h-auto img-zoom" />
                    </div>

                    <!-- Detalles del servicio -->
                    <div class="lg:w-1/2">
                        <h1 class="text-3xl font-bold mb-2">{{ service.name }}</h1>
                        <p class="text-gray-600 mb-4 text-justify">
                            <span v-html="service.description"></span>
                        </p>
                        <p class="text-gray-600 mb-4 text-justify">
                            <b>Precio:</b> ${{ service.price }}
                        </p>
                        <!-- Condiciones -->
                        <div v-if="service.conditions && service.conditions.length > 0">
                            <h2>Condiciones:</h2>
                            <ul>
                                <li v-for="(condition, index) in service.conditions" :key="index">
                                    <b>{{ condition }}</b>
                                </li>
                            </ul>
                        </div>
                        <div v-else>
                            No hay condiciones
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </MainLayout>
</template>
