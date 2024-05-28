<template>
    <MainLayout>
        <template #main>

            <Head title="Detalle de la solicitud" />
            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <section class="gradient border-b py-12">
                <div class="container mx-auto">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
                        Detalle de la solicitud
                    </h2>
                    <br>
                    <h1>Solicitud de formulación</h1>
                    <h2>Datos personales</h2>
                    <h3>Titular:</h3>
                    <p>{{ `${pendingOrder.owner_firstname} ${pendingOrder.owner_lastname}` }}</p>
                    <h3>Contactos:</h3>
                    <p><strong>E-mail: </strong>{{ `${pendingOrder.owner_email}` }}</p>
                    <p><strong>Teléfono: </strong>{{ `${pendingOrder.owner_phone_number}` }}</p>
                    <h3>Dirección:</h3>
                    <p>{{ `${pendingOrder.owner_state}, ${pendingOrder.owner_city}, ${pendingOrder.owner_address}` }}
                    </p>
                    <h2>Datos de la solicitud</h2>
                    <p><strong>¿Qué desea?</strong></p>
                    <p>{{ pendingOrder.owner_request }}</p>
                    <p><strong>Tiempo estimado por el cliente: </strong>{{ pendingOrder.deadline }}</p>
                    <p><strong>Código de la solicitud:</strong>{{ pendingOrder.id }}</p>
                </div>
            </section>
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