<template>
    <MainLayout>
        <template #main>

            <Head title="Nuestras Publicaciones" />

            <loading
                :active="isLoading"
                :is-full-page="fullPage"
                color="#82675C"
            ></loading>

            <!-- Sección -->
            <section class="bg-white border-b py-3">
                <div class="container max-w-5xl mx-auto m-8">
                    <a
                        href="#"
                        class="font-montserrat"
                        @click.prevent="goBack"
                    >
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
                        Nuestras Publicaciones
                    </h2>
                    <div class="w-full mb-4">
                        <div
                            class="
                                gradient-green
                                h-1
                                mx-auto
                                w-64
                                opacity-75
                                my-0
                                py-0
                                rounded-t
                            "
                        ></div>
                    </div>

                    <br>

                    <section class="mb-4">
                        <div>
                            <h2>Buscar por Nombre:</h2>
                            <input v-model="postTitle" type="text" placeholder="" />
                        </div>
                        <br>
                        <div>
                            <h2>Categorias</h2>
                            <select v-model="selectedCategories" multiple>
                                <option value="" disabled selected>Seleccione</option>
                                <option v-for="category in categories" :key="category.id" :value="category.name">{{
                                    category.name }}</option>
                            </select>
                        </div>
                        <div>
                            <h2>Generos:</h2>
                            <select v-model="selectedGenders" multiple>
                                <option value="" disabled selected>Seleccione</option>
                                <option v-for="gender in genders" :key="gender.id" :value="gender.name">{{ gender.name
                                }}
                                </option>
                            </select>
                        </div>
                        <button
                            class="
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
                            "
                            type="button"
                            @click="filterPosts"
                        >
                            Buscar
                        </button>
                        <button
                            class="
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
                            "
                            type="button"
                            @click="clearFilters"
                        >
                            Limpiar
                        </button>
                    </section>

                    <br>

                    <!-- posts grid-->
                    <div
                        v-if="posts.length > 0"
                        class="
                            grid
                            grid-cols-1
                            sm:grid-cols-2
                            lg:grid-cols-3
                            gap-8
                        "
                    >
                        <!-- Iterate on posts -->
                        <template v-for="post in posts" :key="post.id">
                            <div
                                class="
                                    bg-white
                                    p-4 border
                                    border-gray-200
                                    rounded-lg
                                    shadow-md
                                    transition-transform
                                    hover:transform
                                    hover:scale-105
                                "
                            >
                                <!-- Información a la izquierda -->
                                <div class="flex flex-col items-start">
                                    <img
                                        :src="`/storage/${post.thumbnail}`"
                                        alt="Imagen de la publicación"
                                        class="
                                            w-full
                                            h-40
                                            object-cover
                                            mb-4
                                            rounded-md
                                            img-zoom
                                        "
                                    >
                                    <div>
                                        <Link
                                            :href="route(
                                                'posts.detail',
                                                post.slug
                                            )"
                                        >
                                        <h3
                                            class="
                                                text-lg
                                                font-semibold
                                                mb-2
                                                text-gray-800
                                            "
                                        >
                                            {{ post.title }}
                                        </h3>
                                        </Link>

                                        <div class="flex space-x-2">
                                            <div v-for="
                                                    (category, index)
                                                        of post.categories
                                                " :key="index" class="text-gray-600">
                                                {{ category.name }}
                                            </div>
                                        </div>
                                        <div class="flex space-x-2 mt-2">
                                            <div
                                                v-for="(gender, index)
                                                    of post.genders"
                                                :key="index"
                                                class="text-gray-600"
                                            >
                                                {{ gender.name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <!-- Fin de la iteración de posts-->
                    </div>
                    <h2
                        v-else
                        class="
                            w-full
                            my-2 text-5xl
                            font-black
                            leading-tight
                            text-center text-gray-800
                        "
                    >
                        No hay publicaciones disponibles
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
const fullPage = ref(true);
const posts = ref([]);
const selectedCategories = ref([]);
const selectedGenders = ref([]);
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
        // Finalizar spinner de carga.
        isLoading.value = false;
    } catch (error) {
        console.error(error);
    }
});

const FilterPosts = async () => {
    try {
        const queryParams = {
            title: productTitle.value,
            categories: selectedCategories.value.join(','),
            genders: selectedGenders.value.join(','),
        }
        const response = await axios.get('/api/products', {
            params: queryParams,
        });
        products.value = response.data;
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

const clearFilters = async () => {
    try {
        postTitle.value = '';
        selectedCategories.value = [];
        selectedGenders.value = [];
        const response = await filterProducts();
        products.value = response.data;
    } catch (error) {
        console.error(error);
    }
}
</script>
