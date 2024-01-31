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
                    <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre del Titular:</label>
                    <input v-model="form.nombre" type="text" id="nombre" name="nombre" class="w-full px-3 py-2 border rounded">
                    <span v-if="errors.nombre" class="text-red-500 text-sm">{{ errors.nombre }}</span>
                </div>

                <!-- Apellido del titular -->
                <div class="mb-4">
                    <label for="apellido" class="block text-gray-700 text-sm font-bold mb-2">Apellido del Titular:</label>
                    <input v-model="form.apellido" type="text" id="apellido" name="apellido"
                        class="w-full px-3 py-2 border rounded">
                    <span v-if="errors.apellido" class="text-red-500 text-sm">{{ errors.apellido }}</span>
                </div>

                <!-- Cédula de identidad del titular -->
                <div class="mb-4">
                    <label for="cedula" class="block text-gray-700 text-sm font-bold mb-2">Cédula de Identidad:</label>
                    <input v-model="form.cedula" type="text" id="cedula" name="cedula" class="w-full px-3 py-2 border rounded">
                    <span v-if="errors.cedula" class="text-red-500 text-sm">{{ errors.cedula }}</span>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo electrónico del
                        Titular:</label>
                    <input v-model="form.email" type="text" id="email" name="email" class="w-full px-3 py-2 border rounded">
                    <span v-if="errors.email" class="text-red-500 text-sm">{{ errors.apellido }}</span>
                </div>

                <div class="mb-4">
                    <label for="owner_state" class="block text-gray-700 text-sm font-bold mb-2">Estado de procedencia del
                        titular:</label>
                    <input v-model="form.owner_state" type="text" id="owner_state" name="owner_state"
                        class="w-full px-3 py-2 border rounded">
                    <span v-if="errors.owner_state" class="text-red-500 text-sm">{{ errors.apellido }}</span>
                </div>

                <div class="mb-4">
                    <label for="owner_city" class="block text-gray-700 text-sm font-bold mb-2">Ciudad de procedencia del
                        titular:</label>
                    <input v-model="form.owner_city" type="text" id="owner_city" name="owner_city"
                        class="w-full px-3 py-2 border rounded">
                    <span v-if="errors.owner_city" class="text-red-500 text-sm">{{ errors.apellido }}</span>
                </div>

                <div class="mb-4">
                    <label for="owner_address" class="block text-gray-700 text-sm font-bold mb-2">Dirección de domicilio del
                        titular:</label>
                    <input v-model="form.owner_address" type="text" id="owner_address" name="owner_address"
                        class="w-full px-3 py-2 border rounded">
                    <span v-if="errors.owner_address" class="text-red-500 text-sm">{{ errors.apellido }}</span>
                </div>

                <div class="mb-4">
                    <label for="owner_request" class="block text-gray-700 text-sm font-bold mb-2">¿Qué desea?</label>
                    <input v-model="form.owner_request" type="text" id="owner_request" name="owner_request"
                        class="w-full px-3 py-2 border rounded">
                    <span v-if="errors.owner_request" class="text-red-500 text-sm">{{ errors.apellido }}</span>
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

const form = ref({
    nombre: '',
    apellido: '',
    cedula: '',
    // Otros campos del formulario
});

const errors = ref({});

const submitForm = () => {
    // Validaciones básicas, puedes agregar más según tus necesidades
    errors.value = {};

    if (!form.value.nombre) {
        errors.value.nombre = 'Nombre del titular es requerido.';
    }

    if (!form.value.apellido) {
        errors.value.apellido = 'Apellido del titular es requerido.';
    }

    if (!form.value.cedula) {
        errors.value.cedula = 'Cédula de identidad es requerida.';
    }

    // Otros campos y lógica de envío del formulario

    if (Object.keys(errors.value).length === 0) {
        // Aquí puedes enviar el formulario
        console.log('Formulario enviado:', form.value);
    }
};
</script>