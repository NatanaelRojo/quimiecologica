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
            <section class="gradient border-b py-3">
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

                    <div class="lg:w-1/2 lg:mr-8 mb-6">
                        <img :src="`/storage/${service.banner}`" alt="Imagen de portada"
                            class="w-full h-auto img-zoom" />
                    </div>

                    <!-- Detalles del servicio -->
                    <div class="">
                        <h1 class="text-3xl font-bold mb-2">{{ service.name }}</h1>
                        <p class="text-gray-600 mb-4 text-justify">
                            <span v-html="service.description"></span>
                        </p>
                        <!-- Condiciones -->
                        <div v-if="service?.conditions && Object.keys(service.conditions).length > 0">
                            <b>Condiciones:</b>
                            <br class="mb-3">
                            <ul>
                                <template v-for="(description, condition, index) in service.conditions" :key="index">
                                    <li class="mb-2 text-gray-600">
                                        <b>{{ condition }}:</b>
                                        <p>{{ description }}</p>
                                    </li>
                                </template>
                            </ul>
                        </div>
                        <div v-else>
                            No hay condiciones
                        </div>
                        <hr class="mt-2 mb-2">
                        <h1 class="text-gray-600 text-justify text-3xl font-bold">
                            <b>Precio:</b> ${{ service.price }}
                        </h1>
                    </div>
                </div>
            </section>
        </template>
    </MainLayout>
</template>
