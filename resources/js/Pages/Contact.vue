<script setup>
import NavBar from '@/Layouts/NavBar.vue';
import { Head, Link } from '@inertiajs/vue3';

const LogoQuimiecologi01 = '/images/Logo-Quimiecologi-01.png';
</script>

<template>
    <Head title="Contacto" />

    <NavBar />

    <!-- Sección -->
    <section class="bg-white border-b py-12 ">
        <div class="container max-w-5xl mx-auto m-8">
            <h2 class="w-full my-2 text-5xl font-black leading-tight text-center text-gray-800">
                Contacto
            </h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <br>

            <img
                :src="LogoQuimiecologi01"
                alt="Quimiecologi C.A."
                class="max-w-lg block mx-auto h-auto"
            />

            <div class="flex flex-wrap">
                <div class="mt-5 w-full">
                    <p class="text-gray-600 mb-8">
                        Mérida, Mérida
                        <br>
                        Tlf: XXXXX
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Final Sección -->
</template>

<style>
</style>
