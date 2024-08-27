<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { onMounted, onBeforeMount, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import axios from 'axios';
import TextInput from '@/Components/TextInput.vue';
import ErrorList from '@/Components/ErrorList.vue';

const isLoading = ref(false);
const fullPage = ref(true);
const brands = ref([]);

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
        const response = await axios.get('/api/brands');
        brands.value = response.data.records;
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
            <Head title="Nuestras Marcas" />
            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <!-- Sección -->
            <section class="gradient border-b py-3">
                <div class="container max-w-5xl mx-auto m-8">
                    <a href="#" class="font-montserrat" @click.prevent="goBack">
                        <i class="fa fa-chevron-left fa-lg ollapsed"></i> Atrás
                    </a>
                    <h2
                        class="
                            font-montserrat
                            w-full
                            my-2
                            text-5xl
                            font-black
                            leading-tight
                            text-center
                            text-gray-800
                        "
                    >
                        Nuestras marcas
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
                            "
                        ></div>
                    </div>
                    <br>
                    <div
                        class="
                            grid grid-cols-1 sm:grid-cols-2
                            lg:grid-cols-3 gap-8
                        "
                    >
                        <div
                            v-for="(brand, index) in brands"
                            :key="index"
                            style="max-width: 200px;"
                            class="
                                bg-white
                                p-4 border
                                border-gray-200
                                rounded-lg
                                shadow-md
                                transition-transform
                                hover:transform
                                hover:scale-105
                            "
                        >
                            <Link :href="route('brands.detail', brand.slug)">
                                <img
                                    :src="`/storage/${brand.logo_url}`"
                                    class="
                                        w-full h-50 object-cover mb-4
                                        rounded-md img-zoom
                                    "
                                >
                                <div>
                                    <h3
                                        class="
                                            text-lg
                                            font-semibold
                                            mb-2
                                            text-gray-800
                                            text-center
                                        "
                                    >
                                        {{ brand.name }}
                                    </h3>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </MainLayout>
</template>