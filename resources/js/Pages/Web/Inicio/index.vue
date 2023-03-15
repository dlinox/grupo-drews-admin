<template>
    <Head>
        <title>Grupo Drews</title>
        <meta name="description" content="Alquiler de ahutos" />
    </Head>
    <WebLayout>
        <main class="page-inicio main">
            <HeroSideComponent />
            <ServicesCarouselComponent />
            <VehiculosSection />
            <EligenosSection />
            <GaleriaSection />
        </main>
    </WebLayout>
</template>
<script setup>
import WebLayout from "@/Layouts/WebLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";


import HeroSideComponent from "./components/HeroSideComponent.vue";
import ServicesCarouselComponent from "./components/ServicesCarouselComponent.vue";
import VehiculosSection from "./sections/VehiculosSection.vue";
import EligenosSection from "./sections/EligenosSection.vue";
import GaleriaSection from "./sections/GaleriaSection.vue";



</script>
<style lang="scss">
.page-inicio {
    background-color: rgb(250, 250, 250);
}
</style>
