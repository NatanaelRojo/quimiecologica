<template>
    <MainLayout>
        <template #main>

            <Head title="Nuestras Publicaciones" />

            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <!-- Sección -->
            <section class="gradient border-b py-3" style="min-height: 500px">
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
                        Nuestras publicaciones
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

                    <!-- Buscador y Filtros -->
                    <section>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                            <div>
                                <h2>Buscar por Nombre:</h2>
                                <input class="w-full rounded" type="text" v-model="postTitle" />
                            </div>
                            <div>
                                <h2>Buscar por Categorías:</h2>
                                <select class="w-full rounded" v-model="selectedCategories">
                                    <option value="" disabled selected>
                                        Seleccione...
                                    </option>
                                    <option v-for="category in categories" :key="category.id" :value="category.name">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <h2>Buscar por Géneros:</h2>
                                <select class="w-full rounded" v-model="selectedGenders">
                                    <option value="" disabled selected>
                                        Seleccione...
                                    </option>
                                    <option v-for="gender in genders" :key="gender.id" :value="gender.name">
                                        {{ gender.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <button class="
                                font-montserrat
                                gradient-green
                                mt-4
                                bg-blue-500
                                text-white
                                py-2 px-4
                                rounded-md
                                hover:bg-blue-600
                                focus:outline-none
                                focus:border-blue-700
                                focus:ring
                                focus:ring-blue-200
                                font-bold
                            " type="button" @click="filterPosts">
                            Buscar
                        </button>
                        <button class="
                                font-montserrat
                                gradient-green
                                mt-4
                                ml-2
                                bg-blue-500
                                text-white
                                py-2 px-4
                                rounded-md
                                hover:bg-blue-600
                                focus:outline-none
                                focus:border-blue-700
                                focus:ring
                                focus:ring-blue-200
                                font-bold
                            " type="button" @click="clearFilters">
                            Limpiar
                        </button>
                    </section>
                    <!-- Fin Buscador y Filtros -->

                    <br>

                    <!-- posts grid-->
                    <div v-if="posts.length > 0" class="
                            grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8
                        ">
                        <!-- Iterate on posts -->
                        <template v-for="post in posts" :key="post.id">
                            <div class="
                                    bg-white
                                    p-4 border
                                    border-gray-200
                                    rounded-lg
                                    shadow-md
                                    transition-transform
                                    hover:transform
                                    hover:scale-105
                                ">
                                <!-- Información a la izquierda -->
                                <div class="flex flex-col items-start">
                                    <Link :href="route(
                                        'posts.detail',
                                        post.slug
                                        )
                                    ">
                                        <img :src="`/storage/${post.thumbnail}`"
                                            alt="Imagen de la publicación"
                                            class="
                                                w-full h-40 mb-4
                                                rounded-md img-zoom
                                            ">
                                        <div>
                                            <h3 class="
                                                        text-lg
                                                        font-semibold
                                                        mb-2
                                                        text-gray-800
                                                    ">
                                                {{ post.title }}
                                            </h3>
                                            <p class="text-gray-600 mb-4 text-justify">
                                                <span v-html="truncateText(post.body, 200)"></span>
                                            </p>
                                            <div class="flex space-x-2">
                                                <span>Categorías:</span>
                                                <div
                                                    v-for="(category, index) of post.categories"
                                                    :key="index" class="text-gray-600"
                                                >
                                                    {{ category.name }}
                                                </div>
                                            </div>
                                            <div class="flex space-x-2 mt-2">
                                                <span>Géneros:</span>
                                                <div v-for="(gender, index) of post.genders"
                                                    :key="index" class="text-gray-600"
                                                >
                                                    {{ gender.name }}
                                                </div>
                                            </div>
                                        </div>
                                    </Link>
                                </div>
                            </div>
                        </template>
                        <!-- Fin de la iteración de posts-->
                    </div>
                    <h2 v-else class="
                            w-full
                            my-2 text-5xl
                            font-black
                            leading-tight
                            text-center text-gray-800
                        ">
                        {{ isFiltered ?
                'No hay coincidencias' :
                        'No hay publicaciones disponibles' }}
                    </h2>

                    <!-- End of grid posts -->
                </div>
            </section>
            <!-- End of section -->
        </template>
    </MainLayout>
</template>
<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head, Link } from '@inertiajs/vue3';
import axios from "axios";
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const isFiltered = ref(false);
const fullPage = ref(true);
const posts = ref([]);
// const selectedCategories = ref([]);
// const selectedGenders = ref([]);
const selectedCategories = ref('');
const selectedGenders = ref('');

const postTitle = ref('');
const categories = ref([]);
const genders = ref([]);

onBeforeMount(async () => {
    // Iniciar spinner de carga.
    isLoading.value = true;
});

onMounted(async () => {
    try {
        let response = await axios.get("/api/posts");
        posts.value = response.data;
        response = await axios.get('/api/categories');
        categories.value = response.data;
        response = await axios.get('/api/genders');
        genders.value = response.data;
    } catch (error) {
        console.error(error);
    }
    // Finalizar spinner de carga.
    isLoading.value = false;
});

const filterPosts = async () => {
    try {
        isFiltered.value = true;
        const queryParams = {
            title: postTitle.value,
            // categories: selectedCategories.value.join(','),
            // genders: selectedGenders.value.join(','),
            categories: selectedCategories.value,
            genders: selectedGenders.value,
        }
        const response = await axios.get('/api/posts', {
            params: queryParams,
        });
        posts.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

/**
 * Regresar al componente anterior.
*/
const goBack = () => {
    window.history.back();
}

/**
 * Truncar la cantidad de caracteres ded un texto que se muestran.
*/
const truncateText = (text, maxLength) => {
    if (text.length > maxLength) {
        return text.substring(0, maxLength) + '...';
    } else {
        return text;
    }
}

const clearFilters = async () => {
    try {
        isFiltered.value = false;
        postTitle.value = '';
        // selectedCategories.value = [];
        // selectedGenders.value = [];
        selectedCategories.value = '';
        selectedGenders.value = '';
        const response = await axios.get('/api/posts');
        posts.value = response.data;
    } catch (error) {
        console.error(error);
    }
}
</script>
