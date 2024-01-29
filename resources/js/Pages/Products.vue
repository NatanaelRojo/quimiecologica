<script setup>
import { onMounted, ref } from 'vue'
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';

const products = ref([]);
const url = ref("storage/01HMN0KJVX76TSTS2NPXTNMPX1.png");

onMounted(async () => {
    console.log('entra en el mounted');
    const response = await axios.get("/api/products");
    console.log(response.data);
    products.value = response.data;
    // console.log(products);
});
</script>

<template>
    <Head title="Productos" />

    <!-- Sección Productos -->
    <section class="bg-white border-b py-12 ">
        <div class="container max-w-5xl mx-auto m-8">
            <h2 class="w-full my-2 text-5xl font-black leading-tight text-center text-gray-800">
                Productos
            </h2>
        </div>
        <div v-if="products.length > 0">
            <template v-for="product in products" :key="product.id">
                <h3>{{ product.name }}</h3>
                <h4>{{ product.description }}</h4>
                <h4>{{ product.price }}</h4>
                <img :src="`storage/${product.image_urls[0]}`">
                <div>
                    <p>Categorias:</p>
                    <p v-for="(category, index) of product.categories" :key="index">
                        {{ category.name }}
                    </p>
                </div>
                <div>
                    <p>Generos</p>
                    <p v-for="(gender, index) of product.genders" :key="index">
                        {{ gender.name }}
                    </p>
                </div>
            </template>
        </div>
        <div v-else>
            <p>No hay productos registrados</p>
        </div>
    </section>
    <!-- Final Sección Productos -->
</template>
