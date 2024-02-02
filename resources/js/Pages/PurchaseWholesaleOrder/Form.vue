<template>
    <MainLayout>
        <template #main>

            <Head title="Formulario de registro" />

            <NavBar />

            <section class="bg-white border-b py-12">
                <ErrorList v-if="errors.length > 0" :errors="errors" @clear-errors="clearErrors" />
                <div class="container mx-auto p-4">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
                        Ingrese sus datos
                    </h2>
                    <br>
                    <form @submit.prevent="submitForm" class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
                        <!-- Nombre del titular -->
                        <div class="mb-4">
                            <label for="owner_firstname" class="block text-gray-700 text-sm font-bold mb-2">Nombre del
                                Titular:</label>
                            <input v-model="purchaseWholesaleOrder.owner_firstname" type="text" id="owner_firstname"
                                name="owner_firstname" class="w-full px-3 py-2 border rounded">
                            <!-- <span v-if="errors.nombre" class="text-red-500 text-sm">{{ errors.nombre }}</span> -->
                        </div>

                        <!-- Apellido del titular -->
                        <div class="mb-4">
                            <label for="owner_lastname" class="block text-gray-700 text-sm font-bold mb-2">Apellido del
                                Titular:</label>
                            <input v-model="purchaseWholesaleOrder.owner_lastname" type="text" id="owner_lastname"
                                name="owner_lastname" class="w-full px-3 py-2 border rounded">
                            <!-- <span v-if="errors.apellido" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                        </div>

                        <!-- Cédula de identidad del titular -->
                        <div class="mb-4">
                            <label for="owner_id" class="block text-gray-700 text-sm font-bold mb-2">Cédula de
                                Identidad:</label>
                            <input v-model="purchaseWholesaleOrder.owner_id" type="text" id="owner_id" name="owner_id"
                                class="w-full px-3 py-2 border rounded">
                            <!-- <span v-if="errors.cedula" class="text-red-500 text-sm">{{ errors.cedula }}</span> -->
                        </div>

                        <!-- Número de teléfono del titular -->
                        <div class="mb-4 flex items-center">
                            <label for="owner_phone_number" class="block text-gray-700 text-sm font-bold mb-2">Número de
                                teléfono
                                del titular:</label>

                            <!-- Selector de código de área -->
                            <select class="mr-2 px-3 py-2 border rounded">
                                <option value="+58">+58</option>
                                <!-- Agrega más opciones según sea necesario -->
                            </select>

                            <!-- Campo de número de teléfono -->
                            <input v-model="purchaseWholesaleOrder.owner_phone_number" type="text" id="owner_phone_number"
                                name="owner_phone_number" class="w-full px-3 py-2 border rounded">
                            <!-- <span v-if="errors.cedula" class="text-red-500 text-sm">{{ errors.cedula }}</span> -->
                        </div>


                        <div class="mb-4">
                            <label for="owner_email" class="block text-gray-700 text-sm font-bold mb-2">Correo electrónico
                                del
                                Titular:</label>
                            <input v-model="purchaseWholesaleOrder.owner_email" type="text" id="owner_email"
                                name="owner_email" class="w-full px-3 py-2 border rounded">
                            <!-- <span v-if="errors.email" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                        </div>

                        <div class="mb-4">
                            <label for="owner_state" class="block text-gray-700 text-sm font-bold mb-2">Estado de
                                procedencia del
                                titular:</label>
                            <input v-model="purchaseWholesaleOrder.owner_state" type="text" id="owner_state"
                                name="owner_state" class="w-full px-3 py-2 border rounded">
                            <!-- <span v-if="errors.owner_state" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                        </div>

                        <div class="mb-4">
                            <label for="owner_city" class="block text-gray-700 text-sm font-bold mb-2">Ciudad de procedencia
                                del
                                titular:</label>
                            <input v-model="purchaseWholesaleOrder.owner_city" type="text" id="owner_city" name="owner_city"
                                class="w-full px-3 py-2 border rounded">
                            <!-- <span v-if="errors.owner_city" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                        </div>

                        <div class="mb-4">
                            <label for="owner_address" class="block text-gray-700 text-sm font-bold mb-2">Dirección de
                                domicilio del
                                titular:</label>
                            <input v-model="purchaseWholesaleOrder.owner_address" type="text" id="owner_address"
                                name="owner_address" class="w-full px-3 py-2 border rounded">
                            <!-- <span v-if="errors.owner_address" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                        </div>

                        <!-- Baucher-->
                        <div class="mb-4">
                            <label for="baucher" class="block text-gray-700 text-sm font-bold mb-2">Comprobante de
                                pago:</label>
                            <input ref="purchaseWholesaleOrder.baucher" type="file" id="baucher" name="baucher"
                                class="w-full px-3 py-2 border rounded">
                            <!-- <span v-if="errors.owner_address" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                        </div>

                        <!-- Reference number-->
                        <div class="mb-4">
                            <label for="reference_number" class="block text-gray-700 text-sm font-bold mb-2">Referencia
                                bancaria:</label>
                            <input v-model="purchaseWholesaleOrder.reference_number" type="number" id="reference_number"
                                name="reference_number" class="w-full px-3 py-2 border rounded">
                            <!-- <span v-if="errors.owner_address" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                        </div>

                        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Datos del producto</h1>
                        <h2>{{ product.image_urls[0] }}</h2>
                        <!-- <h2>{{ product.image_urls[0] }}</h2> -->
                        <!-- <img :src="`/storage/${product.image_urls[0]}`" alt="" class="mx-auto w-6/12"> -->

                        <!-- Product quantity-->
                        <div class=" mb-4">
                            <label for="product_quantity" class="block text-gray-700 text-sm font-bold mb-2">Cantidad del
                                producto:</label>
                            <input v-model="purchaseWholesaleOrder.product_quantity" type="number" min="2" default="2"
                                name="product_quantity" class="w-full px-3 py-2 border rounded"
                                @input="calculateTotalPrice">
                            <!-- <span v-if="errors.owner_address" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                        </div>

                        <!-- Unidad -->
                        <div class="mb-4">
                            <label for="unit" class="block text-gray-700 text-sm font-bold mb-2">Unidad:</label>
                            <select v-model="purchaseWholesaleOrder.unit" id="unit" name="unit"
                                class="w-full px-3 py-2 border rounded">
                                <option value="" disabled>Seleccione una unidad</option>
                                <option v-for="unit in units" :key="unit.id" :value="unit.id">{{ unit.name }}</option>
                            </select>
                        </div>

                        <!-- Total price-->
                        <div class="mb-4">
                            <label for="product_quantity" class="block text-gray-700 text-sm font-bold mb-2">Precio total
                                del
                                producto:</label>
                            <input v-model="purchaseWholesaleOrder.total_price" type="number" id="total_price"
                                name="product_quantity" disabled class="w-full px-3 py-2 border rounded">
                            <!-- <span v-if="errors.owner_address" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                        </div>

                        <!-- Botón de enviar -->
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </template>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ErrorList from '@/Components/ErrorList.vue';
import { onMounted, ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import axios from 'axios';

const form = ref(null);
const units = ref([]);
const purchaseWholesaleOrder = ref({
    owner_firstname: '',
    owner_lastname: '',
    owner_id: '',
    owner_email: '',
    owner_phone_number: '',
    owner_state: '',
    owner_city: '',
    owner_address: '',
    owner_request: '',
    total_price: 1000,
    baucher: '',
    reference_number: '',
    product_quantity: 0,
    product_id: 1,
    unit: '',
});
const product = ref({});
const errors = ref([]);

onMounted(async () => {
    try {
        let response = await axios.get('/api/units');
        units.value = response.data;
        response = await axios.get(`/api/products/${purchaseWholesaleOrder.value.product_id}`);
        product.value = response.data;
    } catch (error) {
        console.error(error);
    }
});

const scrollMeTo = () => {
    const top = form.offsetTop;
    window.scrollTo(0, top);
}

const clearErrors = () => {
    errors.value = []
}

const calculateTotalPrice = () => {
    purchaseWholesaleOrder.value.total_price = 1000 * purchaseWholesaleOrder.value.product_quantity;
}

const submitForm = async () => {
    try {
        const response = await axios.post('/api/purchase-wholesale-orders', purchaseWholesaleOrder.value);
        router.visit(route('purchase_wholesale_orders.detail', response.data.id));
    } catch (error) {
        errors.value = error.response.data;
        scrollMeTo()
    }
}
</script>
