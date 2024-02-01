<template>
    <div class="container mx-auto" role="alert">
        <button data-dismiss="alert" aria-label="Cerrar" @click.prevent="handleClearErrorsClick"
            class="!absolute  top-3 right-3 h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-white transition-all hover:bg-white/10 active:bg-white/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            type="button">
            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </span>
        </button>
        <ul>
            <li
                class="
                    relative block w-full p-4 mb-4 text-base leading-5
                    text-white bg-red-500 rounded-lg opacity-100 font-regular
                "
                v-for="(error, index) in errors"
                key="index"
            >
                {{ error }}
            </li>
        </ul>
    </div>
</template>

<script setup>
const props = defineProps({
    errors: { type: Array, required: true },
});
const emit = defineEmits(['clearErrors']);

const handleClearErrorsClick = () => {
    emit('clearErrors');
}
</script>