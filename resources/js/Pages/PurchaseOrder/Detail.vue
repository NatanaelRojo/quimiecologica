<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { onMounted, onBeforeMount, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const props = defineProps({
    purchase_order: { required: true, type: Object },
});

const isLoading = ref(false);
const fullPage = ref(true);

/**
 * Regresar al componente anterior.
*/
const goBack = () => {
    window.history.back();
}

onBeforeMount(async () => {
    // Iniciar spinner de carga.
    isLoading.value = true;
});

onMounted(() => {
    cleanForm();
    // Finalizar spinner de carga.
    isLoading.value = false;
});

/**
 * Limpiar el Carrito de compras.
*/
const cleanForm = () => {
    if (localStorage.arrayProducts) {
        localStorage.removeItem('arrayProducts');
        location.reload();
    }
}
</script>

<template>
    <MainLayout>
        <template #main>

            <Head title="Detalle de la órden de compra" />
            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <!-- Sección -->
            <section class="bg-white border-b py-3">
                <div class="container max-w-5xl mx-auto m-8">
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
                        Detalles de tu Orden de compra
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
                    <div class="
                            p-4 border
                            border-gray-200
                            rounded-lg
                            shadow-md">
                        <p><b>Nombres:</b> {{ purchase_order.owner_firstname }}</p>
                        <p><b>Apellidos:</b> {{ purchase_order.owner_lastname }} {{ purchase_order.owner_lastname }}</p>
                        <p><b>Cédula de identidad:</b>s {{ purchase_order.owner_id }}</p>
                        <p><b>Número de teléfono:</b> {{ purchase_order.owner_phone_number }}</p>
                        <p><b>Correo electrónico:</b> {{ purchase_order.owner_email }}</p>
                        <p><b>Estado de procedencia:</b> {{ purchase_order.owner_state }}</p>
                        <p><b>Ciudad de procedencia:</b> {{ purchase_order.owner_city }}</p>
                        <p><b>Dirección de domicilio:</b> {{ purchase_order.owner_address }}</p>
                        <p><b>Numero de referencia del pago:</b> {{ purchase_order.reference_number }}</p>
                        <h3><b>Información de los Productos:</b></h3>
                        <ul>
                            <li v-for="(product, index) in purchase_order.products_info" :key="index">
                                <p>Producto ID: {{ product.product_id }}</p>
                                <p>Nombre del producto: {{ product.product_name }}</p>
                                <p>Cantidad: {{ product.product_quantity }}</p>
                                <p>Tipo de venta: {{ product.sale_type }}</p>
                                <p>Unidad de producto: {{ product.product_unit }}</p>
                            </li>
                        </ul>
                        <h2 class="
                                w-full
                                my-2
                                text-5xl
                                font-black
                                leading-tight
                                text-gray-800
                            ">
                            Total: ${{ purchase_order.total_price }}
                        </h2>
                    </div>
                </div>
            </section>
        </template>
    </MainLayout>
</template>