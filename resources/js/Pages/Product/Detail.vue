<template>
    <MainLayout>
        <template #main>

            <Head :title="product.name" />
            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <!-- Sección -->
            <section class="gradient border-b py-3">
                <!-- Notificación del carrito -->
                <Link :href="route('shopping-cart')">
                <div v-if="arrayProducts.length > 0" class="container max-w-5xl mx-auto m-8" role="alert">
                    <div class="
                                relative block w-full p-4 mb-4 text-base
                                leading-5 text-white gradient-green rounded-lg
                                opacity-100 font-regular
                            ">
                        <i class="fa fa-shopping-cart fa-lg ollapsed"></i>
                        Ha agregado Productos al carrito.
                    </div>
                </div>
                </Link>
                <ErrorList v-if="errors.length > 0" :errors="errors" @clear-errors="clearErrors" />
                <div class="container max-w-7xl mx-auto m-8">
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
                        {{ product.name }}
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
                            ">
                        </div>
                    </div>

                    <br>

                    <div
                        class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-2"
                    >
                        <!-- Columna izquierda -->
                        <div>
                            <img
                                v-for="(imageUrl, index) in product.image_urls"
                                :key="index" :src="`/storage/${imageUrl}`"
                                alt="Imagen del producto"
                                class="h-auto"
                                style="padding: 20px;"
                            />
                        </div>
                        <!-- Final de Columna izquierda -->

                        <!-- Columna derecha -->
                        <div
                            style="
                                padding: 10px;
                                color: #82675C;
                            "
                        >
                            <!-- Detalles del producto -->
                            <h1 class="text-3xl font-bold mb-2">{{ product.name }}</h1>
                            <p class="mb-4 text-justify" style="">
                                <span
                                    v-html="product.description"
                                    style="line-height: 1.2em;"
                                ></span>
                            </p>
                            <div class="flex space-x-2" style="line-height: 1.2em;">
                                <span>Marca: </span>
                                <span>
                                    {{ product?.brand.name }}
                                </span>
                            </div>
                            <div class="flex space-x-2" style="line-height: 1.2em;">
                                <span>Clase:</span>
                                <span>
                                    {{ product?.primary_class.name }}
                                </span>
                            </div>
                            <div class="flex space-x-2" style="line-height: 1.2em;">
                                <span>Subclase:</span>
                                <div v-for="(category, index) of product.categories" :key="index">
                                    {{ category.name }}
                                </div>
                            </div>
                            <div class="flex space-x-2" style="line-height: 1.2em;">
                                <span>Cuota:</span>
                                <div v-for="(gender, index) of product.genders" :key="index">
                                    {{ gender.name }}
                                </div>
                            </div>
                            <div class="flex space-x-2" style="line-height: 1.2em;">
                                <span>Presentación:</span>
                                <div v-for="(measure, index) of product.measures" :key="index">
                                    <span v-if="measure.quantity > 0">
                                        {{ measure.quantity }}
                                    </span>
                                    {{ measure.unit }}
                                    {{ measure.size }}
                                </div>
                            </div>
                            <div class="flex space-x-2" style="line-height: 1.2em;">
                                <span>Tipo de venta:</span>
                                <span>
                                    {{ product.type_sale.name }}
                                </span>
                            </div>
                            <h2 class="
                                    w-full
                                    my-2
                                    text-3xl
                                    font-black
                                    leading-tight
                                ">
                                Precio: ${{ product.price }}
                            </h2>
                            <div class="flex flex-col">
                                <button
                                    @click.prevent="addProductToCart(product)"
                                    class="
                                        font-montserrat
                                        gradient-green
                                        mt-1
                                        bg-blue-500
                                        text-white
                                        py-2 px-4
                                        rounded-md
                                        hover:bg-blue-600
                                        focus:outline-none
                                        focus:border-blue-700
                                        focus:ring
                                        focus:ring-blue-200
                                        font-bold
                                    "
                                    style="width: 250px;"
                                >
                                    <i class="fa fa-shopping-cart fa-lg ollapsed"></i>
                                    Añadir al Carrito
                                </button>
                            </div>
                        </div>
                        <!-- Final Columna derecha -->
                    </div>
                </div>
            </section>
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
import ErrorList from '@/Components/ErrorList.vue';

const isLoading = ref(false);
const fullPage = ref(true);
const errors = ref([]);
const arrayProducts = ref(localStorage.arrayProducts
    ? JSON.parse(localStorage.arrayProducts) : []);

const props = defineProps({
    product: { type: Object, required: true },
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

onMounted(() => {
    // Finalizar spinner de carga.
    isLoading.value = false;
});

const addProductToCart = (product) => {
    // Obtener los datos del producto con el id especificado
    // const productData = props.products.find(product => product.id === id);

    // Verificar si hay algún producto en localStorage
    let cartProducts = JSON.parse(localStorage.arrayProducts || '[]');

    // Verificar si el producto ya está en el carrito
    const existingProductIndex = cartProducts.findIndex(
        cartProduct => cartProduct.id === product.id
    );

    if (existingProductIndex > -1 && product.stock > 0) {
        // El producto ya existe en el carrito, actualizar cantidad
        cartProducts[existingProductIndex].quantity++;
    } else if (existingProductIndex === -1 && product.stock > 0) {
        // Añadir los datos del producto al array de Productos del carrito
        cartProducts.push({ ...product, quantity: 1 });
    } else {
        errors.value.push(`No se puede agregar el producto "${product.name}"al carrito por falta de disponibilidad`);
        scrollMeTo();
    }

    // Almacenar el array de productos actualizado en localStorage
    localStorage.arrayProducts = JSON.stringify(cartProducts);

    // Actualizar arrayProducts con los nuevos datos de localStorage
    // console.log(cartProducts);
    arrayProducts.value = cartProducts;
}

const clearErrors = () => {
    errors.value = []
}
</script>