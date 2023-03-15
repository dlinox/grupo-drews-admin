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
                :space-between="10"
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

const vehiculos = [
    {
        id: 1,
        detalle: "Automovil 1",
        marca: "Toyota",
        modelo: "elantra",
        categoria: "Camioneta",
        tipo: null,
        combustible: "86",
        cilindrada: null,
        puertas: 1,
        capacidad: 3,
        aire_acondicionado: 1,
        equipaje: 1,
        imagenes: [
            "http://grupo-drews.test/uploads/productos/1678761446-img-1.jpg",
            "http://grupo-drews.test/uploads/productos/1678761446-img-2.jpg",
        ],
        contenido: null,
        precio: 0,
        precio_oferta: "0",
        disponible: "D",
        descripcion: "Descripcion Automovil 1",
        estado: 1,
        created_at: "2023-03-14T02:37:26.000000Z",
        updated_at: "2023-03-14T02:37:26.000000Z",
    },
];
</script>
<style lang="scss">
.vehiculos-section {
    background-color: rgb(250, 250, 250);
    padding-bottom: 3em;
}
</style>
