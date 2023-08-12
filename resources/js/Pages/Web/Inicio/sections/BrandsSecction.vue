<template>
    <section class="section-marcas">
        <div class="container">
            <TituloSectionComponent
                titulo="Marcas"
                descripcion="Marcas con las que trabajamos"
            />

            <swiper
            class="px-5"
                :modules="[Autoplay, Pagination]"
                :slides-per-view="2"
                :loop="true"
                :breakpoints="{
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 150,
                    },
                    576: {
                        slidesPerView: 2,
                        spaceBetween: 150,
                    },
                }"
                :autoplay="{
                    delay: 3000,
                    disableOnInteraction: true,
                }"
            >
                <swiper-slide
                    v-for="(item, index) in items"
                    :key="index"
                    class="clientes-slide"
                >
                    <div class="card-item">
                        <img :src="item" alt="" />
                    </div>
                </swiper-slide>
            </swiper>
        </div>
    </section>
</template>
<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, Pagination } from "swiper";
import TituloSectionComponent from "@/Components/Web/TituloSectionComponent.vue";

const props = defineProps({
    clientes: Array,
});

const items = [
    "/assets/image/brands/hyundai.webp",
    "/assets/image/brands/renault.webp",
    "/assets/image/brands/toyota.webp",
    "/assets/image/brands/volkswagen.webp",
];
</script>

<style lang="scss">
.section-marcas {
    background-color: #fff;
    background-size: 10px 10px;
    padding: 50px 0px;
    .clientes-slide {
        margin: auto;
        .card-item {
            border: none;
            background-color: transparent;
            img {
                width: 100%;
                filter: grayscale(100%);
                transition: all 0.3s ease-in;
                max-width: 120px;
            }
            &:hover {
                img {
                    filter: grayscale(0%);
                }
            }
        }
    }
}
</style>
