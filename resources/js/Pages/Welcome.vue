<script setup>
import { Head, Link } from '@inertiajs/vue3';

const message = "Hello!!!";
</script>

<template>
    <Head title="Welcome" />

    <!-- Navbar -->
    <nav class="bg-blue-500 text-white p-4">
        <div class="container mx-auto">
        <ul class="flex justify-center">
            <li class="mr-6"><a href="#" class="hover:text-gray-300">Enlace 1</a></li>
            <li class="mr-6"><a href="#" class="hover:text-gray-300">Enlace 2</a></li>
            <li><a href="#" class="hover:text-gray-300">Enlace 3</a></li>
        </ul>
        </div>
    </nav>

    <!-- Sección 1 (Fondo blanco) -->
    <section class="bg-white py-16">
        <div class="container mx-auto">
        <!-- Contenido de la sección 1 -->
        <h1 class="text-4xl font-bold mb-4">{{ message }}</h1>
        <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
    </section>

    <!-- Sección 2 (Fondo gris) -->
    <section class="bg-gray-200 py-16">
        <div class="container mx-auto">
        <!-- Contenido de la sección 2 -->
        <h2 class="text-3xl font-bold mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
        <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
    </section>

    <!-- Sección 3 (Fondo blanco) -->
    <section class="bg-white py-16">
        <div class="container mx-auto">
        <!-- Contenido de la sección 3 -->
        <h2 class="text-3xl font-bold mb-4">Contact</h2>
        <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto text-center">
        <!-- Contenido del footer -->
        <p>&copy; 2024 Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
    </footer>
</template>

<style>
</style>
