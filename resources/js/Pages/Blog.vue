<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const imagePath = '/images/1.jpg';
</script>

<template>
    <MainLayout>
        <template #main>

            <Head title="Blog" />

            <!-- Sección Productos -->
            <section class="bg-white border-b py-12 ">
                <div class="container max-w-5xl mx-auto m-8">
                    <h2 class="w-full my-2 text-5xl font-black leading-tight text-center text-gray-800">
                        Blog
                    </h2>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="w-5/6 sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                                Lorem ipsum dolor sit amet
                            </h3>
                            <p class="text-gray-600 mb-8">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                                <br />
                                <br />

                                Images from:
                                <a class="text-orange-500 underline" href="https://undraw.co/">
                                    undraw.co
                                </a>
                            </p>
                        </div>
                        <div class="w-full sm:w-1/2 p-6">
                            <img :src="imagePath" alt="" class="w-full h-auto mx-auto">
                        </div>
                    </div>

                    <div class="flex flex-wrap flex-col-reverse sm:flex-row">
                        <div class="w-full sm:w-1/2 p-6 mt-6">
                            <img :src="imagePath" alt="" class="w-full h-auto mx-auto">
                        </div>
                        <div class="w-full sm:w-1/2 p-6 mt-6">
                            <div class="align-middle">
                                <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                                    Lorem ipsum dolor sit amet
                                </h3>
                                <p class="text-gray-600 mb-8">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                    at ipsum eu nunc commodo posuere et sit amet ligula.<br /><br />
                                    Images from:
                                    <a class="text-orange-500 underline" href="https://undraw.co/">undraw.co</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Final Sección Productos -->
        </template>
    </MainLayout>
</template>

<style></style>
