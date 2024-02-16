<template>
    <MainLayout>
        <template #main>

            <Head title="Nuestros Productos" />

            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <!-- Sección -->
            <section class="bg-white border-b py-3">
                <!-- Notificación del carrito -->
                <div v-if="arrayProducts.length > 0" class="container max-w-5xl mx-auto m-8" role="alert">
                    <div class="
                            relative block w-full p-4 mb-4 text-base
                            leading-5 text-white gradient-green rounded-lg
                            opacity-100 font-regular
                        ">
                        <i class="fa fa-shopping-cart fa-lg ollapsed"></i>
                        Ha agregado Productos al Carrito de compras.
                    </div>
                </div>
                <!-- Final de Notificación del carrito -->
                <div class="container max-w-5xl mx-auto m-8">
                    <h2 class="
                            w-full
                            my-2
                            text-5xl
                            font-black
                            leading-tight
                            text-center
                            text-gray-800
                        ">
                        Nuestros Productos
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

                    <!-- Buscador y Filtros -->
                    <section class="mb-4">
                        <h2>Buscar por Nombre:</h2>
                        <TextInput v-model="productName" type="text" placeholder="" />
                        <br>
                    </section>
                    <div>
                        <label for="product-price">Precio</label>
                        <input type="number" id="product-price" name="product-price" v-model="productPrice"
                            placeholder="Ingrese el precio del producto" min="1">
                        <select v-model="selectedProductPriceFilter" id="price-filter">
                            <option value="" disabled selected>Seleccione un rango de precios...</option>
                            <option value="gte">Mayor o igual a ${{ productPrice }}</option>
                            <option value="lte">Menor o igual a ${{ productPrice }}</option>
                        </select>
                        <h2>Categorias</h2>
                        <select v-model="selectedCategories" multiple>
                            <option value="" disabled selected>Seleccione</option>
                            <option v-for="category in categories" :key="category.id" :value="category.name">{{
                                category.name }}</option>
                        </select>
                        <h2>Generos:</h2>
                        <select v-model="selectedGenders" multiple>
                            <option value="" disabled selected>Seleccione</option>
                            <option v-for="gender in genders" :key="gender.id" :value="gender.name">{{ gender.name
                            }}
                            </option>
                        </select>
                        <button class="
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
                            " type="button" @click="filterProducts">
                            Buscar
                        </button>
                        <button class="
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
                            " type="button" @click="clearFilters">
                            Limpiar
                        </button>
                    </div>
                    <!-- Final Buscador y Filtros -->

                    <!-- Grid de productos -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Itera sobre los productos -->
                        <template v-if="products.length > 0" v-for="product in products" :key="product.id">
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
                                <div class="flex flex-col">
                                    <img :src="`/storage/${product.image_urls[0]}`" alt="Imagen del producto"
                                        class="w-full h-40 object-cover mb-4 rounded-md">
                                    <div>
                                        <Link :href="route(
                                            'products.detail',
                                            product.slug
                                        )
                                            ">
                                        <h3 class="
                                                    text-lg
                                                    font-semibold
                                                    mb-2
                                                    text-gray-800
                                                ">
                                            {{ product.name }}
                                        </h3>
                                        </Link>

                                        <p class="text-gray-600 mb-4">
                                            {{ product.description }}
                                        </p>

                                        <div class="flex space-x-2">
                                            <div v-for="
                                                    (category, index) of product.categories
                                                " :key="index" class="text-gray-600">
                                                Categorías: {{ category.name }}
                                            </div>
                                        </div>
                                        <div class="flex space-x-2 mt-2">
                                            <div v-for="
                                                    (gender, index) of product.genders
                                                " :key="index" class="text-gray-600">
                                                Géneros: {{ gender.name }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Precio y botón a la derecha -->
                                    <p class="
                                            mt-2
                                            text-gray-700
                                            font-semibold
                                            text-xl
                                        ">
                                        Precio: ${{ product.price }}
                                    </p>
                                    <div class="flex flex-col items-center">
                                        <<<<<<< HEAD <button class="
    =======
                                            <button
                                                @click=" addProductToCart(product.id)" class="
    >>>>>>> 6a1e1d9c8a1fcbef18e748b2ef82e4b7557a926d
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
                                                ">
                                            <i class="fa fa-shopping-cart fa-lg ollapsed"></i>
                                            Añadir al Carrito
                                            </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <h2 v-else class="
                            w-full
                            my-2
                            text-5xl
                            font-black
                            leading-tight
                            text-center
                            text-gray-800
                        ">
                            No se encontraron productos
                        </h2>
                        <!-- Fin de la iteración de productos -->
                    </div>
                    <<<<<<< HEAD=======<!-- Fin del grid de productos -->

                        <!-- Carrito de Compras -->
                        <div>
                            <h2 class="
                                w-full
                                my-2
                                text-5xl
                                font-black
                                leading-tight
                                text-center
                                text-gray-800
                            ">
                                Productos en el Carrito
                            </h2>
                            <ul>
                                <li v-for="(product, index) in arrayProducts" :key="index">
                                    {{ product.name }} - ${{ product.price }}
                                    <button @click="removeProductFromCart(product.id)">
                                        Eliminar
                                    </button>
                                </li>
                            </ul>
                            <p>Total: ${{ calculateTotalPrice() }}</p>
                        </div>
                        <!-- Final del carrito de Compras -->
                        >>>>>>> 6a1e1d9c8a1fcbef18e748b2ef82e4b7557a926d
                </div>
                <!-- Fin del grid de productos -->
            </section>
            <!-- Final Sección -->
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
import TextInput from '@/Components/TextInput.vue';

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
const arrayProducts = ref([]);

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

const filterProducts = async () => {
    try {
        const queryParams = {
            name: productName.value,
            categories: selectedCategories.value.join(','),
            genders: selectedGenders.value.join(','),
            price: productPrice.value,
            priceFilter: selectedProductPriceFilter.value,
        }
        const response = await axios.get('/api/products', {
            params: queryParams,
        });
        products.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

const clearFilters = async () => {
    try {
        productName.value = '';
        selectedCategories.value = [];
        selectedGenders.value = [];
        productPrice.value = 1;
        selectedProductPriceFilter.value = '';
        const response = await filterProducts();
        products.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

/**
 * Método que recibe el id del producto y lo agrega en el arreglo de Productos.
*/
const addProductToCart = (id) => {
    // Obtener los datos del producto con el id especificado
    const productData = products.value.find(product => product.id === id);

    // Añadir los datos del producto al array de Productos del carrito.
    arrayProducts.value.push(productData);
}

/**
 * Método que permite eliminar un producto del carrito.
*/
const removeProductFromCart = (id) => {
    // Encontrar el índice del producto con el id especificado
    const index = arrayProducts.value.findIndex(product => product.id === id);

    // Eliminar el producto del array de productos del carrito
    if (index !== -1) {
        arrayProducts.value.splice(index, 1);
    }
}

/**
 * Método para calcular el precio total de todos los productos en el carrito.
*/
const calculateTotalPrice = () => {
    // Inicializar el precio total
    let totalPrice = 0;

    // Iterar sobre todos los productos en el carrito
    for (let i = 0; i < arrayProducts.value.length; i++) {
        // Sumar el precio del producto actual al precio total
        totalPrice += arrayProducts.value[i].price;
    }

    // Devolver el precio total
    return totalPrice;
}
</script>
