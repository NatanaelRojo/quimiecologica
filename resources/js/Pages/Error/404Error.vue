<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3'
</script>

<template>
    <MainLayout>
        <template #main>

            <Head title="Recurso no encontrado" />
            <section class="bg-white border-b py-3" style="min-height: 500px">
                <div class="container max-w-5xl mx-auto m-10">
                    <h2
                        class="
                            font-montserrat
                            w-full
                            text-5xl
                            font-black
                            leading-tight
                            text-center
                            text-gray-800
                        "
                    >
                        No se encontró el recurso
                        <br>
                        <br>
                        Error 404
                    </h2>
                </div>
            </section>
        </template>
    </MainLayout>
</template>