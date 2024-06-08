<template>
    <MainLayout>
        <template #main>

            <Head title="Detalle del Producto" />

            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <!-- Sección -->
            <section class="gradient border-b py-3">
                <div class="container max-w-7xl mx-auto m-8">
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
                        {{ product.name }}
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
                            ">
                        </div>
                    </div>

                    <br>

                    <div class="lg:w-1/2 lg:mr-8 mb-4">
                        <img v-for="(imageUrl, index) in product.image_urls" :key="index" :src="`/storage/${imageUrl}`"
                            alt="Imagen del producto" class="w-full h-auto img-zoom" style="
                                padding: 20px;
                            " />
                    </div>

                    <!-- Detalles del producto -->
                    <div class="">
                        <h1 class="text-3xl font-bold mb-2">{{ product.name }}</h1>
                        <p class="text-gray-600 mb-4 text-justify">
                            <span v-html="product.description"></span>
                        </p>
                        <div class="flex space-x-2 mb-2">
                            <span>Marca: </span>
                            <span class="text-gray-600">
                                {{ product?.brand.name }}
                            </span>
                        </div>
                        <div class="flex space-x-2 mb-2">
                            <span>Clase:</span>
                            <span class="text-gray-600">
                                {{ product?.primary_class.name }}
                            </span>
                        </div>
                        <div class="flex space-x-2">
                            <span>Subclase:</span>
                            <div v-for="(category, index) of product.categories" :key="index" class="text-gray-600">
                                {{ category.name }}
                            </div>
                        </div>
                        <div class="flex space-x-2 mt-2">
                            <span>Cuota:</span>
                            <div v-for="(gender, index) of product.genders" :key="index" class="text-gray-600">
                                {{ gender.name }}
                            </div>
                        </div>
                        <div class="flex space-x-2 mt-2">
                            <span>Presentación:</span>
                            <div v-for="(measure, index) of product.measures" :key="index" class="text-gray-600">
                                <span v-if="measure.quantity > 0">
                                    {{ measure.quantity }}
                                </span>
                                {{ measure.unit }}
                                {{ measure.size }}
                            </div>
                        </div>
                        <div class="flex space-x-2 mt-2">
                            <span>Tipo de venta:</span>
                            <div class="text-gray-600">
                                <span class="
                                        gradient-green
                                        rounded-full
                                        px-3
                                        py-1
                                        text-sm
                                        text-gray-700
                                    ">
                                    {{ product.type_sale.name }}
                                </span>
                            </div>
                        </div>
                        <hr class="mt-5 mb-5">
                        <h2 class="
                                w-full
                                my-2
                                text-3xl
                                font-black
                                leading-tight
                                text-gray-800
                            ">
                            Precio: ${{ product.price }}
                        </h2>
                    </div>
                </div>
            </section>
        </template>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);

const props = defineProps({
    product: { type: Object, required: true },
});

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

onMounted(async () => {
    // Finalizar spinner de carga.
    isLoading.value = false;
});
</script>