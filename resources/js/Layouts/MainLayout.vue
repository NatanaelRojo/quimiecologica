<template>
    <Header />
    <main class="p-4 sm:ml-64 mt-6">
        <slot name="main" />
    </main>
    <Footer />
</template>
<script setup>
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
</script>