<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onBeforeMount, ref } from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

const isLoading = ref(false);
const fullPage = ref(true);
const imagePath = '/images/1.jpg';
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
      ></loading>

      <!-- Sección 1 -->
      <div class="container mx-auto flex flex-wrap pt-4 pb-5">
        <img :src="LogoQuimiecologi01" alt="Quimiecologi C.A." class="max-w-lg block mx-auto h-auto" />

        <div class="w-full mb-4">
          <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t">
          </div>
        </div>
        <div class="w-full font-bold text-xl text-gray-800 px-6 text-center">
          Fabricación de productos químicos
        </div>

        <p class="w-full text-gray-600 text-xs md:text-sm px-6 mt-6 mb-4 text-center">
          Línea Facial BASTT®
        </p>

        <img :src="imagePath" alt="" class="w-full h-auto mx-auto">

      </div>
      <!-- Final Sección 1 -->

      <!-- Sección Productos -->
      <section class="bg-white border-b py-12 ">
        <div class="container max-w-5xl mx-auto m-8">
          <h2 class="w-full my-2 text-5xl font-black leading-tight text-center text-gray-800">
            Productos
          </h2>
          <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
          </div>

          <div class="flex flex-wrap">
            <div class="w-5/6 sm:w-1/2 p-6">
              <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                Lorem ipsum dolor sit amet
              </h3>
              <p class="text-gray-600 mb-8">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                at ipsum eu nunc commodo posuere et sit amet ligula.
                <br />
                <br />

                Images from:
                <a class="text-orange-500 underline" href="https://undraw.co/">
                  undraw.co
                </a>
              </p>
            </div>
            <div class="w-full sm:w-1/2 p-6">
              <img :src="imagePath" alt="" class="w-full h-auto mx-auto">
            </div>
          </div>

          <div class="flex flex-wrap flex-col-reverse sm:flex-row">
            <div class="w-full sm:w-1/2 p-6 mt-6">
              <img :src="imagePath" alt="" class="w-full h-auto mx-auto">
            </div>
            <div class="w-full sm:w-1/2 p-6 mt-6">
              <div class="align-middle">
                <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                  Lorem ipsum dolor sit amet
                </h3>
                <p class="text-gray-600 mb-8">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                  at ipsum eu nunc commodo posuere et sit amet ligula.<br /><br />
                  Images from:
                  <a class="text-orange-500 underline" href="https://undraw.co/">undraw.co</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Final Sección Productos -->

      <!-- Sección Servicios -->
      <section class="bg-gray-100 border-b py-8">
        <div class="container max-w-5xl mx-auto m-8">
          <h2 class="w-full my-2 text-5xl font-black leading-tight text-center text-gray-800">
            Servicios
          </h2>
          <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
          </div>

          <div class="flex flex-wrap">
            <div class="w-5/6 sm:w-1/2 p-6">
              <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                Lorem ipsum dolor sit amet
              </h3>
              <p class="text-gray-600 mb-8">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                at ipsum eu nunc commodo posuere et sit amet ligula.<br /><br />

                Images from:
                <a class="text-orange-500 underline" href="https://undraw.co/">undraw.co</a>
              </p>
            </div>
            <div class="w-full sm:w-1/2 p-6">
              <img :src="imagePath" alt="" class="w-full h-auto mx-auto">
            </div>
          </div>

          <div class="flex flex-wrap flex-col-reverse sm:flex-row">
            <div class="w-full sm:w-1/2 p-6 mt-6">
              <img :src="imagePath" alt="" class="w-full h-auto mx-auto">
            </div>
            <div class="w-full sm:w-1/2 p-6 mt-6">
              <div class="align-middle">
                <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                  Lorem ipsum dolor sit amet
                </h3>
                <p class="text-gray-600 mb-8">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                  at ipsum eu nunc commodo posuere et sit amet ligula.<br /><br />
                  Images from:
                  <a class="text-orange-500 underline" href="https://undraw.co/">undraw.co</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Final Sección Servicios -->

      <!-- Sección FFF -->
      <section class="bg-white border-b py-8">
        <div class="container mx-auto flex flex-wrap pt-4 pb-12">
          <h2 class="w-full my-2 text-5xl font-black leading-tight text-center text-gray-800">
            FFF
          </h2>
          <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
          </div>

          <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
            <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
              <a href="#" class="flex flex-wrap no-underline hover:no-underline">
                <p class="w-full text-gray-600 text-xs md:text-sm px-6 mt-6">
                  GETTING STARTED
                </p>
                <div class="w-full font-bold text-xl text-gray-800 px-6">
                  Lorem ipsum dolor sit amet.
                </div>
                <p class="text-gray-600 text-base px-6 mb-5">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                  at ipsum eu nunc commodo posuere et sit amet ligula.
                </p>
              </a>
            </div>
            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
              <div class="flex items-center justify-start">
                <button
                  class="mx-auto lg:mx-0 hover:underline gradient2 text-gray-800 font-extrabold rounded my-6 py-4 px-8 shadow-lg">
                  Action
                </button>
              </div>
            </div>
          </div>

          <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
            <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
              <a href="#" class="flex flex-wrap no-underline hover:no-underline">
                <p class="w-full text-gray-600 text-xs md:text-sm px-6 mt-6">
                  GETTING STARTED
                </p>
                <div class="w-full font-bold text-xl text-gray-800 px-6">
                  Lorem ipsum dolor sit amet.
                </div>
                <p class="text-gray-600 text-base px-6 mb-5">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                  at ipsum eu nunc commodo posuere et sit amet ligula.
                </p>
              </a>
            </div>
            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
              <div class="flex items-center justify-center">
                <button
                  class="mx-auto lg:mx-0 hover:underline gradient2 text-gray-800 font-extrabold rounded my-6 py-4 px-8 shadow-lg">
                  Action
                </button>
              </div>
            </div>
          </div>

          <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
            <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
              <a href="#" class="flex flex-wrap no-underline hover:no-underline">
                <p class="w-full text-gray-600 text-xs md:text-sm px-6 mt-6">
                  GETTING STARTED
                </p>
                <div class="w-full font-bold text-xl text-gray-800 px-6">
                  Lorem ipsum dolor sit amet.
                </div>
                <p class=" text-gray-600 text-base px-6 mb-5">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                  at ipsum eu nunc commodo posuere et sit amet ligula.
                </p>
              </a>
            </div>
            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
              <div class="flex items-center justify-end">
                <button
                  class="mx-auto lg:mx-0 hover:underline gradient2 text-gray-800 font-extrabold rounded my-6 py-4 px-8 shadow-lg">
                  Action
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Final Sección FFF -->
    </template>
  </MainLayout>
</template>
