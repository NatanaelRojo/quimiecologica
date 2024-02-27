<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import axios from 'axios';

const isLoading = ref(false);
const fullPage = ref(true);
const arrayProducts = ref(localStorage.arrayProducts
    ? JSON.parse(localStorage.arrayProducts) : []);

const record = ref({
    firstname: '',
    lastname: '',
    total: '',
});

/**
 * Método que permite enviar los datos de la orden de compra al api.
*/
const createPurchaseOrder = async () => {
    try {
        const purchaseOrderData = {
            owner_firstname: 'Natanael',
            owner_lastname: 'Rojo',
            owner_id: '26488388',
            owner_phone_number: '+58 4147453112',
            owner_state: 'Merida',
            owner_city: 'Merida',
            owner_address: 'Merida',
            total_price: 200,
        }
        const response = await axios.post(
            '/api/purchase-orders',
            purchaseOrderData
        );
    } catch (error) {
        console.error(error);
    }
}

onBeforeMount(async () => {
    // Iniciar spinner de carga.
    isLoading.value = true;
});

onMounted(async () => {
    // Finalizar spinner de carga.
    isLoading.value = false;
});

/**
 * Método que permite eliminar un producto del carrito.
*/
const removeProductFromCart = (id) => {
    // Encontrar el índice del producto con el id especificado.
    const index = arrayProducts.value.findIndex(product => product.id === id);

    // Eliminar el producto del array de productos del carrito.
    if (index !== -1) {
        arrayProducts.value.splice(index, 1);

        // Actualizar el array de productos en localStorage.
        localStorage.arrayProducts = JSON.stringify(arrayProducts.value);
    }
}

/**
 * Método para calcular el precio total de todos los productos en el carrito.
*/
const calculateTotalPrice = () => {
    let totalPrice = 0;

    // Iterar sobre todos los productos en el carrito.
    for (let i = 0; i < arrayProducts.value.length; i++) {
        // Sumar el precio del producto actual al precio total.
        totalPrice += arrayProducts.value[i].price;
    }

    // Asignar el valor del total.
    record.value.total = totalPrice;

    // Devolver el precio total.
    return totalPrice;
}

/**
 * Método que permite crear la orden de compra.
*/
const createRecord = () => {
    console.log(record.value.firstname);
    console.log(record.value.lastname);
    console.log(record.value.total);
}

/**
 * Limpiar el Carrito de compras.
*/
const cleanForm = () => {
    if (localStorage.arrayProducts) {
        localStorage.removeItem('arrayProducts');
        location.reload();
    }
}
</script>

<template>
    <MainLayout>
        <template #main>

            <Head title="Productos en el Carrito" />

            <loading
                :active="isLoading"
                :is-full-page="fullPage"
                color="#82675C"
            ></loading>

            <!-- Sección -->
            <section class="bg-white border-b py-3">
                <div class="container max-w-5xl mx-auto m-4">
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
                        Productos en el Carrito
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
                    <!-- Inicio del formulario -->
                    <form
                        v-if="arrayProducts.length > 0"
                        class="
                            p-4 border
                            border-gray-200
                            rounded-lg
                            shadow-md
                        "
                        @submit.prevent="createRecord"
                    >
                        <!-- Listado de Productos añadidos al carrito -->
                        <div class="flex flex-wrap">
                            <div>
                                <div
                                    class="
                                        grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8
                                    "
                                >
                                    <!-- Carrito de Compras -->
                                    <template
                                        v-for="product in arrayProducts"
                                        :key="product.id"
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
                                                        <h3
                                                            class="
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
                                                                (category, index)
                                                                    of product.categories
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
                                                                (gender, index)
                                                                    of product.genders
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
                                                        @click="removeProductFromCart(product.id)"
                                                        class="
                                                            font-montserrat
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
                                                            font-bold
                                                        "
                                                    >
                                                        <i class="fa fa-remove fa-lg ollapsed"></i>
                                                        Eliminar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <!-- Final del carrito de Compras -->
                                </div>
                                <hr class="mt-5 mb-5">
                                <h2
                                    class="
                                        w-full
                                        my-2
                                        text-5xl
                                        font-black
                                        leading-tight
                                        text-gray-800
                                    "
                                >
                                    Total: {{ calculateTotalPrice() }}$
                                </h2>
                            </div>
                        </div>
                        <!-- Final del listado de Productos añadidos al carrito -->

                        <br>

                        <!-- Datos del Comprador -->
                        <div>
                            <div class="mb-4">
                                <label
                                    for="firstname"
                                    class="block text-gray-700 text-sm font-bold mb-2"
                                >
                                    Nombres:</label>
                                <input
                                    type="text"
                                    v-model="record.firstname"
                                    name="firstname"
                                    class="w-full px-3 py-2 border rounded"
                                >
                            </div>
                            <div class="mb-4">
                                <label
                                    for="lastname"
                                    class="block text-gray-700 text-sm font-bold mb-2"
                                >
                                    Apellidos:</label>
                                <input
                                    type="text"
                                    v-model="record.lastname"
                                    name="lastname"
                                    class="w-full px-3 py-2 border rounded"
                                >
                            </div>
                        </div>
                        <!-- Final de Datos del Comprador -->

                        <!-- Botón Limpiar -->
                        <div class="text-center">
                            <button
                                @click="cleanForm()"
                                v-if="arrayProducts.length > 0"
                                class="
                                    font-montserrat
                                    gradient-green
                                    mt-4
                                    mr-2
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
                            >
                                <i class="fa fa-remove fa-lg ollapsed"></i>
                                LIMPIAR
                            </button>
                            <button
                                v-if="arrayProducts.length > 0"
                                class="
                                    font-montserrat
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
                                    font-bold
                                "
                            >
                                <i class="fa fa-check fa-lg ollapsed"></i>
                                COMPRAR
                            </button>
                        </div>
                        <!-- Final del Botón Comprar -->
                    </form>
                    <!-- Final del formulario -->
                    <div
                        v-else
                        class="
                            mt-8
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
                        <h2
                            class="
                                w-full
                                text-2xl
                                font-black
                                leading-tight
                                text-center text-gray-800
                            "
                        >
                            No hay productos añadidos en el
                            <i class="fa fa-shopping-cart fa-lg ollapsed"></i>
                        </h2>
                    </div>
                </div>
            </section>
            <!-- Final Sección -->
        </template>
    </MainLayout>
</template>
