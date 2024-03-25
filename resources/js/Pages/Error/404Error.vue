<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3'
</script>

<template>
    <MainLayout>
        <template #main>

            <Head title="Recurso no encontrado" />
            <section class="bg-white border-b py-3">
                <h1 class="
                font-montserrat
                w-full
                my-2
                text-5xl
                font-black
                leading-tight
                            text-center
                            text-gray-800
                ">No se encontró el recurso</h1>
                <h2 class="
                font-montserrat
                w-full
                my-2
                text-5xl
                font-black
                leading-tight
                            text-center
                            text-gray-800
                ">Error 404</h2>
            </section>
        </template>
    </MainLayout>
</template>