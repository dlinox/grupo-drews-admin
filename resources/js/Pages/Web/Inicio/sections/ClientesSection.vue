<template>
    <section class="section-clientes">
        <div class="container">
            <TituloSectionComponent
                titulo="Clientes"
                descripcion="Nuestros clientes"
            />

            <swiper
                :modules="[Autoplay, Pagination]"
                class="section-clientes"
                :slides-per-view="2"
                :loop="true"
                :pagination="true"
                :breakpoints="{
                    1400: {
                        slidesPerView: 8,
                    },
                    1200: {
                        slidesPerView: 6,
                    },
                    768: {
                        slidesPerView: 5,
                    },
                    576: {
                        slidesPerView: 4,
                    },
                }"
                :autoplay="{
                    delay: 3000,
                    disableOnInteraction: true,
                }"
                :space-between="30"
            >
                <swiper-slide
                    v-for="(item, index) in clientes"
                    :key="index"
                    class="clientes-slide"
                >
                    <div class="card-item">
                        <img :src="item.logo" alt="" />
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
</script>

<style lang="scss">
.section-clientes {
    background-color: #fefefe;
    background-image: radial-gradient(#0a880a2b 1px, transparent 1px);
    background-size: 10px 10px;
    padding: 50px 0px;
    .clientes-slide {
        .card-item {
            border: none;
            background-color: transparent;
            img {
                width: 100%;
                filter: grayscale(100%);
                transition: all 0.3s ease-in;
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
