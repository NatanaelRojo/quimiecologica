<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ErrorList from '@/Components/ErrorList.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import axios from 'axios';

const isLoading = ref(false);
const fullPage = ref(true);
const arrayProducts = ref(localStorage.arrayProducts
    ? JSON.parse(localStorage.arrayProducts) : []);
const image = ref(null);
const record = ref({
    owner_firstname: 'Natanael',
    owner_lastname: 'Rojo',
    owner_id: '26488388',
    owner_email: 'rojonatanael99@gmail.com',
    owner_phone_number: '+58 4147453112',
    owner_state: 'Merida',
    owner_city: 'Merida',
    owner_address: 'Merida',
    reference_number: '00000',
    image: '',
    total_price: '',
    products_info: [
        {
            product_id: '',
            product_quantity: '',
            sale_type: '',
            product_unit: '',
        }
    ],
});
const errors = ref([]);
const form = ref(null);

/**
 * Método que permite enviar los datos de la orden de compra al api.
*/
const createPurchaseOrder = async () => {
    try {
        const data = [
            {
                product_id: 1,
                product_quantity: '1',
                sale_type: 'Al detal',
                product_unit: 'No aplica',
            },
        ];

        const form = new FormData();

        Object.entries(record.value).forEach(([key, value]) => {
            form.append(key, value);
        });

        data.forEach(item => {
            form.append(`products_info[${item.product_id}]`, JSON.stringify(item));
        });

        const response = await axios.post('/api/purchase-orders', form);
        console.log("Guardo la orden de compra!")
        // Limpiar el Carrito de compras luego de guardar el formulario.
        cleanForm();
    } catch (error) {
        errors.value = error.response.data;
        scrollMeTo();
    }
}

const scrollMeTo = () => {
    const top = form.offsetTop;
    window.scrollTo(0, top);
}

const clearErrors = () => {
    errors.value = []
}


/**
 * Método para obtiene el archivo adjunto del campo image del formulario.
*/
const handleFileChange = (event) => {
    record.value.image = event.target.files[0];
};

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
    record.value.total_price = totalPrice;

    // Devolver el precio total.
    return totalPrice;
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

/**
 * Regresar al componente anterior.
*/
const goBack = () => {
    window.history.back();
}
</script>

