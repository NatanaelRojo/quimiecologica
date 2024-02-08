<template>
    <MainLayout>
        <template #main>

            <Head title="Detalle de la Publicación" />

            <loading
                :active="isLoading"
                :is-full-page="fullPage"
            ></loading>

            <!-- Sección Servicios -->
            <section class="bg-gray-100 border-b py-3">
                <div class="container max-w-5xl mx-auto m-8">
                    <h2 class="w-full my-2 text-5xl font-black leading-tight text-center text-gray-800">
                        Detalle de la Publicación
                    </h2>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>

                    <br>

                    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
                        <!-- Thumbnail grande como portada del blog -->
                        <img :src="`/storage/${post.thumbnail}`" alt="Thumbnail del Blog"
                            class="w-full h-auto mb-6 rounded-lg max-h-96">

                        <!-- Título del blogpost -->
                        <h1 class="text-3xl font-bold mb-4">{{ post.title }}</h1>

                        <!-- Cuerpo del blogpost -->
                        <div class="text-gray-700 text-lg mb-6" v-html="post.body"></div>

                        <!-- Categorías del blogpost -->
                        <div class="mb-4">
                            <span class="text-gray-600">Categorías: </span>
                            <span v-for="(category, index) in post.categories" :key="index" class="mr-2">{{ category.name
                            }}</span>
                        </div>

                        <!-- Géneros del blogpost -->
                        <div class="mb-6">
                            <span class="text-gray-600">Géneros: </span>
                            <span v-for="(gender, index) in post.genders" :key="index" class="mr-2">{{ gender.name }}</span>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);

const props = defineProps({
    post: { type: Object, required: true },
});

onBeforeMount(async () => {
    // Iniciar spinner de carga.
    isLoading.value = true;
});

onMounted(async () => {
    // Finalizar spinner de carga.
    isLoading.value = false;
});
</script>