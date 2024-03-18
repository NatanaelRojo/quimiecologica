<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref } from 'vue';

const props = defineProps({
    purchase_order: { required: true, type: Object },
});
</script>

<template>
    <MainLayout>
        <template #main>
            <h1>hola</h1>
        </template>
    </MainLayout>
</template>