<script setup>
const LogoQblack = '/images/Logo-Q-black.png';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <!-- Footer -->
    <footer class="gradient border-b py-8">
        <div class="container mx-auto mt-8 px-8">
            <div class="w-full flex flex-col md:flex-row py-6">
                <div class="flex-1 mb-6">
                    <a href="/">
                        <img
                            :src="LogoQblack"
                            class="w-32 inline-block img-zoom"
                            alt="Quimiecologi C.A."
                        />
                    </a>
                </div>

                <div class="flex-1">
                    <p class="uppercase font-extrabold text-gray-800 md:mb-6">
                        Social
                    </p>
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
                                <b>Instagram</b>
                            </a>
                        </li>
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
                                <b>TikTok</b>
                            </a>
                        </li>
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
                                <b>Linkedin</b>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="flex-1">
                    <p class="uppercase font-extrabold text-gray-800 md:mb-6">
                        Interés
                    </p>
                    <ul class="list-reset mb-6">
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
                                <b>Contacto</b>
                            </Link>
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
                <Link :href="route('welcome')">Quimiecologi C.A.</Link>
            </p>
        </div>
    </footer>
    <!-- Final Footer -->
</template>