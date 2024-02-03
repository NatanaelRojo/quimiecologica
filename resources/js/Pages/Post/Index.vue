<template>
    <MainLayout>
        <template #main>

            <Head title="Publicaciones" />

            <!-- Posts section-->
            <section class="bg-white border-b py-12">
                <div class="container mx-auto">
                    <h2 v-if="posts.length > 0" class="text-3xl font-bold text-center text-gray-800 mb-8">
                        Nuestras Publicaciones
                    </h2>
                    <h2 v-else class="text-3xl font-bold text-center text-gray-800 mb-8">
                        No hay publicaciones disponibles
                    </h2>

                    <!-- posts grid-->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Iterate on posts -->
                        <template v-for="post in posts" :key="post.id">
                            <div
                                class="bg-white p-4 border border-gray-200 rounded-lg shadow-md transition-transform hover:transform hover:scale-105">
                                <!-- Información a la izquierda -->
                                <div class="flex flex-col items-start">
                                    <img :src="`/storage/${post.thumbnail}`" alt="Imagen del post"
                                        class="w-full h-40 object-cover mb-4 rounded-md">
                                    <div>
                                        <Link :href="route('posts.detail', post.slug)">
                                        <h3 class="text-lg font-semibold mb-2 text-gray-800">{{ post.title }}</h3>
                                        </Link>

                                        <!-- <div v-html="post.body" class="text-gray-600 mb-4"></div> -->
                                        <div class="flex space-x-2">
                                            <div v-for="(category, index) of post.categories" :key="index"
                                                class="text-gray-600">
                                                {{ category.name }}
                                            </div>
                                        </div>
                                        <div class="flex space-x-2 mt-2">
                                            <div v-for="(gender, index) of post.genders" :key="index" class="text-gray-600">
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
import { onMounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const posts = ref([]);

onMounted(async () => {
    try {
        const response = await axios.get("/api/posts");
        posts.value = response.data;
    } catch (error) {
        console.error(error);
    }
});
</script>
