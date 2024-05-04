<template>
    <MainLayout>
        <template #main>

            <Head title="Detalle de la orden" />

            <NavBar />

            <section class="gradient border-b py-12">
                <div class="container mx-auto">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
                        Detalle de la orden
                    </h2>
                    <br>
                    <h1>Orden Pendiente</h1>
                    <h2>Datos personales</h2>
                    <h3>Titular:</h3>
                    <p>{{ `${pendingOrder.owner_firstname} ${pendingOrder.owner_lastname}` }}</p>
                    <h3>Contactos:</h3>
                    <p><strong>E-mail: </strong>{{ `${pendingOrder.owner_email}` }}</p>
                    <p><strong>Teléfono: </strong>{{ `${pendingOrder.owner_phone_number}` }}</p>
                    <h3>Dirección:</h3>
                    <p>{{ `${pendingOrder.owner_state}, ${pendingOrder.owner_city}, ${pendingOrder.owner_address}` }}</p>
                    <h2>Datos de la orden</h2>
                    <h3>Pedido:</h3>
                    <p>{{ pendingOrder.owner_request }}</p>
                    <h3>Código:</h3>
                    <p>{{ pendingOrder.id }}</p>
                    <h3>Estado:</h3>
                    <p>En espera</p>
                </div>
            </section>
        </template>
    </MainLayout>
</template>    

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { onMounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    pendingOrder: { type: Object, required: true },
});
</script>