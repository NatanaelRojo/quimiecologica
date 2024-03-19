<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const props = defineProps({
    purchase_order: { required: true, type: Object },
});

const isLoading = ref(false);
const fullPage = ref(true);

const goBack = () => {
    window.history.back();
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
                    <!-- <h2 class="
                            font-montserrat
                            w-full
                            my-2
                            text-5xl
                            font-black
                            leading-tight
                            text-center
                            text-gray-800
                        ">
                        Detalles de tu órden de compra
                    </h2> -->
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
                    <div>
                        <h2 class="
                                w-full
                                text-2xl
                                font-black
                                leading-tight
                                text-center text-gray-800
                            ">
                            Detalles de la Orden de Compra
                        </h2>
                        <p>Nombre del propietario: {{ purchase_order.owner_firstname }} {{ purchase_order.owner_lastname
                            }}</p>
                        <p>ID del propietario: {{ purchase_order.owner_id }}</p>
                        <p>Número de teléfono: {{ purchase_order.owner_phone_number }}</p>
                        <p>Estado: {{ purchase_order.owner_state }}</p>
                        <p>Ciudad: {{ purchase_order.owner_city }}</p>
                        <p>Dirección: {{ purchase_order.owner_address }}</p>
                        <p>Precio total: ${{ purchase_order.total_price }}</p>
                        <h3>Información de productos:</h3>
                        <ul>
                            <li v-for="(product, index) in purchase_order.products_info" :key="index">
                                <p>Producto ID: {{ product.product_id }}</p>
                                <p>Nombre del producto: {{ product.product_name }}</p>
                                <p>Cantidad: {{ product.product_quantity }}</p>
                                <p>Tipo de venta: {{ product.sale_type }}</p>
                                <p>Unidad de producto: {{ product.product_unit }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </template>
    </MainLayout>
</template>