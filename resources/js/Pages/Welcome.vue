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
const LogoQuimiecologi01 = '/images/Logo-Quimiecologi-01.png';

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

            <loading
                :active="isLoading"
                :is-full-page="fullPage"
                color="#82675C"
            ></loading>

            <!-- Sección 1 -->
            <div class="container mx-auto flex flex-wrap pb-4">
                <img :src="imagePath" class="rounded-lg w-full h-auto mx-auto mb-6" />

                <div
                    class="
                        font-roboto
                        w-full
                        font-bold
                        text-xl
                        text-gray-800
                        px-6
                        text-center
                    "
                >
                    Fabricación de productos químicos
                </div>

                <p class="
                        font-roboto
                        w-full
                        text-gray-600
                        text-xs
                        md:text-sm
                        px-6
                        mt-6
                        mb-4
                        text-center
                    "
                >
                    Línea Facial BASTT®
                </p>
            </div>
            <!-- Final Sección 1 -->

            <!-- Sección Productos -->
            <section class="bg-white border-b py-3">
                <div class="container max-w-5xl mx-auto m-8">
                    <h2
                        class="
                                w-full
                                my-2 text-5xl
                                font-black
                                leading-tight
                                text-center
                                text-gray-800
                            "
                    >
                        Productos
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
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Leche desmaquillante
                            </h3>
                            <p class="text-gray-600">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-80 h-auto mx-auto">
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Tónico
                            </h3>
                            <p class="text-gray-600">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-80 h-auto mx-auto">
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Exfoliante
                            </h3>
                            <p class="text-gray-600">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-80 h-auto mx-auto">
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Crema humectante
                            </h3>
                            <p class="text-gray-600">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-80 h-auto mx-auto">
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Protector Solar, FPS 30
                            </h3>
                            <p class="text-gray-600">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                at ipsum eu nunc commodo posuere et sit amet ligula.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-80 h-auto mx-auto">
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <Link :href="route('products')">
                            <button
                                class="
                                    gradient-green
                                    mt-4
                                    bg-blue-500
                                    text-white
                                    py-2 px-4
                                    rounded-md
                                    hover:bg-blue-600
                                    focus:outline-none
                                    focus:border-blue-700
                                    focus:ring
                                    focus:ring-blue-200
                                "
                            >
                                Ver todos
                            </button>
                        </Link>
                    </div>
                </div>
            </section>
            <!-- Final Sección Productos -->

            <!-- Sección Servicios -->
            <section class="bg-gray-100 border-b py-3">
                <div class="container max-w-5xl mx-auto m-8">
                    <h2
                        class="
                            w-full
                            my-2
                            text-5xl
                            font-black
                            leading-tight
                            text-center
                            text-gray-800
                        "
                    >
                        Servicios
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
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Planificación y diseño de cosméticos
                            </h3>
                            <p class="text-gray-600">
                                ¡Anímate. Que sólo la intención ya no cuenta en
                                éstos tiempos! Materializa con nosotros tus
                                ideas y conviértelas en productos
                                personalizados, a gusto tuyo o de tus clientes.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-80 h-auto mx-auto">
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Fabricación a granel
                            </h3>
                            <p class="text-gray-600">
                                Cuenta con nosotros para fabricar a escala,
                                aquello que deseas.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-80 h-auto mx-auto">
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Asesorías
                            </h3>
                            <p class="text-gray-600">
                                Te orientamos en todas las etapas previas a
                                comercializar tus productos o marca.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-80 h-auto mx-auto">
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Análisis de muestras
                            </h3>
                            <p class="text-gray-600">
                                Si tienes el producto y desear registros de las
                                propiedades químicas (pH, viscosidad, grado de
                                alcohol, conductividad), también podemos
                                ayudarte.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-80 h-auto mx-auto">
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Pulverización
                            </h3>
                            <p class="text-gray-600">
                                Transforme en polvo cualquier sólido natural,
                                utilizado como materia prima comestible o
                                cosmético.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-80 h-auto mx-auto">
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-wrap">
                        <div class="sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-6 mt-6">
                                Molienda
                            </h3>
                            <p class="text-gray-600">
                                Reduzca el tamaño de las partículas de sólidos
                                naturales, comestibles y cosméticos.
                            </p>
                        </div>
                        <div class="sm:w-1/2">
                            <img :src="productOne" class="w-80 h-auto mx-auto">
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <Link :href="route('services')">
                            <button
                                class="
                                    gradient-green
                                    mt-4
                                    bg-blue-500
                                    text-white
                                    py-2 px-4
                                    rounded-md
                                    hover:bg-blue-600
                                    focus:outline-none
                                    focus:border-blue-700
                                    focus:ring
                                    focus:ring-blue-200
                                "
                            >
                                Ver todos
                            </button>
                        </Link>
                    </div>
                </div>
            </section>
            <!-- Final Sección Servicios -->
        </template>
    </MainLayout>
</template>
