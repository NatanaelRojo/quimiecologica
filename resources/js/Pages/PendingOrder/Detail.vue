<template>
    <MainLayout>
        <template #main>

            <Head title="Detalle de la solicitud" />
            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

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
                        <b>Nombre y Apellido del titular:</b> {{ `${pendingOrder.owner_firstname} ${pendingOrder.owner_lastname}` }}
                    </div>
                    <div class="mb-2 text-gray-800 text-lg">
                        <b>Correo electrónico:</b> {{ `${pendingOrder.owner_email}` }}
                    </div>
                    <div class="mb-2 text-gray-800 text-lg">
                        <b>Teléfono: </b> {{ `${pendingOrder.owner_phone_number}` }}
                    </div>
                    <div class="mb-2 text-gray-800 text-lg">
                        <b>Dirección:</b> {{ `${pendingOrder.owner_state}, ${pendingOrder.owner_city}, ${pendingOrder.owner_address}` }}
                    </div>
                    <div class="mb-2 text-gray-800 text-lg">
                        <b>¿Qué desea?:</b> {{ pendingOrder.owner_request }}
                    </div>
                    <div class="mb-2 text-gray-800 text-lg">
                        <b>Tiempo estimado por el cliente:</b> {{ pendingOrder.deadline }}
                    </div>
                    <div class="mb-2 text-gray-800 text-lg">
                        <b>Código de la solicitud:</b> {{ pendingOrder.id }}
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
        </template>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { onMounted, onBeforeMount, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const props = defineProps({
    pendingOrder: { type: Object, required: true },
});

const isLoading = ref(false);
const fullPage = ref(true);

/**
 * Regresar al componente anterior.
*/
const goBack = () => {
    window.history.back();
}

onBeforeMount(() => {
    // Iniciar spinner de carga.
    isLoading.value = true;
});

onMounted(() => {
    // Finalizar spinner de carga.
    isLoading.value = false;
});
</script>