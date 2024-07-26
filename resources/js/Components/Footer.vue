<script setup>
const LogoQwhite = '/images/Logo-Q-white.png';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <!-- Footer -->
    <div>
        <footer class="gradient-brown border-b py-1 justify-between" style="font-size: 20px;">
            <div class="mx-auto mt-8 px-8">
                <div class="w-full flex flex-col md:flex-row">
                    <div class="flex-1 mb-6 ml-100 text-center">
                        <a href="/">
                            <img
                                :src="LogoQwhite"
                                class="w-32 inline-block img-zoom"
                                alt="Quimiecologi C.A."
                            />
                        </a>
                        <br>
                        <br>
                        <div
                            class="
                                font-montserrat
                                inline-block
                                text-white-brand
                                no-underline
                            "
                        >
                            <p>
                                <i class="fa-solid fa-location-dot"></i>
                                Mérida - Venezuela
                            </p>
                            <p>
                                <i class="fa-solid fa-phone"></i>
                                (+58) 274-2635666
                            </p>
                            <p>
                                <i class="fa-solid fa-envelope"></i>
                                quimiecologica.llcv@gmail.com
                            </p>
                        </div>
                    </div>

                    <div class="flex-1 text-center">
                        <ul class="list-reset mb-6">
                            <li class="mt-8 inline-block mr-2 md:block md:mr-0">
                                <Link
                                    :href="route('about-us')"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-white-brand
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "

                                >
                                    <b>Conócenos</b>
                                </Link>
                            </li>
                            <li class="inline-block mr-2 md:block md:mr-0">
                                <Link
                                    href="/brands"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-white-brand
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "

                                >
                                    <b>Productos</b>
                                </Link>
                            </li>
                            <li class="inline-block mr-2 md:block md:mr-0">
                                <Link
                                    href="/services"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-white-brand
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "

                                >
                                    <b>Servicios</b>
                                </Link>
                            </li>
                            <li class="inline-block mr-2 md:block md:mr-0">
                                <Link
                                    href="/pending-orders/create"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-white-brand
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "

                                >
                                    <b>Servicios de formulación</b>
                                </Link>
                            </li>
                            <li class="inline-block mr-2 md:block md:mr-0">
                                <Link
                                    :href="route('posts.index')"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-white-brand
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "
                                >
                                    <b>Blog</b>
                                </Link>
                            </li>
                            <li class="inline-block mr-2 md:block md:mr-0">
                                <Link
                                    :href="route('contact')"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-white-brand
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "
                                >
                                    <b>Contáctanos</b>
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <div class="flex-1 text-center">
                        <ul class="list-reset mb-6">
                            <br>
                            <li class="inline-block mr-2 md:block md:mr-0 mt-12">
                                <a
                                    href="https://www.instagram.com/basttvzla/"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-white-brand
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "
                                    target="__blank"
                                >
                                    <i class="fa-brands fa-square-instagram"></i>
                                    @basttvzla
                                </a>
                            </li>
                            <li class="inline-block mr-2 md:block md:mr-0">
                                <a
                                    href="https://www.tiktok.com/@basttvzla"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-white-brand
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "
                                    target="__blank"
                                >
                                    <i class="fa-brands fa-tiktok"></i> @basttvzla
                                </a>
                            </li>
                            <li class="inline-block mr-2 md:block md:mr-0">
                                <a
                                    href="
                                        https://www.linkedin.com/company/laboratorio-quimiecologi-c-a-l%C3%ADnea-facial-bastt%C2%AE
                                    "
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-white-brand
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "
                                    target="__blank"
                                >
                                    <i class="fa-brands fa-linkedin"></i> Quimiecolgi C.A.
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div
                        class="
                            flex-1
                            font-montserrat
                            inline-block
                            text-white-brand
                            no-underline
                            text-center
                        "
                    >
                        <ul class="list-reset mb-6">
                            <li class="inline-block mr-2 md:block md:mr-0 mt-4">
                                <i class="fa-solid fa-clock"></i>
                                <b style="font-size: 22px;">&nbsp;Planta</b>
                                <br>
                                Lunes - Viernes: 7:30 am - 3:30 pm
                            </li>
                            <hr class="mt-2 mb-2 w-1/2 mx-auto">
                            <li class="inline-block mr-2 md:block md:mr-0">
                                <i class="fa-solid fa-clock"></i>
                                <b style="font-size: 22px;">&nbsp;RRSS</b>
                                <br>
                                Lunes - Viernes: 7:30 am - 3:30 pm
                                <br>
                                Sábados 8:00 am - 9:00 pm
                                <br>
                                Domingos: 10:00 am - 3:00 pm
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- Final Footer -->
</template>