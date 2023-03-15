<template>
    <section class="vehiculos-section">
        <div v-if="vehiculos" class="container">
            <TituloSectionComponent
                titulo="Vehiculos"
                descripcion="Una flota que se adapta a tus necesidades"
            />

            <swiper
                :slides-per-view="1"
                :breakpoints="{
                    992: {
                        slidesPerView: 3,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                }"
                :autoplay="{
                    delay: 5000,
                    disableOnInteraction: true,
                }"
                :space-between="30"
            >
                <swiper-slide v-for="(item, index) in vehiculos" :key="index">
                    <CardVehiculoComponent :item="item" />
                </swiper-slide>
            </swiper>
        </div>
    </section>
</template>
<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import CardVehiculoComponent from "@/Components/Web/CardVehiculoComponent.vue";
import TituloSectionComponent from "@/Components/Web/TituloSectionComponent.vue";

const props = defineProps({
    vehiculos: Array
});



</script>
<style lang="scss">
.vehiculos-section {
    background-color: rgb(250, 250, 250);
    padding-bottom: 3em;
}
</style>
