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
            <section class="bg-white border-b py-3">
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
                        <div class="mt-5 w-full">
                            <p class="font-montserrat mb-8">
                                Somos una marca nacional que diseña y elabora
                                productos de cuidado personal, nuestra
                                estrategia es la innovación sustentable. Prestamos
                                diversos servicios y asesorías a empresas y/o
                                personas que lo requieran.
                            </p>
                            <p class="font-montserrat mb-8">
                                Contamos con una marca registrada de alcance
                                nacional, <b>BASTT</b>. Actualmente especializada
                                en el cuidado preventivo del rostro y que está
                                presente en los más importantes retailers del
                                país, así como en tiendas particulares a nivel
                                nacional.
                            </p>
                            <p class="font-montserrat mb-8">
                                La línea <b>Fusión Elemental</b> tiene en cada
                                uno de sus productos, al menos un ingrediente
                                natural y un principio activo, los cuales
                                permiten al consumidor no solo sentirse
                                resplandeciente, sino también protegido,
                                aliviado y colmado de frescura.
                            </p>
                            <p class="font-montserrat mb-8">
                                Los desarrollos son avalados por laboratorios
                                certificados, tales como laboratorios de la
                                Universidad de Los Andes y otros de naturaleza
                                privada.
                            </p>
                            <p class="font-alexbrush text-3xl text-gray-700 text-center">
                                <b>"Diseña un mundo de cuidado, con el aliado
                                    que te mereces."
                                </b>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Final Sección -->
        </template>
    </MainLayout>
</template>

