<template>
    <Head title="Formulario de registro" />

    <NavBar />

    <section class="bg-white border-b py-12">
        <ErrorList
            v-if="errors.length > 0"
            :errors="errors"
            @clear-errors="clearErrors"
        />
        <div class="container mx-auto p-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
                Formulario de Registro
            </h2>
            <br>
            <form @submit.prevent="submitForm" class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
                <!-- Nombre del titular -->
                <div class="mb-4">
                    <label
                        for="owner_firstname"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >
                        Nombre del Titular:
                    </label>
                    <input
                        v-model="pendingOrder.owner_firstname"
                        type="text"
                        id="owner_firstname"
                        name="owner_firstname"
                        class="w-full px-3 py-2 border rounded"
                    >
                </div>

                <!-- Apellido del titular -->
                <div class="mb-4">
                    <label
                        for="owner_lastname"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >
                        Apellido del Titular:
                    </label>
                    <input
                        v-model="pendingOrder.owner_lastname"
                        type="text"
                        id="owner_lastname"
                        name="owner_lastname"
                        class="w-full px-3 py-2 border rounded"
                    >
                </div>

                <!-- Cédula de identidad del titular -->
                <div class="mb-4">
                    <label
                        for="owner_id"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >
                        Cédula de Identidad:
                    </label>
                    <input
                        v-model="pendingOrder.owner_id"
                        type="text"
                        id="owner_id"
                        name="owner_id"
                        class="w-full px-3 py-2 border rounded"
                    >
                </div>

                <!-- Número de teléfono del titular -->
                <div class="mb-4 flex items-center">
                    <label
                        for="owner_phone_number"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >
                        Número de teléfono del titular:
                    </label>

                    <!-- Selector de código de área -->
                    <select class="mr-2 px-3 py-2 border rounded">
                        <option value="+58">+58</option>
                        <!-- Agrega más opciones según sea necesario -->
                    </select>

                    <!-- Campo de número de teléfono -->
                    <input
                        v-model="pendingOrder.owner_phone_number"
                        type="text" id="owner_phone_number"
                        name="owner_phone_number"
                        class="w-full px-3 py-2 border rounded"
                    >
                </div>

                <div class="mb-4">
                    <label
                        for="owner_email"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >
                        Correo electrónico del Titular:
                    </label>
                    <input
                        v-model="pendingOrder.owner_email"
                        type="text"
                        id="owner_email"
                        name="owner_email"
                        class="w-full px-3 py-2 border rounded"
                    >
                </div>

                <div class="mb-4">
                    <label
                        for="owner_state"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >
                        Estado de procedencia del titular:
                    </label>
                    <input
                        v-model="pendingOrder.owner_state"
                        type="text" id="owner_state"
                        name="owner_state"
                        class="w-full px-3 py-2 border rounded"
                    >
                </div>

                <div class="mb-4">
                    <label
                        for="owner_city"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >
                        Ciudad de procedencia del titular:
                    </label>
                    <input
                        v-model="pendingOrder.owner_city"
                        type="text"
                        id="owner_city"
                        name="owner_city"
                        class="w-full px-3 py-2 border rounded"
                    >
                </div>

                <div class="mb-4">
                    <label
                        for="owner_address"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >
                        Dirección de domicilio del titular:
                    </label>
                    <input
                        v-model="pendingOrder.owner_address"
                        type="text"
                        id="owner_address"
                        name="owner_address"
                        class="w-full px-3 py-2 border rounded"
                    >
                </div>

                <div class="mb-4">
                    <label
                        for="owner_request"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >
                        ¿Qué desea?
                    </label>
                    <input
                        v-model="pendingOrder.owner_request"
                        type="text"
                        id="owner_request"
                        name="owner_request"
                        class="w-full px-3 py-2 border rounded"
                    >
                </div>

                <!-- Botón de enviar -->
                <div class="mt-6">
                    <button
                        type="submit"
                        class="
                            bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600
                        "
                    >
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </section>
</template>

<script setup>
import NavBar from '@/Layouts/NavBar.vue';
import ErrorList from '@/Components/ErrorList.vue';
import { onMounted, ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';

const form = ref(null);
const pendingOrder = ref({
    owner_firstname: '',
    owner_lastname: '',
    owner_id: '',
    owner_email: '',
    owner_phone_number: '',
    owner_state: '',
    owner_city: '',
    owner_address: '',
    owner_request: '',
});

const errors = ref([]);

/**
 * Método que desplaza la pantalla a la cabecera del formulario.
 */
const scrollMeTo = () => {
    const top = form.offsetTop;
    window.scrollTo(0, top);
}

/**
 * Método que limpia los errores del formulario.
 */
const clearErrors = () => {
    errors.value = []
}

/**
 * Método que envía al api los datos del formulario y redirecciona a la vista
 * que detalla el registro realizado.
 */
const submitForm = async () => {
    try {
        const response = await axios.post('/api/pending-orders', pendingOrder.value);
        router.visit(route('pending_orders.detail', response.data.id));
    } catch (error) {
        errors.value = error.response.data;
        scrollMeTo()
    }
}
</script>
