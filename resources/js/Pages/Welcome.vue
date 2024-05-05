<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);
const imagePath = '/images/1.jpg';
const productOne = '/images/producto-1.png';
const profile_1 = '/images/profile_1.png';
const profile_2 = '/images/profile_2.png';
const profile_3 = '/images/profile_3.png';
const profile_4 = '/images/profile_4.png';
const profile_5 = '/images/profile_5.png';
const profile_6 = '/images/profile_6.png';
const LogoQuimiecologi01 = '/images/Logo-Quimiecologi-01.png';

// Imágenes de los servicios

const servicios_pulverizacion = 'images/servicios/servicios_pulverizacion.png';
const servicios_analisis_muestras = 'images/servicios/servicios_analisis_muestras.png';

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

            <Head title="Inicio" />

            <loading :active="isLoading" :is-full-page="fullPage" color="#82675C"></loading>

            <!-- Sección Opiniones de clientes -->
            <div class="">
                <section class="bg-white border-b py-3 gradient mt-6">
                    <div class="container max-w-5xl mx-auto m-8 font-montserrat">
                        <h2 class="
                                font-montserrat
                                w-full
                                my-2 text-5xl
                                font-black
                                leading-tight
                                text-center
                                text-gray-800
                            ">
                            ¡Nuestros clientes lo dicen todo!
                        </h2>
                        <div class="w-full mb-4">
                            <div class="
                                    gradient-green
                                    h-1
                                    mx-auto
                                    w-64
                                    opacity-75
                                    my-0
                                    py-0
                                    rounded-t
                                "></div>
                        </div>
                        <br>
                        <div class="flex flex-wrap">
                            <div class="-mx-3 md:flex items-start">
                                <div class="px-3 md:w-1/3">
                                    <div class="
                                            w-full
                                            mx-auto
                                            rounded-lg
                                            bg-white
                                            border
                                            border-gray-200
                                            p-5
                                            text-gray-800
                                            font-light
                                            mb-6
                                            img-zoom
                                        ">
                                        <div class="w-full flex mb-4 items-center">
                                            <div class="
                                                    overflow-hidden
                                                    rounded-full
                                                    w-10
                                                    h-10
                                                    bg-gray-50
                                                    border
                                                    border-gray-200
                                                ">
                                                <img :src="profile_1" class="w-80 h-auto mx-auto img-zoom">
                                            </div>
                                            <div class="flex-grow pl-3">
                                                <h6 class="
                                                        font-bold
                                                        text-sm
                                                        uppercase
                                                        text-gray-600
                                                    ">
                                                    Karla Parra.
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-xl text-sm leading-tight text-justify">
                                                "¡Los productos de cuidado personal
                                                de esta tienda son increíbles! Mi
                                                piel nunca ha lucido tan radiante y
                                                saludable. ¡Definitivamente los
                                                recomiendo!"
                                            </p>
                                        </div>
                                    </div>
                                    <div class="
                                            w-full
                                            mx-auto
                                            rounded-lg
                                            bg-white
                                            border
                                            border-gray-200
                                            p-5
                                            text-gray-800
                                            font-light
                                            mb-6
                                            img-zoom
                                        ">
                                        <div class="w-full flex mb-4 items-center">
                                            <div class="
                                                    overflow-hidden
                                                    rounded-full
                                                    w-10
                                                    h-10
                                                    bg-gray-50
                                                    border
                                                    border-gray-200
                                                ">
                                                <img :src="profile_2" class="w-80 h-auto mx-auto img-zoom">
                                            </div>
                                            <div class="flex-grow pl-3">
                                                <h6 class="
                                                        font-bold
                                                        text-sm
                                                        uppercase
                                                        text-gray-600
                                                    ">
                                                    María Zerpa.
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-xl text-sm leading-tight text-justify">
                                                "Estoy encantada con los resultados
                                                que he obtenido utilizando los
                                                productos de esta marca. ¡Mi rutina
                                                de cuidado personal nunca ha sido
                                                tan efectiva y placentera!"
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-3 md:w-1/3">
                                    <div class="
                                            w-full
                                            mx-auto
                                            rounded-lg
                                            bg-white
                                            border
                                            border-gray-200
                                            p-5
                                            text-gray-800
                                            font-light mb-6
                                            img-zoom
                                        ">
                                        <div class="w-full flex mb-4 items-center">
                                            <div class="
                                                    overflow-hidden
                                                    rounded-full
                                                    w-10
                                                    h-10
                                                    bg-gray-50
                                                    border
                                                    border-gray-200
                                                ">
                                                <img :src="profile_3" class="w-80 h-auto mx-auto img-zoom">
                                            </div>
                                            <div class="flex-grow pl-3">
                                                <h6 class="
                                                        font-bold
                                                        text-sm
                                                        uppercase
                                                        text-gray-600
                                                    ">
                                                    Andrea Pérez.
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-xl text-sm leading-tight text-justify">
                                                "Desde que empecé a usar estos
                                                productos, he notado una gran
                                                mejoría en la textura y apariencia
                                                de mi piel. ¡Son simplemente
                                                maravillosos!"
                                            </p>
                                        </div>
                                    </div>
                                    <div class="
                                            w-full
                                            mx-auto
                                            rounded-lg
                                            bg-white
                                            border
                                            border-gray-200
                                            p-5
                                            text-gray-800
                                            font-light
                                            mb-6
                                            img-zoom
                                        ">
                                        <div class="w-full flex mb-4 items-center">
                                            <div class="
                                                    overflow-hidden
                                                    rounded-full
                                                    w-10
                                                    h-10
                                                    bg-gray-50
                                                    border
                                                    border-gray-200
                                                ">
                                                <img :src="profile_5" class="w-80 h-auto mx-auto img-zoom">
                                            </div>
                                            <div class="flex-grow pl-3">
                                                <h6 class="
                                                        font-bold
                                                        text-sm
                                                        uppercase
                                                        text-gray-600
                                                    ">
                                                    Charlie Contreras.
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-xl text-sm leading-tight text-justify">
                                                "He probado innumerables productos
                                                de cuidado personal, y ninguno se
                                                compara a la calidad y efectividad
                                                de los que ofrece esta tienda. ¡Para
                                                mi ahora son imprescindibles!"
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-3 md:w-1/3">
                                    <div class="
                                            w-full
                                            mx-auto
                                            rounded-lg
                                            bg-white
                                            border
                                            border-gray-200
                                            p-5
                                            text-gray-800
                                            font-light
                                            mb-6
                                            img-zoom
                                        ">
                                        <div class="w-full flex mb-4 items-center">
                                            <div class="
                                                    overflow-hidden
                                                    rounded-full
                                                    w-10
                                                    h-10
                                                    bg-gray-50
                                                    border
                                                    border-gray-200
                                                ">
                                                <img :src="profile_6" class="w-80 h-auto mx-auto img-zoom">
                                            </div>
                                            <div class="flex-grow pl-3">
                                                <h6 class="
                                                        font-bold
                                                        text-sm
                                                        uppercase
                                                        text-gray-600
                                                    ">
                                                    Nevada Páez.
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-xl text-sm leading-tight text-justify">
                                                "Mis expectativas han sido superadas
                                                con creces desde que comencé a usar
                                                estos productos. Mi piel se siente
                                                renovada y luce más saludable que
                                                nunca. ¡Gracias por crear productos
                                                tan asombrosos!"
                                            </p>
                                        </div>
                                    </div>
                                    <div class="
                                            w-full
                                            mx-auto
                                            rounded-lg
                                            bg-white
                                            border
                                            border-gray-200
                                            p-5
                                            text-gray-800
                                            font-light
                                            mb-6
                                            img-zoom
                                        ">
                                        <div class="w-full flex mb-4 items-center">
                                            <div class="
                                                    overflow-hidden
                                                    rounded-full
                                                    w-10
                                                    h-10
                                                    bg-gray-50
                                                    border
                                                    border-gray-200
                                                ">
                                                <img :src="profile_4" class="w-80 h-auto mx-auto img-zoom">
                                            </div>
                                            <div class="flex-grow pl-3">
                                                <h6 class="
                                                        font-bold
                                                        text-sm
                                                        uppercase
                                                        text-gray-600
                                                    ">
                                                    Kriss Guitierrez.
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <p class="text-xl text-sm leading-tight text-justify">
                                                "No suelo dejar testimonios, pero
                                                estos productos realmente lo merecen.
                                                Mi experiencia ha sido fantástica y
                                                no puedo estar más satisfecha con
                                                los resultados que he obtenido."
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Final Sección Opiniones de clientes -->
            </div>
        </template>
    </MainLayout>
</template>
