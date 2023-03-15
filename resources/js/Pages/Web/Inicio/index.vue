<template>
    <WebLayout>
        <main class="main">
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
import HeroSideComponent from "./components/HeroSideComponent.vue";
import ServicesCarouselComponent from "./components/ServicesCarouselComponent.vue";
import VehiculosSection from "./sections/VehiculosSection.vue";
import EligenosSection from "./sections/EligenosSection.vue";
import GaleriaSection from "./sections/GaleriaSection.vue";
</script>
<style lang="scss"></style>
