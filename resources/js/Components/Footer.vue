<script setup>
const LogoQblack = '/images/Logo-Q-black.png';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <!-- Footer -->
    <div>
        <footer class="gradient-brown border-b py-1">
            <div class="mx-auto mt-8 px-8">
                <div class="w-full flex flex-col md:flex-row">
                    <div class="flex-1 mb-6 ml-14">
                        <a href="/">
                            <img
                                :src="LogoQblack"
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
                                text-black
                                no-underline
                            "
                        >
                            <p>
                                <i class="fa-solid fa-location-dot"></i>
                                Mérida - Venezuela
                            </p>
                            <br>
                            <p>
                                <i class="fa-solid fa-phone"></i>
                                (+58) 274-2635666
                            </p>
                            <br>
                            <p>
                                <i class="fa-solid fa-envelope"></i>
                                quimiecologica.llcv@gmail.com
                            </p>
                        </div>
                    </div>

                    <div class="flex-1">
                        <ul class="list-reset mb-6">
                            <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                                <Link
                                    :href="route('about-us')"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-black
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "

                                >
                                    <b>Conócenos</b>
                                </Link>
                            </li>
                            <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                                <Link
                                    href="/brands"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-black
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "

                                >
                                    <b>Productos</b>
                                </Link>
                            </li>
                            <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                                <Link
                                    href="/services"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-black
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "

                                >
                                    <b>Servicios</b>
                                </Link>
                            </li>
                            <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                                <Link
                                    href="/pending-orders/create"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-black
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "

                                >
                                    <b>Servicios de formulación</b>
                                </Link>
                            </li>
                            <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                                <Link
                                    :href="route('posts.index')"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-black
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "
                                >
                                    <b>Blog</b>
                                </Link>
                            </li>
                            <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                                <Link
                                    :href="route('contact')"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-black
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

                    <div class="flex-1">
                        <ul class="list-reset mb-6">
                            <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                                <a
                                    href="https://www.instagram.com/basttvzla/"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-black
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
                            <br>
                            <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                                <a
                                    href="https://www.tiktok.com/@basttvzla"
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-black
                                        no-underline
                                        hover:text-gray-800
                                        hover:text-underline
                                    "
                                    target="__blank"
                                >
                                    <i class="fa-brands fa-tiktok"></i> @basttvzla
                                </a>
                            </li>
                            <br>
                            <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                                <a
                                    href="
                                        https://www.linkedin.com/company/laboratorio-quimiecologi-c-a-l%C3%ADnea-facial-bastt%C2%AE
                                    "
                                    class="
                                        font-montserrat
                                        inline-block
                                        text-black
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
                            text-black
                            no-underline
                        "
                    >
                        <ul class="list-reset mb-6">
                            <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                                <i class="fa-solid fa-clock"></i>
                                Horario Laboral
                                <br>
                                <br>
                                Lunes - Viernes 7:30am - 3:30pm
                            </li>
                            <br>
                            <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                                <i class="fa-solid fa-clock"></i>
                                Redes (Atención al cliente)
                                <br>
                                <br>
                                Lunes - Sábado 8:00am - 9:00pm
                                <br>
                                Domingo 10:00am – 3:00pm
                            </li>
                        </ul>
                    </div>
                </div>
                <p
                    class="
                        font-montserrat
                        text-center
                        font-bold
                        text-xl
                        px-6
                        hover:text-gray-800
                        hover:text-underline
                    "
                >
                    <Link :href="route('welcome')">QUIMIECOLOGI C.A.</Link>
                </p>
                <br>
            </div>
        </footer>
    </div>
    <!-- Final Footer -->
</template>