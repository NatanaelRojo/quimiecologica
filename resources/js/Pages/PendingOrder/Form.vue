<template>
    <MainLayout>
        <template #main>

            <Head title="Formulario de registro" />
            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <section class="gradient border-b py-12">
                <a href="#" class="font-montserrat" @click.prevent="goBack">
                    <i class="fa fa-chevron-left fa-lg ollapsed"></i> Atrás
                </a>
                <ErrorList v-if="errors.length > 0" :errors="errors" @clear-errors="clearErrors" />
                <div class="container mx-auto p-4">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
                        Formulario de Registro
                    </h2>
                    <br>
                    <form @submit.prevent="submitForm" class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
                        <!-- Nombre del titular -->
                        <div class="mb-4">
                            <label for="owner_firstname" class="block text-gray-700 text-sm font-bold mb-2">
                                Nombre del Titular:
                            </label>
                            <input v-model="pendingOrder.owner_firstname" type="text" id="owner_firstname"
                                name="owner_firstname" class="w-full px-3 py-2 border rounded">
                        </div>

                        <!-- Apellido del titular -->
                        <div class="mb-4">
                            <label for="owner_lastname" class="block text-gray-700 text-sm font-bold mb-2">
                                Apellido del Titular:
                            </label>
                            <input v-model="pendingOrder.owner_lastname" type="text" id="owner_lastname"
                                name="owner_lastname" class="w-full px-3 py-2 border rounded">
                        </div>

                        <!-- Cédula de identidad del titular -->
                        <div class="mb-4">
                            <label for="owner_id" class="block text-gray-700 text-sm font-bold mb-2">
                                Cédula de Identidad:
                            </label>
                            <input v-model="pendingOrder.owner_id" type="text" id="owner_id" name="owner_id"
                                class="w-full px-3 py-2 border rounded">
                        </div>

                        <!-- Número de teléfono del titular -->
                        <div class="mb-4">
                            <label for="owner_phone_number" class="block text-gray-700 text-sm font-bold mb-2">
                                Número de teléfono:
                            </label>

                            <!-- Selector de código de área -->
                            <div class="flex items-center">
                                <select v-model="selectedPhoneCode" class="w-16 px-3 py-2 border rounded mr-2">
                                    <option v-for="(code, index) in phoneCodes" :key="index" :value="code.value">
                                        {{ code.label }} </option>
                                </select>
                            </div>

                            <!-- Campo de número de teléfono -->
                            <input v-model="pendingOrder.owner_phone_number" type="text" id="owner_phone_number"
                                name="owner_phone_number" class="w-full px-3 py-2 border rounded">
                        </div>

                        <div class="mb-4">
                            <label for="owner_email" class="block text-gray-700 text-sm font-bold mb-2">
                                Correo electrónico del Titular:
                            </label>
                            <input v-model="pendingOrder.owner_email" type="text" id="owner_email" name="owner_email"
                                class="w-full px-3 py-2 border rounded">
                        </div>

                        <div class="mb-4">
                            <label for="owner_state" class="block text-gray-700 text-sm font-bold mb-2">
                                Estado de procedencia del titular:
                            </label>
                            <input v-model="pendingOrder.owner_state" type="text" id="owner_state" name="owner_state"
                                class="w-full px-3 py-2 border rounded">
                        </div>

                        <div class="mb-4">
                            <label for="owner_city" class="block text-gray-700 text-sm font-bold mb-2">
                                Ciudad de procedencia del titular:
                            </label>
                            <input v-model="pendingOrder.owner_city" type="text" id="owner_city" name="owner_city"
                                class="w-full px-3 py-2 border rounded">
                        </div>

                        <div class="mb-4">
                            <label for="owner_address" class="block text-gray-700 text-sm font-bold mb-2">
                                Dirección de domicilio del titular:
                            </label>
                            <input v-model="pendingOrder.owner_address" type="text" id="owner_address"
                                name="owner_address" class="w-full px-3 py-2 border rounded">
                        </div>

                        <div class="mb-4">
                            <label for="owner_request" class="block text-gray-700 text-sm font-bold mb-2">
                                ¿Qué desea?
                            </label>
                            <input v-model="pendingOrder.owner_request" type="text" id="owner_request"
                                name="owner_request" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="deadline" class="block text-gray-700 text-sm font-bold mb-2">
                                Tiempo estimado
                            </label>
                            <input v-model="pendingOrder.deadline" type="text" id="deadline" name="deadline"
                                class="w-full px-3 py-2 border rounded">
                        </div>

                        <!-- Botón de enviar -->
                        <div class="mt-6">
                            <button type="submit" class="
                        bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600
                    ">
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
import { onBeforeMount, onMounted, ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const phoneCodes = ref([
    { value: '+58 414', label: '0414' },
    { value: '+58 424', label: '0424' },
    { value: '+58 426', label: '0426' },
    { value: '+58 416', label: '0416' },
    { value: '+58 412', label: '0412' },
]);
const selectedPhoneCode = ref('');
const isLoading = ref(false);
const fullPage = ref(true);
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
    deadline: '',
});

const errors = ref([]);

onBeforeMount(() => {
    // Iniciar spinner de carga.
    isLoading.value = true;
});

onMounted(() => {
    // Finalizar spinner de carga.
    isLoading.value = false;
});


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
        pendingOrder.value.owner_phone_number = selectedPhoneCode.value + pendingOrder.value.owner_phone_number;
        console.log(pendingOrder.value.owner_phone_number);
        // const response = await axios.post('/api/pending-orders', pendingOrder.value);
        // router.visit(route('pending_orders.detail', response.data.id));
    } catch (error) {
        errors.value = error.response.data;
        scrollMeTo()
    }
}
</script>
