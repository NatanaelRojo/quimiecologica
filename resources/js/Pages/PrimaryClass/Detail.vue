<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);

const Logo_Q_black = '/images/Logo-Q-black.png';

const props = defineProps({
    primary_class: { type: Object, required: true },
    filter_parameters: { type: Object, required: true },
});

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
    // Finalizar spinner de carga.
    isLoading.value = false;
});
</script>

<template>
    <MainLayout>
        <template #main>

            <Head title="Nuestras Subclases" />

            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <!-- Sección -->
            <section class="gradient border-b py-3" style="min-height: 500px">
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
                        Nuestras subclases de {{ primary_class.name }}
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
                    <div v-if="primary_class.categories.length > 0" class="
                            grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8
                        ">
                        <!-- Iterate de servicios -->
                        <template v-for="(category, index) in primary_class.categories" :key="index">
                            <Link
                                :href="route('categories.detail', category.slug)"
                                :data="{ ...filter_parameters, category: category.name }"
                            >
                                <div
                                    class="
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
                                        <div v-if="category.logo_url">
                                            <img
                                                :src="`/storage/${category.logo_url}`"
                                                alt="Imagen"
                                                class="
                                                    w-full
                                                    mb-4
                                                    rounded-md
                                                    img-zoom
                                                "
                                            >
                                        </div>
                                        <div v-else>
                                            <img
                                                :src="Logo_Q_black"
                                                alt="Imagen"
                                                class="
                                                    w-full
                                                    mb-4
                                                    rounded-md
                                                    img-zoom
                                                "
                                            >
                                        </div>
                                        <div>
                                            <h3 class="
                                                            text-lg
                                                            font-semibold
                                                            mb-2
                                                            text-gray-800
                                                        ">
                                                {{ category.name }}
                                            </h3>
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