<template>
    <MainLayout>
        <template #main>

            <Head title="Productos en el Carrito" />

            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <!-- Sección -->
            <section class="bg-white border-b py-3">
                <ErrorList v-if="errors.length > 0" :errors="errors" @clear-errors="clearErrors" />
                <div class="container max-w-5xl mx-auto m-4">
                    <a
                        href="#"
                        class="font-montserrat"
                        @click.prevent="goBack"
                    >
                        <i class="fa fa-chevron-left fa-lg ollapsed"></i> Atrás
                    </a>
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
                    <!-- Inicio del formulario -->
                    <form v-if="arrayProducts.length > 0" class="
                            p-4 border
                            border-gray-200
                            rounded-lg
                            shadow-md
                        " @submit.prevent="createPurchaseOrder" enctype="multipart/form-data" ref="form">
                        <!-- Listado de Productos añadidos al carrito -->
                        <div class="flex flex-wrap">
                            <div>
                                <div class="
                                        grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8
                                    ">
                                    <!-- Carrito de Compras -->
                                    <template v-for="product in arrayProducts" :key="product.id">
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
                                                <Link
                                                    :href="route(
                                                        'products.detail',
                                                        product.slug
                                                    )
                                                    "
                                                >
                                                    <img
                                                        :src="`/storage/${product.image_urls[0]}`" alt="Imagen del producto"
                                                        class="w-full h-40 object-cover mb-4 rounded-md img-zoom"
                                                    >
                                                    <div>
                                                        <h3 class="
                                                                    text-lg
                                                                    font-semibold
                                                                    mb-2
                                                                    text-gray-800
                                                                ">
                                                            {{ product.name }}
                                                        </h3>

                                                        <p class="text-gray-600 mb-4">
                                                            {{ product.description }}
                                                        </p>

                                                        <div class="flex space-x-2">
                                                            <div v-for="
                                                                    (category, index)
                                                                        of product.categories
                                                                " :key="index" class="text-gray-600">
                                                                Categorías: {{ category.name }}
                                                            </div>
                                                        </div>
                                                        <div class="flex space-x-2 mt-2">
                                                            <div v-for="
                                                                    (gender, index)
                                                                        of product.genders
                                                                " :key="index" class="text-gray-600">
                                                                Géneros: {{ gender.name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </Link>

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
                                                    <button @click="removeProductFromCart(product.id)" class="
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
                                                        ">
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
                                <h2 class="
                                        w-full
                                        my-2
                                        text-5xl
                                        font-black
                                        leading-tight
                                        text-gray-800
                                    ">
                                    Total: {{ calculateTotalPrice() }}$
                                </h2>
                            </div>
                        </div>
                        <!-- Final del listado de Productos añadidos al carrito -->

                        <br>

                        <!-- Datos del Comprador -->
                        <div>
                            <!-- Nombres -->
                            <div class="mb-4">
                                <label for="owner-firstname" class="block text-gray-700 text-sm font-bold mb-2">
                                    Nombres:
                                </label>
                                <input type="text" v-model="record.owner_firstname" id="owner-firstname"
                                    class="w-full px-3 py-2 border rounded">
                            </div>
                            <!-- Apellidos -->
                            <div class="mb-4">
                                <label for="owner-lastname" class="block text-gray-700 text-sm font-bold mb-2">
                                    Apellidos:
                                </label>
                                <input type="text" v-model="record.owner_lastname" id="owner-lastname"
                                    class="w-full px-3 py-2 border rounded">
                            </div>
                            <!-- Cédula de identidad -->
                            <div class="mb-4">
                                <label for="owner-id" class="block text-gray-700 text-sm font-bold mb-2">
                                    Cédula de identidad:
                                </label>
                                <input type="text" v-model="record.owner_id" id="owner-id"
                                    class="w-full px-3 py-2 border rounded">
                            </div>
                            <!-- Número de teléfono -->
                            <div class="mb-4">
                                <label for="owner_phone_number" class="block text-gray-700 text-sm font-bold mb-2">
                                    Número de teléfono:
                                </label>
                                <input type="text" v-model="record.owner_phone_number" id="owner_phone_number"
                                    class="w-full px-3 py-2 border rounded">
                            </div>
                            <!-- Correo electrónico -->
                            <div class="mb-4">
                                <label for="owner-email" class="block text-gray-700 text-sm font-bold mb-2">
                                    Correo electrónico:
                                </label>
                                <input type="email" v-model="record.owner_email" id="owner-email"
                                    class="w-full px-3 py-2 border rounded">
                            </div>
                            <!-- Estado de procedencia -->
                            <div class="mb-4">
                                <label for="owner-state" class="block text-gray-700 text-sm font-bold mb-2">
                                    Estado de procedencia:
                                </label>
                                <input type="text" v-model="record.owner_state" id="owner-state"
                                    class="w-full px-3 py-2 border rounded">
                            </div>
                            <!-- Ciudad de procedencia -->
                            <div class="mb-4">
                                <label for="owner-city" class="block text-gray-700 text-sm font-bold mb-2">
                                    Ciudad de procedencia:
                                </label>
                                <input type="text" v-model="record.owner_city" id="owner-city"
                                    class="w-full px-3 py-2 border rounded">
                            </div>
                            <!-- Direccion de procedencia: -->
                            <div class="mb-4">
                                <label for="owner-address" class="block text-gray-700 text-sm font-bold mb-2">
                                    Direccion de procedencia:
                                </label>
                                <input type="text" v-model="record.owner_address" id="owner-address"
                                    class="w-full px-3 py-2 border rounded">
                            </div>
                            <!-- Numero de referencia del pago -->
                            <div class="mb-4">
                                <label for="reference-number" class="block text-gray-700 text-sm font-bold mb-2">
                                    Numero de referencia del pago:
                                </label>
                                <input type="text" v-model="record.reference_number" id="reference-number"
                                    class="w-full px-3 py-2 border rounded">
                            </div>
                            <!-- Adjunte imagen o PDF del pago -->
                            <div class="mb-4">
                                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">
                                    Adjunte imagen o PDF del pago:
                                </label>
                                <input type="file" ref="image" id="image" class="w-full px-3 py-2 border rounded"
                                    @change="handleFileChange" accept="
                                        image/png,
                                        image/jpeg,
                                        image/jpg,
                                        application/pdf
                                    ">
                            </div>
                        </div>
                        <!-- Final de Datos del Comprador -->

                        <!-- Botón Limpiar -->
                        <div class="text-center">
                            <button @click="cleanForm()" v-if="arrayProducts.length > 0" class="
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
                                ">
                                <i class="fa fa-remove fa-lg ollapsed"></i>
                                LIMPIAR
                            </button>
                            <button v-if="arrayProducts.length > 0" class="
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
                                ">
                                <i class="fa fa-check fa-lg ollapsed"></i>
                                COMPRAR
                            </button>
                        </div>
                        <!-- Final del Botón Comprar -->
                    </form>
                    <!-- Final del formulario -->
                    <div v-else class="
                            mt-8
                            bg-white
                            p-4 border
                            border-gray-200
                            rounded-lg
                            shadow-md
                            transition-transform
                            hover:transform
                            hover:scale-105
                        ">
                        <h2 class="
                                w-full
                                text-2xl
                                font-black
                                leading-tight
                                text-center text-gray-800
                            ">
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
