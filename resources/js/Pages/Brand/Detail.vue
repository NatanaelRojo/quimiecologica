<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);

const props = defineProps({
    brand: { type: Object, required: true },
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

            <Head title="Nuestras Clases" />

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
                        Nuestras clases de {{ brand.name }}
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
                    <div v-if="brand.primary_classes.length > 0" class="
                            grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8
                        ">
                        <!-- Iterate -->
                        <template v-for="(primaryClass, index) in brand.primary_classes" :key="index">
                            <Link :href="route('primary-classes.detail', primaryClass.slug)"
                                :data="{ ...filter_parameters, primary_class: primaryClass.name }">
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
                                        :src="`/storage/${brand.banner}`"
                                        alt="...."
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
                                                    ">
                                            {{ primaryClass.name }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            </Link>
                        </template>
                        <!-- Fin de la iteración -->
                    </div>
                    <h2 v-else class="
                            w-full
                            my-2 text-5xl
                            font-black
                            leading-tight
                            text-center text-gray-800
                        ">
                        ...
                    </h2>
                </div>
            </section>
            <!-- Final de Sección -->
        </template>
    </MainLayout>
</template>

<style></style>
