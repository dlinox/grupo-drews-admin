<template>
    <HeaderComponent />

    <main>
        <slot></slot>
    </main>

    <BannerCotizarSection />
    <FooterComponent />
</template>
<script setup>
import HeaderComponent from "@/Components/Web/HeaderComponent.vue";
import FooterComponent from "@/Components/Web/FooterComponent.vue";
import BannerCotizarSection from "../Pages/Web/Inicio/sections/BannerCotizarSection.vue";


</script>
