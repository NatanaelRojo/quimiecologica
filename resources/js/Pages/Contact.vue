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

            <Head title="Contacto" />

            <loading
                :active="isLoading"
                :is-full-page="fullPage"
                color="#82675C"
            ></loading>

            <!-- Sección -->
            <section class="gradient border-b py-3" style="min-height: 500px">
                <div class="container max-w-6xl mx-auto m-8">
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
                        Contáctanos
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
                    <div
                        class="flex flex-wrap"
                        style="padding: 50px"
                    >
                        <div class="mt-5 w-full">
                            <div
                                class="
                                    grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8
                                "

                            >
                                <div
                                    class="font-montserrat mb-8"
                                    style="
                                        font-size: 18px;
                                        color: #82675C;
                                        width: 150%;
                                    "
                                >
                                    <div class="grid grid-cols-3 gap-4">
                                        <div
                                            class="text-center"
                                            style="
                                                color: #82675C;
                                                font-size: 20px;
                                            "
                                        >
                                        <i class="fa-solid fa-phone"></i>
                                        </div>
                                        <div
                                            class="font-montserrat text-center col-span-2 ..."
                                            style="
                                                font-size: 20px;
                                                color: #82675C;
                                            "
                                        >
                                            A. Cliente: 0412-5347169
                                        </div>
                                        <div
                                            class="text-center"
                                            style="
                                                color: #82675C;
                                                font-size: 20px;
                                            "
                                        >
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <div
                                            class="font-montserrat text-center col-span-2 ..."
                                            style="
                                                font-size: 20px;
                                                color: #82675C;
                                            "
                                        >
                                            quimiecologica.llcv@gmail.com
                                        </div>
                                    </div>
                                </div>
                                <div
                                    style="
                                    "
                                ></div>
                                <div
                                    class="font-montserrat mb-8"
                                    style="
                                        font-size: 20px;
                                        color: #82675C;
                                    "
                                >
                                    <div class="grid grid-cols-3 gap-4">
                                        <div
                                            class="text-center"
                                            style="
                                                color: #82675C;
                                                font-size: 20px;
                                            "
                                        >
                                            <i class="fa-brands fa-square-instagram"></i>
                                        </div>
                                        <div
                                            class="font-montserrat text-center col-span-2 ..."
                                            style="
                                                font-size: 20px;
                                                color: #82675C;
                                                margin-left: -100px;
                                            "
                                        >
                                            <a
                                                href="https://www.instagram.com/basttvzla/"
                                                target="__blank"
                                            >
                                                @basttvzla
                                            </a>
                                        </div>
                                        <div
                                            class="text-center"
                                            style="
                                                color: #82675C;
                                                font-size: 20px;
                                            "
                                        >
                                            <i class="fa-brands fa-tiktok"></i>
                                        </div>
                                        <div
                                            class="font-montserrat text-center col-span-2 ..."
                                            style="
                                                font-size: 20px;
                                                color: #82675C;
                                                margin-left: -100px;
                                            "
                                        >
                                            <a
                                                href="https://www.tiktok.com/@basttvzla"
                                                target="__blank"
                                            >
                                                @basttvzla
                                            </a>
                                        </div>
                                        <div
                                            class="text-center"
                                            style="
                                                color: #82675C;
                                                font-size: 20px;
                                            "
                                        >
                                            <i class="fa-brands fa-linkedin"></i>
                                        </div>
                                        <div
                                            class="font-montserrat text-center col-span-2 ..."
                                            style="
                                                font-size: 20px;
                                                color: #82675C;
                                                margin-left: -100px;
                                            "
                                        >
                                            <a
                                                href="
                                                    https://www.linkedin.com/company/laboratorio-quimiecologi-c-a-l%C3%ADnea-facial-bastt%C2%AE
                                                "
                                                target="__blank"
                                            >
                                                Quimiecolgi C.A.
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Final Sección -->
        </template>
    </MainLayout>
</template>
