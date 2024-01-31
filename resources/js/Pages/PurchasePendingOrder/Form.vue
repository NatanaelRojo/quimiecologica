<template>
    <Head title="Formulario de registro" />

    <NavBar />

    <section class="bg-white border-b py-12">
        <div class="container mx-auto p-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
                Formulario de Registro
            </h2>
            <br>
            <form @submit.prevent="submitForm" class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
                <!-- Nombre del titular -->
                <div class="mb-4">
                    <label for="owner_firstname" class="block text-gray-700 text-sm font-bold mb-2">Nombre del
                        Titular:</label>
                    <input v-model="pendingOrder.owner_firstname" type="text" id="owner_firstname" name="owner_firstname"
                        class="w-full px-3 py-2 border rounded">
                    <!-- <span v-if="errors.nombre" class="text-red-500 text-sm">{{ errors.nombre }}</span> -->
                </div>

                <!-- Apellido del titular -->
                <div class="mb-4">
                    <label for="owner_lastname" class="block text-gray-700 text-sm font-bold mb-2">Apellido del
                        Titular:</label>
                    <input v-model="pendingOrder.owner_lastname" type="text" id="owner_lastname" name="owner_lastname"
                        class="w-full px-3 py-2 border rounded">
                    <!-- <span v-if="errors.apellido" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                </div>

                <!-- Cédula de identidad del titular -->
                <div class="mb-4">
                    <label for="owner_id" class="block text-gray-700 text-sm font-bold mb-2">Cédula de Identidad:</label>
                    <input v-model="pendingOrder.owner_id" type="text" id="owner_id" name="owner_id"
                        class="w-full px-3 py-2 border rounded">
                    <!-- <span v-if="errors.cedula" class="text-red-500 text-sm">{{ errors.cedula }}</span> -->
                </div>

                <!-- Cédula de identidad del titular -->
                <div class="mb-4">
                    <label for="owner_phone_number" class="block text-gray-700 text-sm font-bold mb-2">Número
                        de teléfono del titular:</label>
                    <input v-model="pendingOrder.owner_phone_number" type="text" id="owner_phone_number"
                        name="owner_phone_number" class="w-full px-3 py-2 border rounded">
                    <!-- <span v-if="errors.cedula" class="text-red-500 text-sm">{{ errors.cedula }}</span> -->
                </div>

                <div class="mb-4">
                    <label for="owner_email" class="block text-gray-700 text-sm font-bold mb-2">Correo electrónico del
                        Titular:</label>
                    <input v-model="pendingOrder.owner_email" type="text" id="owner_email" name="owner_email"
                        class="w-full px-3 py-2 border rounded">
                    <!-- <span v-if="errors.email" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                </div>

                <div class="mb-4">
                    <label for="owner_state" class="block text-gray-700 text-sm font-bold mb-2">Estado de procedencia del
                        titular:</label>
                    <input v-model="pendingOrder.owner_state" type="text" id="owner_state" name="owner_state"
                        class="w-full px-3 py-2 border rounded">
                    <!-- <span v-if="errors.owner_state" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                </div>

                <div class="mb-4">
                    <label for="owner_city" class="block text-gray-700 text-sm font-bold mb-2">Ciudad de procedencia del
                        titular:</label>
                    <input v-model="pendingOrder.owner_city" type="text" id="owner_city" name="owner_city"
                        class="w-full px-3 py-2 border rounded">
                    <!-- <span v-if="errors.owner_city" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                </div>

                <div class="mb-4">
                    <label for="owner_address" class="block text-gray-700 text-sm font-bold mb-2">Dirección de domicilio del
                        titular:</label>
                    <input v-model="pendingOrder.owner_address" type="text" id="owner_address" name="owner_address"
                        class="w-full px-3 py-2 border rounded">
                    <!-- <span v-if="errors.owner_address" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
                </div>

                <div class="mb-4">
                    <label for="owner_request" class="block text-gray-700 text-sm font-bold mb-2">¿Qué desea?</label>
                    <input v-model="pendingOrder.owner_request" type="text" id="owner_request" name="owner_request"
                        class="w-full px-3 py-2 border rounded">
                    <!-- <span v-if="errors.owner_request" class="text-red-500 text-sm">{{ errors.apellido }}</span> -->
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

<script setup>
import NavBar from '@/Layouts/NavBar.vue';
import { onMounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

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
 *
 * @author Argenis Osorio <aosorio@cenditel.gob.ve>
 */
const scrollMeTo = () => {
    const top = form.offsetTop;
    window.scrollTo(0, top);
    // window.scrollTo({ top: form.offsetTop, left: 0, behavior: "smooth" });
}

const submitForm = async () => {
    try {
        const response = await axios.post('/api/pending-orders', pendingOrder.value);
    } catch (error) {
        errors.value = error.response.data;
        // console.error(error.response.data);
        scrollMeTo()
    }
}
</script>
