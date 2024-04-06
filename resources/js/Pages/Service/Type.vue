<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);
const serviceTypes = ref([]);

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
        const response = await axios.get('/api/service-types');
        serviceTypes.value = response.data;
    } catch (error) {
        console.log(error);
    }
    // Finalizar spinner de carga.
    isLoading.value = false;
});
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
                        Nuestros servicios
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
                    <ul>
                        <li v-for="(serviceType, index) in serviceTypes" :key="index">
                            <Link :href="route('serviceType', serviceType.slug)">
                            {{ serviceType.name }}
                            </Link>
                        </li>
                    </ul>
                </div>
            </section>
        </template>
    </MainLayout>
</template>