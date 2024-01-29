<template>
    <div>

        <Head title="Productos" />

        <!-- Sección Productos -->
        <section class="bg-white border-b py-12">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
                    Nuestros Productos
                </h2>

                <!-- Grid de productos -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Itera sobre los productos -->
                    <template v-for="product in products" :key="product.id">
                        <div
                            class="bg-white p-4 border border-gray-200 rounded-lg shadow-md transition-transform hover:transform hover:scale-105">
                            <!-- Información a la izquierda -->
                            <div class="flex flex-col items-start">
                                <img :src="`/storage/${product.image_urls[0]}`" alt="Imagen del producto"
                                    class="w-full h-40 object-cover mb-4 rounded-md">
                                <div>
                                    <Link :href="route('products.showDetail', product.id)">
                                    <h3 class="text-lg font-semibold mb-2 text-gray-800">{{ product.name }}</h3>
                                    </Link>

                                    <p class="text-gray-600 mb-4">{{ product.description }}</p>
                                    <div class="flex space-x-2">
                                        <div v-for="(category, index) of product.categories" :key="index"
                                            class="text-gray-600">
                                            {{ category.name }}
                                        </div>
                                    </div>
                                    <div class="flex space-x-2 mt-2">
                                        <div v-for="(gender, index) of product.genders" :key="index" class="text-gray-600">
                                            {{ gender.name }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Precio y botón a la derecha -->
                                <div class="flex flex-col items-end">
                                    <p class="text-gray-700 font-semibold mb-2 text-xl">${{ product.price }}</p>
                                    <button
                                        class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200">
                                        Añadir al carrito
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- Fin de la iteración de productos -->
                </div>

                <!-- Fin del grid de productos -->
            </div>
        </section>
        <!-- Final Sección Productos -->
    </div>
</template>
  
<script setup>
import { onMounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const products = ref([]);

onMounted(async () => {
    const response = await axios.get("/api/products");
    products.value = response.data;
});
</script>
  