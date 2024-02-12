<template>
    <MainLayout>
        <template #main>

            <Head title="Nuestros Productos" />

            <loading
                :active="isLoading"
                :is-full-page="fullPage"
                color="#82675C"
            ></loading>

            <!-- Sección -->
            <section class="bg-white border-b py-3">
                <div class="container max-w-5xl mx-auto m-8">
                    <h2
                        class="
                            w-full
                            my-2
                            text-5xl
                            font-black
                            leading-tight
                            text-center
                            text-gray-800
                        "
                    >
                        Nuestros Productos
                    </h2>
                    <div class="w-full mb-4">
                        <div
                            class="
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

                    <!-- Buscador y Filtros -->
                    <section>
                        <h2>Buscar producto:</h2>
                        <input v-model="productName" type="text" placeholder="Ingrese el nombre de un producto">
                        <button type="button" @click="filterProductByName">Buscar</button>
                        <h3>Filtros</h3>
                        <div>
                            <label for="product-price">Precio</label>
                            <input type="number" id="product-price" name="product-price" v-model="productPrice"
                                placeholder="Ingrese el precio del producto" min="1">
                            <select v-model="selectedProductPriceFilter" id="price-filter">
                                <option value="" disabled selected>Seleccione un rango de precios...</option>
                                <option value="gte">Mayor o igual a ${{ productPrice }}</option>
                                <option value="lte">Menor o igual a ${{ productPrice }}</option>
                            </select>
                            <p>{{ selectedProductPriceFilter }}</p>

                            <h2>Categorias</h2>
                            <select v-model="selectedCategories" multiple>
                                <option value="" disabled selected>Seleccione</option>
                                <option v-for="category in categories" :key="category.id" :value="category.name">{{
                                    category.name }}</option>
                            </select>
                            <h3>{{ selectedCategories }}</h3>
                            <h2>Generos:</h2>
                            <select v-model="selectedGenders" multiple>
                                <option value="" disabled selected>Seleccione</option>
                                <option v-for="gender in genders" :key="gender.id" :value="gender.name">{{ gender.name
                                }}
                                </option>
                            </select>
                            <h3>{{ selectedGenders }}</h3>
                            <button type="button" @click="filterProduct">Aplicar</button>
                        </div>
                    </section>
                    <!-- Final Buscador y Filtros -->

                    <!-- Grid de productos -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Itera sobre los productos -->
                        <template v-for="product in products" :key="product.id">
                            <div class="
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
                                <!-- Información a la izquierda -->
                                <div class="flex flex-col">
                                    <img
                                        :src="`/storage/${product.image_urls[0]}`"
                                        alt="Imagen del producto"
                                        class="w-full h-40 object-cover mb-4 rounded-md"
                                    >
                                    <div>
                                        <Link
                                            :href="
                                                route(
                                                    'products.detail',
                                                    product.slug
                                                )
                                            "
                                        >
                                            <h3 class="
                                                    text-lg
                                                    font-semibold
                                                    mb-2
                                                    text-gray-800
                                                "
                                            >
                                                {{ product.name }}
                                            </h3>
                                        </Link>

                                        <p class="text-gray-600 mb-4">
                                            {{ product.description }}
                                        </p>

                                        <div class="flex space-x-2">
                                            <div
                                                v-for="
                                                    (category, index) of product.categories
                                                "
                                                :key="index"
                                                class="text-gray-600"
                                            >
                                                Categorías: {{ category.name }}
                                            </div>
                                        </div>
                                        <div class="flex space-x-2 mt-2">
                                            <div
                                                v-for="
                                                    (gender, index) of product.genders
                                                "
                                                :key="index"
                                                class="text-gray-600"
                                            >
                                                Géneros: {{ gender.name }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Precio y botón a la derecha -->
                                    <p
                                        class="
                                            mt-2
                                            text-gray-700
                                            font-semibold
                                            text-xl
                                        "
                                    >
                                        Precio: ${{ product.price }}
                                    </p>
                                    <div class="flex flex-col items-center">
                                        <button
                                            class="
                                                gradient-green
                                                mt-4
                                                bg-blue-500
                                                text-white
                                                py-2 px-4
                                                rounded-md
                                                hover:bg-blue-600
                                                focus:outline-none
                                                focus:border-blue-700
                                                focus:ring
                                                focus:ring-blue-200
                                            "
                                        >
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
        </template>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { onMounted, onBeforeMount, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import axios from 'axios';

const isLoading = ref(false);
const selectedCategories = ref([]);
const selectedGenders = ref([]);
const selectedProductPriceFilter = ref('');
const productName = ref('');
const productPrice = ref(1);
const fullPage = ref(true);
const products = ref([]);
const categories = ref([]);
const genders = ref([]);

onBeforeMount(async () => {
    // Iniciar spinner de carga.
    isLoading.value = true;
});

onMounted(async () => {
    let response = await axios.get("/api/products");
    products.value = response.data;
    response = await axios.get('/api/categories');
    categories.value = response.data;
    response = await axios.get('/api/genders');
    genders.value = response.data;
    // Finalizar spinner de carga.
    isLoading.value = false;
});

const filterProductByName = async () => {
    try {
        const response = await axios.get('/api/products', {
            params: {
                name: productName.value,
            },
        });
        products.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

const filterProduct = async () => {
    try {
        const response = await axios.get('/api/products', {
            params: {
                categories: selectedCategories.value.join(','),
                genders: selectedGenders.value.join(','),
                productPrice: productPrice.value,
                priceFilter: selectedProductPriceFilter.value,
            },
        });
        products.value = response.data;
    } catch (error) {
        console.error(error);
    }
}
</script>
