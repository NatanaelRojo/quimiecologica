<script setup>
const LogoQblack = '/images/Logo-Q-black.png';
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
                            class="w-32 inline-block"
                            alt="Quimiecologi C.A."
                        />
                    </a>
                </div>

                <div class="flex-1">
                    <p class="uppercase font-extrabold text-gray-500 md:mb-6">Social</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="
                                    inline-block
                                    text-black
                                    no-underline
                                    hover:text-gray-800
                                    hover:text-underline
                                "
                                target="__blank"
                            >
                                Instagram
                            </a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="
                                    inline-block
                                    text-black
                                    no-underline
                                    hover:text-gray-800
                                    hover:text-underline
                                "
                                target="__blank"
                            >
                                Facebook
                            </a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="
                                    inline-block
                                    text-black
                                    no-underline
                                    hover:text-gray-800
                                    hover:text-underline
                                "
                                target="__blank"
                            >
                                Linkedin
                            </a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="
                                    inline-block
                                    text-black
                                    no-underline
                                    hover:text-gray-800
                                    hover:text-underline
                                "
                                target="__blank"
                            >
                                Twitter
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="flex-1">
                    <p class="uppercase font-extrabold text-gray-500 md:mb-6">Interés</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="{{ route('contact') }}"
                                @click.prevent="$inertia.visit(route('contact'))"
                                class="
                                    inline-block
                                    text-black
                                    no-underline
                                    hover:text-gray-800
                                    hover:text-underline
                                "
                                target="__blank"
                            >
                                Blog
                            </a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="{{ route('about-us') }}"
                                @click.prevent="$inertia.visit(route('about-us'))"
                                class="
                                    inline-block
                                    text-black
                                    no-underline
                                    hover:text-gray-800
                                    hover:text-underline
                                "
                                target="__blank"
                            >
                                Acerca de nosotros
                            </a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="{{ route('contact') }}"
                                class="
                                    inline-block
                                    text-black
                                    no-underline
                                    hover:text-gray-800
                                    hover:text-underline
                                "
                                target="__blank"
                                @click.prevent="$inertia.visit(route('contact'))"
                            >
                                Contacto
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <p class="text-center text-gray-800">Quimiecologi C.A.</p>
        </div>
    </footer>
    <!-- Final Footer -->
</template>