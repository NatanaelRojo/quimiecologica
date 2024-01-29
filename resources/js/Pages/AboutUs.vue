<script setup>
import NavBar from '@/Layouts/NavBar.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Acerca de nosotros" />

    <NavBar />

    <!-- Sección -->
    <section class="bg-white border-b py-12 ">
        <div class="container max-w-5xl mx-auto m-8">
            <h2 class="w-full my-2 text-5xl font-black leading-tight text-center text-gray-800">
                Acerca de nosotros
            </h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <div class="flex flex-wrap">
                <div class="mt-5 w-full">
                    <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                        Somos Quimiecologi C.A.
                    </h3>
                    <p class="text-gray-600 mb-8">
                        Una empresa constituida desde
                        el año 2010. Desarrollamos portafolios de consméticos y
                        líneas de productos con características naturales, de
                        origen y propiedades biodegradables.
                        <br>
                        <br>
                        Nuestra estrategia es la Innovación sustentable.
                        <br>
                        <br>
                        Los desarrollos son avalados por laboratorios
                        certificados, tales como laboratorios de la Universidad
                        de Los Andes y otros de naturaleza privada.
                        <br>
                        <br>
                        El enfoque central ha sido el cuidado de la piel, tanto
                        de damas como de caballeros.
                        <br>
                        <br>
                        Contamos una línea principal, bajo la marca registrada
                        BASTT® diseñada para el cuidado facial femenino, cuyo
                        portafolio está integrado por 6 productos:
                        <br>
                        <br>
                        - Limpiador y desmaquillante bifásico.
                        <br>
                        - 2 tónicos astringentes con ácido salicílico.
                        <br>
                        - Exfoliante de semillas de durazno.
                        <br>
                        - Crema humectante con cera de abeja.
                        <br>
                        - Protector solar con TiO2.
                        <br>
                        <br>
                        La marca BASTT® de Quimiecologi C.A. está presente en
                        los más importantes retailers de Venezuela, así como en
                        tiendas particulares a nivel nacional.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Final Sección -->
</template>

<style>
</style>
