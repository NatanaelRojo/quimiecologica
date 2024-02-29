<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3'
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';

const isLoading = ref(false);
const fullPage = ref(true);

const props = defineProps({
    service: { required: true, type: Object },
});

const goBack = () => {
    window.history.back();
}

onBeforeMount(async () => {
    // Iniciar spinner de carga.
    isLoading.value = true;
});

onMounted(async () => {
    // Finalizar spinner de carga.
    isLoading.value = false;
});
</script>

<template>
    <MainLayout>
        <template #main>
            <h1>prueba</h1>
        </template>
    </MainLayout>
</template>
