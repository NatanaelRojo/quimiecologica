<template>
    <Head title="Detalle del Producto" />

    <NavBar />

    <section class="bg-white border-b py-12">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
                Detalle del Producto
            </h2>
            <br>
            <div class="lg:w-1/2 lg:mr-8 mb-4">
                <img :src="`/storage/${product.image_urls[0]}`" alt="Imagen de portada" class="w-full h-auto">
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

<script setup>
import NavBar from '@/Layouts/NavBar.vue';
import { onMounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    product: { type: Object, required: true },
});
</script>