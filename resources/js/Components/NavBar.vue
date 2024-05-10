<script setup>
import { Link } from '@inertiajs/vue3';
const LogoQuimiecologi01 = '/images/Logo-Quimiecologi-01.png';
</script>

<template>
    <nav class="fixed top-0 z-50 w-full gradient-green border-b border-gray-200 light:bg-gray-800 light:border-gray-700">
          <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
              <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 light:text-gray-400 light:hover:bg-gray-700 light:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                       <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                 </button>
                <a :href="route('welcome')" class="flex ms-2 md:me-24">
                    <img
                        :src="LogoQuimiecologi01"
                        class="w-40 inline-block img-zoom"
                        alt="Quimiecologi C.A."
                    />
                </a>
              </div>
              <div class="flex items-center">
                  <div class="flex items-center ms-3">
                    <span
                        class="
                            font-montserrat
                            font-bold
                        "
                    >
                        Diseño y desarrollo científico de alto nivel
                    </span>
                  </div>
                </div>
            </div>
          </div>
        </nav>

        <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full gradient border-r border-gray-200 sm:translate-x-0 light:bg-gray-800 light:border-gray-700" aria-label="Sidebar">
           <div class="h-full px-3 pb-4 overflow-y-auto gradient light:bg-gray-800">
              <ul class="space-y-2 font-medium">
                 <li>
                    <Link
                        :href="route('welcome')"
                        class="
                            font-montserrat
                            inline-block
                            no-underline
                            hover:text-gray-800
                            hover:text-underline
                            py-2
                            px-2
                            flex
                            items-center
                            p-2
                            rounded-lg
                            light:text-white
                            hover:bg-gray-100
                            light:hover:bg-gray-700
                            group
                        "
                        style="color: #82675C;"
                    >
                        <span class="ms-3">
                            <b>
                                INICIO
                            </b>
                        </span>
                    </Link>
                 </li>
                 <li>
                    <Link
                        :href="route('about-us')"
                        class="
                            font-montserrat
                            font-bold
                            inline-block
                            no-underline
                            hover:text-gray-800
                            hover:text-underline
                            py-2
                            px-2
                            flex
                            items-center
                            p-2
                            rounded-lg
                            light:text-white
                            hover:bg-gray-100
                            light:hover:bg-gray-700
                            group
                        "
                        style="color: #82675C;"
                    >
                        <span class="ms-3">CONÓCENOS</span>
                    </Link>
                 </li>
                 <li>
                    <Link
                        :href="route('products')"
                        class="
                            font-montserrat
                            font-bold
                            inline-block
                            no-underline
                            hover:text-gray-800
                            hover:text-underline
                            py-2
                            px-2
                            flex
                            items-center
                            p-2
                            rounded-lg
                            light:text-white
                            hover:bg-gray-100
                            light:hover:bg-gray-700
                            group
                        "
                        style="color: #82675C;"
                    >
                        <span class="ms-3">PRODUCTOS</span>
                    </Link>
                 </li>
                 <li>
                    <Link
                        :href="route('services')"
                        class="
                            font-montserrat
                            font-bold
                            inline-block
                            no-underline
                            hover:text-gray-800
                            hover:text-underline
                            py-2
                            px-2
                            flex
                            items-center
                            p-2
                            rounded-lg
                            light:text-white
                            hover:bg-gray-100
                            light:hover:bg-gray-700
                            group
                        "
                        style="color: #82675C;"
                    >
                        <span class="ms-3">SERVICIOS</span>
                    </Link>
                 </li>
                 <li>
                    <Link
                        :href="route('posts.index')"
                        class="
                            font-montserrat
                            font-bold
                            inline-block
                            no-underline
                            hover:text-gray-800
                            hover:text-underline
                            py-2
                            px-2
                            flex
                            items-center
                            p-2
                            rounded-lg
                            light:text-white
                            hover:bg-gray-100
                            light:hover:bg-gray-700
                            group
                        "
                        style="color: #82675C;"
                    >
                        <span class="ms-3">BLOG</span>
                    </Link>
                 </li>
                 <li>
                    <Link
                        :href="route('contact')"
                        class="
                            font-montserrat
                            font-bold
                            inline-block
                            no-underline
                            hover:text-gray-800
                            hover:text-underline
                            py-2
                            px-2
                            flex
                            items-center
                            p-2
                            rounded-lg
                            light:text-white
                            hover:bg-gray-100
                            light:hover:bg-gray-700
                            group
                        "
                        style="color: #82675C;"
                    >
                        <span class="ms-3">CONTÁCTANOS</span>
                    </Link>
                 </li>
              </ul>
           </div>
        </aside>
</template>
