<template>
    <div>
        <p>Seleccione un método de pago:</p>
        <select v-model="selectedPaymentType" @change="getPaymentMethods(selectedPaymentType)">
            <option v-for="(type, index) in paymentTypes" :key="index">
                {{ type.name }}
            </option>
        </select>
        <br>
        <div v-if="selectedPaymentType && paymentMethods.length > 0">
            <p>Seleccione un método de pago:</p>
            <select v-model="selectedPaymentMethod" @change="getPaymentMethodData(selectedPaymentMethod)">
                <option v-for="(method, index) in paymentMethods" :key="index">
                    {{ method.name }}
                </option>
            </select>
            <br>
        </div>
        <div v-if="selectedPaymentMethod && paymentMethodData">
            <h2>Datos de pago</h2>
            <template v-for="(value, key) in paymentMethodData" :key="key">
                <p><b>{{ key }}:</b> {{ value }}</p>
            </template>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';

const paymentTypes = ref([]);
const paymentMethods = ref([]);
const paymentMethodData = ref({});
const selectedPaymentType = ref('');
const selectedPaymentMethod = ref('');

onMounted(async () => {
    try {
        const response = await axios.get('/api/payment-types');
        paymentTypes.value = response.data.records;
    } catch (error) {
        console.error(error);
    }
});

const getPaymentMethods = (paymentTypeName) => {
    const paymentType = paymentTypes.value.find(paymentType => paymentType.name === selectedPaymentType.value);
    paymentMethods.value = paymentType.payment_methods;

    return paymentType.payment_methods;
}

const getPaymentMethodData = (paymentMethodName) => {
    const paymentMethod = paymentMethods.value.find(paymentMethod => paymentMethod.name === paymentMethodName);
    paymentMethodData.value = paymentMethod.data;

    return paymentMethod.data;
}
</script>