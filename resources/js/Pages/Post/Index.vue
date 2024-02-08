<template>
    <MainLayout>
        <template #main>

            <Head title="Servicios" />

            <loading
                :active="isLoading"
                :is-full-page="fullPage"
            ></loading>

            <!-- Sección Servicios -->
            <section class="bg-gray-100 border-b py-3">
                <div class="container max-w-5xl mx-auto m-8">
                    <h2
                        v-if="posts.length > 0"
                        class="
                            w-full
                            my-2 text-5xl
                            font-black
                            leading-tight
                            text-center text-gray-800
                        "
                    >
                        Nuestras Publicaciones
                    </h2>
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
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>

                    <br>

                    <!-- posts grid-->
                    <div
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
                                        "
                                    >
                                    <div>
                                        <Link
                                            :href="
                                                route('posts.detail', post.slug)
                                            "
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
                                            <div
                                                v-for="
                                                    (category, index)
                                                        of post.categories
                                                "
                                                :key="index"
                                                class="text-gray-600">
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

                    <!-- End of grid posts -->
                </div>
            </section>
            <!-- End of posts section -->
        </template>
    </MainLayout>
</template>
<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);
const posts = ref([]);

onBeforeMount(async () => {
    // Iniciar spinner de carga.
    isLoading.value = true;
});

onMounted(async () => {
    try {
        const response = await axios.get("/api/posts");
        posts.value = response.data;
        // Finalizar spinner de carga.
        isLoading.value = false;
    } catch (error) {
        console.error(error);
    }
});
</script>
