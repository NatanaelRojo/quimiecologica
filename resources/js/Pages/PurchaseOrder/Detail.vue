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
    cleanShoppingCart();
    // Finalizar spinner de carga.
    isLoading.value = false;
    // Mostrar notificación toastr.
    showMessage('success');
});

/**
 * Limpiar el Carrito de compras.
*/
const cleanShoppingCart = () => {
    if (localStorage.arrayProducts) {
        localStorage.removeItem('arrayProducts');
        location.reload();
    }
}

/**
 * Método que muestra la notificación toastr luego de guardar la orden de compra.
*/
const showMessage = (type) => {
    let options = {
        closeButton: true,
        progressBar: true,
        timeOut: 5000,
        extendedTimeOut: 1000,
        preventDuplicates: true
    };
    if (type === 'success') {
        toastr.success("¡Orden de Compra enviada!", "", options);
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
                            p-4
                            border
                            rounded-lg
                            shadow-md
                        " style="border: ridge 1px #93BC00;">
                        <div class="mb-2 text-gray-800 text-lg">
                            <b>Nombres:</b> {{ purchase_order.owner_firstname }}
                        </div>
                        <div class="mb-2 text-gray-800 text-lg">
                            <b>Apellidos:</b> {{ purchase_order.owner_lastname }} {{ purchase_order.owner_lastname }}
                        </div>
                        <div class="mb-2 text-gray-800 text-lg">
                            <b>Cédula de identidad:</b> {{ purchase_order.owner_id }}
                        </div>
                        <div class="mb-2 text-gray-800 text-lg">
                            <b>Número de teléfono:</b> {{ purchase_order.owner_phone_number }}
                        </div>
                        <div class="mb-2 text-gray-800 text-lg">
                            <b>Correo electrónico:</b> {{ purchase_order.owner_email }}
                        </div>
                        <div class="mb-2 text-gray-800 text-lg">
                            <b>Estado de procedencia:</b> {{ purchase_order.owner_state }}
                        </div>
                        <div class="mb-2 text-gray-800 text-lg">
                            <b>Ciudad de procedencia:</b> {{ purchase_order.owner_city }}
                        </div>
                        <div class="mb-2 text-gray-800 text-lg">
                            <b>Dirección de domicilio:</b> {{ purchase_order.owner_address }}
                        </div>
                        <div class="mb-2 text-gray-800 text-lg">
                            <b>Numero de referencia del pago:</b> {{ purchase_order.reference_number }}
                        </div>
                        <div class="mb-2 text-gray-800 text-lg">
                            <b>Fecha de creación:</b> {{ new Date(purchase_order.created_at).toLocaleDateString('en-GB')
                            }}
                        </div>
                        <div class="mb-2 text-gray-800 text-lg">
                            <h2>Información de los Productos:</h2>
                        </div>
                        <span v-for="(product, index) in purchase_order.products_info" :key="index">
                            <p>Nombre del producto: {{ product.name }}</p>
                            <p>Cantidad: {{ product.quantity }}</p>
                            <p v-if="product.quantity <= 5 && product?.type_sale.name === 'Detal/Mayor'">Tipo de venta:
                                Detal</p>
                            <p v-else-if="product.quantity > 5 && product?.type_sale.name === 'Detal/Mayor'">Tipo de
                                venta: Al mayor</p>
                            <p v-else-if="product?.type_sale?.name === 'Granel'">Tipo de venta: Granel</p>
                            <p v-if="product?.type_sale.name === 'Detal/Mayor' && product.quantity <= 5">Precio: {{
                                product.price }}</p>
                            <p v-if="product?.type_sale.name === 'Detal/Mayor' && product.quantity > 5">Precio: {{
                                product.wholesale_price }}</p>
                            <hr v-if="purchase_order.products_info.length > 1" class="mt-3 mb-5"
                                style="border: ridge 1px #93BC00;">
                        </span>
                        <hr v-if="purchase_order.products_info.length < 2" class="mt-3 mb-5"
                            style="border: ridge 1px #93BC00;">
                        <br>
                        <span class="
                                mt-5
                                gradient-green
                                rounded
                                px-5
                                py-3
                                text-lg
                                text-4xl
                                font-black
                                text-gray-800
                            " style="padding: 25px;">
                            Total: ${{ purchase_order.total_price }}
                        </span>
                        <br>
                        <br>
                        <div class="
                                p-4
                                border
                                rounded-lg
                                shadow-md
                                mt-4
                            " style="border: ridge 1px #93BC00;">
                            <b class="
                                    font-montserrat
                                    w-full
                                    my-2
                                    text-3xl
                                    font-black
                                    leading-tight
                                    text-center
                                    text-gray-800
                                ">
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
            </section>
        </template>
    </MainLayout>
</template>