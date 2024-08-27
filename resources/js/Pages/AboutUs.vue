<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);
const LogoQuimiecologi01 = '/images/Logo-Quimiecologi-01.png';

/**
 * Regresar al componente anterior.
*/
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

            <Head title="Conócenos" />

            <loading
                :active="isLoading"
                :is-full-page="fullPage"
                color="#82675C"
            ></loading>

            <!-- Sección -->
            <section class="gradient border-b py-3">
                <div class="container max-w-5xl mx-auto m-8">
                    <a
                        href="#"
                        class="font-montserrat"
                        @click.prevent="goBack"
                    >
                        <i class="fa fa-chevron-left fa-lg ollapsed"></i> Atrás
                    </a>
                    <h2
                        class="
                            font-montserrat
                            w-full
                            my-2
                            text-5xl
                            font-black
                            leading-tight
                            text-center
                            text-gray-800
                        "
                    >
                        Conócenos
                    </h2>
                    <div class="w-full mb-4">
                        <div
                            class="
                                gradient-green
                                h-1
                                mx-auto
                                w-64
                                opacity-75
                                my-0
                                py-0
                                rounded-t
                            "
                        ></div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="mt-5 w-full text-justify">
                            <p class="font-montserrat mb-8">
                                <b>
                                    Diseña un mundo de cuidado, con el aliado que te mereces
                                </b>
                                <br>
                                <br>
                                <p>
                                    Somos una empresa nacional que diseña y elabora
                                    productos de cuidado personal; además,
                                    prestamos servicios diversos y asesorías a
                                    empresas o personas que lo requieran.
                                </p>
                                <br>
                                <p>
                                    Contamos con una marca registrada de alcance
                                    nacional: BASTT. Actualmente especializada
                                    en el cuidado preventivo del rostro.
                                </p>
                                <br>
                                <p>
                                    <b>
                                        ¿Por qué elegirnos?
                                    </b>
                                    <br>
                                    <br>
                                    <ul>
                                        <li>• Asesoría exclusiva, considerando tus deseos</li>
                                        <li>• Nos adaptamos a tus necesidades</li>
                                        <li>• Diseño y fabricación de tus productos, con profesionalismo y calidad</li>
                                    </ul>
                                </p>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Final Sección -->
        </template>
    </MainLayout>
</template>

