<template>
    <MainLayout>
        <template #main>

            <Head title="Detalle del Producto" />

            <loading
                :active="isLoading"
                :is-full-page="fullPage"
            ></loading>

            <!-- Sección -->
            <section class="bg-white border-b py-3">
                <div class="container max-w-5xl mx-auto m-8">
                    <h2 class="w-full my-2 text-5xl font-black leading-tight text-center text-gray-800">
                        Detalle del Producto
                    </h2>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>

                    <br>

                    <div class="lg:w-1/2 lg:mr-8 mb-4">
                        <img
                            :src="`/storage/${product.image_urls[0]}`"
                            alt="Imagen de portada"
                            class="w-full h-auto"
                        />
                    </div>

                    <!-- Detalles del producto -->
                    <div class="lg:w-1/2">
                        <h1 class="text-3xl font-bold mb-2">{{ product.name }}</h1>
                        <p class="text-gray-600 mb-4">{{ product.description }}</p>

                        <div class="mb-4">
                            <p class="text-lg font-bold text-gray-800">Precio: ${{ product.price }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-lg font-bold text-gray-800">Categorías:</p>
                            <ul class="list-disc pl-4">
                                <li v-for="category in product.categories" :key="category.id">{{ category.name }}</li>
                            </ul>
                        </div>

                        <div class="mb-4">
                            <p class="text-lg font-bold text-gray-800">Géneros:</p>
                            <ul class="list-disc pl-4">
                                <li v-for="gender in product.genders" :key="gender.id">{{ gender.name }}</li>
                            </ul>
                        </div>

                        <!-- Otras secciones de detalles según tus necesidades -->

                        <!-- Botón de agregar al carrito -->
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
            </section>
        </template>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);

const props = defineProps({
    product: { type: Object, required: true },
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