<template>
    <MainLayout>
        <template #main>

            <Head title="Servicios de formulación" />
            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <section class="gradient border-b py-3" style="min-height: 500px">
                <ErrorList v-if="errors.length > 0" :errors="errors" @clear-errors="clearErrors" />
                <div v-if="dataRecord == null" class="container max-w-5xl mx-auto m-8">
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
                        Servicios de formulación
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
                    <form @submit.prevent="submitForm" class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
                        <!-- Nombre del titular -->
                        <div class="mb-4">
                            <label for="owner_firstname" class="block text-gray-700 text-sm font-bold mb-2">
                                Nombre del titular: <span style="color: red;">*</span>
                            </label>
                            <input v-model="pendingOrder.owner_firstname" type="text" id="owner_firstname"
                                name="owner_firstname" class="w-full px-3 py-2 border rounded">
                        </div>

                        <!-- Apellido del titular -->
                        <div class="mb-4">
                            <label for="owner_lastname" class="block text-gray-700 text-sm font-bold mb-2">
                                Apellido del titular: <span style="color: red;">*</span>
                            </label>
                            <input v-model="pendingOrder.owner_lastname" type="text" id="owner_lastname"
                                name="owner_lastname" class="w-full px-3 py-2 border rounded">
                        </div>

                        <!-- Cédula de identidad del titular -->
                        <div class="mb-4">
                            <label for="owner_id" class="block text-gray-700 text-sm font-bold mb-2">
                                Cédula de identidad: <span style="color: red;">*</span>
                            </label>
                            <input v-model="pendingOrder.owner_id" type="text" id="owner_id" name="owner_id"
                                class="w-full px-3 py-2 border rounded">
                        </div>

                        <!-- Número de teléfono del titular -->
                        <div class="mb-4">
                            <label for="owner_phone_number" class="block text-gray-700 text-sm font-bold mb-2">
                                Número de teléfono: <span style="color: red;">*</span>
                            </label>

                            <!-- Selector de código de área -->
                            <div class="flex items-center">
                                <select v-model="selectedPhoneCode" class="w-16 px-3 py-2 border rounded mr-2">
                                    <option v-for="(code, index) in phoneCodes" :key="index" :value="code.value">
                                        {{ code.label }} </option>
                                </select>
                                <p>{{ selectedPhoneCode }}</p>
                            </div>

                            <!-- Campo de número de teléfono -->
                            <input
                                v-model="pendingOrder.owner_phone_number"
                                type="number"
                                id="owner_phone_number"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                name="owner_phone_number"
                                class="w-full px-3 py-2 border rounded"
                            >
                        </div>

                        <div class="mb-4">
                            <label for="owner_email" class="block text-gray-700 text-sm font-bold mb-2">
                                Correo electrónico del titular: <span style="color: red;">*</span>
                            </label>
                            <input v-model="pendingOrder.owner_email" type="text" id="owner_email" name="owner_email"
                                class="w-full px-3 py-2 border rounded">
                        </div>

                        <div class="mb-4">
                            <label for="owner_state" class="block text-gray-700 text-sm font-bold mb-2">
                                Estado de procedencia del titular: <span style="color: red;">*</span>
                            </label>
                            <input v-model="pendingOrder.owner_state" type="text" id="owner_state" name="owner_state"
                                class="w-full px-3 py-2 border rounded">
                        </div>

                        <div class="mb-4">
                            <label for="owner_city" class="block text-gray-700 text-sm font-bold mb-2">
                                Ciudad de procedencia del titular: <span style="color: red;">*</span>
                            </label>
                            <input v-model="pendingOrder.owner_city" type="text" id="owner_city" name="owner_city"
                                class="w-full px-3 py-2 border rounded">
                        </div>

                        <div class="mb-4">
                            <label for="owner_address" class="block text-gray-700 text-sm font-bold mb-2">
                                Dirección de domicilio del titular: <span style="color: red;">*</span>
                            </label>
                            <input v-model="pendingOrder.owner_address" type="text" id="owner_address"
                                name="owner_address" class="w-full px-3 py-2 border rounded">
                        </div>

                        <div class="mb-4">
                            <label for="owner_request" class="block text-gray-700 text-sm font-bold mb-2">
                                ¿Qué desea? <span style="color: red;">*</span>
                            </label>
                            <textarea id="owner_request" name="owner_request" v-model="pendingOrder.owner_request"
                                rows="10" cols="50" class="w-full px-3 py-2 border rounded">
                            </textarea>
                        </div>
                        <div class="mb-4">
                            <label for="deadline" class="block text-gray-700 text-sm font-bold mb-2">
                                Tiempo estimado <span style="color: red;">*</span>
                            </label>
                            <input v-model="pendingOrder.deadline" type="text" id="deadline" name="deadline"
                                class="w-full px-3 py-2 border rounded">
                        </div>

                        <!-- Botón de enviar -->
                        <div>
                            <button type="submit" class="
                                    font-montserrat
                                    gradient-green
                                    mt-4
                                    bg-blue-500
                                    text-white
                                    py-2
                                    px-4
                                    rounded-md
                                    hover:bg-blue-600
                                    focus:outline-none
                                    focus:border-blue-700
                                    focus:ring
                                    focus:ring-blue-200
                                    font-bold
                                ">
                                <i class="fa fa-check fa-lg ollapsed"></i>
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>
                <div v-else>
                    <div class="container max-w-5xl mx-auto m-8">
                        <a href="#" class="font-montserrat" @click.prevent="goBack">
                            <i class="fa fa-chevron-left fa-lg ollapsed"></i> Atrás
                        </a>
                        <h2
                            class="
                                font-montserrat
                                w-full
                                my-2
                                text-5xl
                                font-black
                                leading-tight
                                text-center
                                text-gray-800
                            "
                        >
                            Detalle de la solicitud de formulación
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
                        <div class="
                                p-4
                                border
                                rounded-lg
                                shadow-md
                            " style="border: ridge 1px #93BC00;"
                        >
                            <div class="mb-2 text-gray-800 text-lg">
                                <b>
                                    Nombre y Apellido del titular:
                                </b>
                                {{ dataRecord.owner_firstname}} {{ dataRecord.owner_lastname }}
                            </div>
                            <div class="mb-2 text-gray-800 text-lg">
                                <b>Correo electrónico:</b>
                                {{ dataRecord.owner_email }}
                            </div>
                            <div class="mb-2 text-gray-800 text-lg">
                                <b>Teléfono:</b>
                                {{ dataRecord.owner_phone_number }}
                            </div>
                            <div class="mb-2 text-gray-800 text-lg">
                                <b>Dirección:</b>
                                {{ dataRecord.owner_state }}, {{ dataRecord.owner_city }}, {{ dataRecord.owner_address }}
                            </div>
                            <div class="mb-2 text-gray-800 text-lg">
                                <b>¿Qué desea?:</b>
                                <div>
                                    {{ dataRecord.owner_request }}
                                </div>
                            </div>
                            <div class="mb-2 text-gray-800 text-lg">
                                <b>Tiempo estimado por el cliente:</b>
                                {{ dataRecord.deadline }}
                            </div>
                            <div class="mb-2 text-gray-800 text-lg">
                                <b>Código de la solicitud:</b>
                                {{ dataRecord.id }}
                            </div>
                            <br>
                            <div
                                class="
                                    p-4
                                    border
                                    rounded-lg
                                    shadow-md
                                "
                                style="border: ridge 1px #93BC00;"
                            >
                                <b
                                    class="
                                        font-montserrat
                                        w-full
                                        my-2
                                        text-3xl
                                        font-black
                                        leading-tight
                                        text-center
                                        text-gray-800
                                    "
                                >
                                    Comunícate con nosotros
                                </b>
                                <div class="mb-2 text-gray-800 text-lg mt-3">
                                    <p>
                                        <i class="fa-solid fa-phone"></i>
                                        Teléfonos: 0412-5347169 / 0274-2635666
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
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
const dataRecord = ref(null);

/**
 * Starts loading spinner.
 */
onBeforeMount(() => {
    isLoading.value = true;
});

/**
 * Ends loading spinner.
 */
onMounted(() => {
    // Finalizar spinner de carga.
    isLoading.value = false;
});

/**
 * Method scrolls to the top form.
 */
const scrollMeTo = () => {
    const top = form.offsetTop;
    window.scrollTo(0, top);
}

/**
 * Clean errors in the form.
 */
const clearErrors = () => {
    errors.value = []
}

/**
 * Method that returns to the previous page.
*/
const goBack = () => {
    window.history.back();
}

/**
 * Método que envía al api los datos del formulario y redirecciona a la vista
 * que detalla el registro realizado.
 */
const submitForm = async () => {
    try {
        const response = await axios.post('/api/pending-orders', {
            ...pendingOrder.value,
            owner_phone_number: selectedPhoneCode.value + pendingOrder.value.owner_phone_number,
        });
        dataRecord.value = response.data.record;
    } catch (error) {
        errors.value = error.response.data;
        scrollMeTo()
    }
}
</script>
