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



// import { createGlobalState, useStorage } from "@vueuse/core";

// const props = defineProps({
//     servicios: Array,
//     vehiculos: Array,
//     clientes: Array,
//     sliders: Array,
// });

// const useState = createGlobalState(() => {
//     useStorage("vehiculos-locale-storage", props.vehiculos);
//     useStorage("servicios-locale-storage", props.servicios);
// });
// const state = useState();
</script>
