<template>
    <Head>
        <title>Grupo Drews</title>
        <meta name="description" content="Alquiler de ahutos" />
    </Head>
    <WebLayout>
        <main class="page-inicio main">
            <HeroSideComponent :sliders="sliders" />
            <ServicesCarouselComponent :servicios="servicios" />
            <VehiculosSection :vehiculos="vehiculos" />
            <EligenosSection />
            <GaleriaSection :vehiculos="vehiculos" />
            <ClientesSection :clientes="clientes" />
    
        </main>
    </WebLayout>
</template>
<script setup>
import WebLayout from "@/Layouts/WebLayout.vue";
import { Head } from "@inertiajs/vue3";

import HeroSideComponent from "./components/HeroSideComponent.vue";
import ServicesCarouselComponent from "./components/ServicesCarouselComponent.vue";
import VehiculosSection from "./sections/VehiculosSection.vue";
import EligenosSection from "./sections/EligenosSection.vue";
import GaleriaSection from "./sections/GaleriaSection.vue";
import ClientesSection from "./sections/ClientesSection.vue";
import { onUnmounted } from "vue";

const props = defineProps({
    servicios: Array,
    vehiculos: Array,
    clientes: Array,
    sliders: Array,
});

onUnmounted(()=>{

})
</script>
<style lang="scss">
.page-inicio {
    background-color: rgb(250, 250, 250);
}
</style>
