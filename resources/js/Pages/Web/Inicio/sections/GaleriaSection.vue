<template>
    <section class="inicio-galeria">
        <swiper
            :slides-per-view="1"
            :loop="false"
            :breakpoints="{
                1400: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 2,
                },
            }"
            :autoplay="{
                delay: 5000,
                disableOnInteraction: true,
            }"
            :space-between="0"
        >
            <swiper-slide v-for="(item, index) in galeria.flat()" :key="index">
                <div class="img-wrapper">
                    <img :src="item" alt="" />
                    <div class="detalle">
                        <div class="content text-center">
                            <span class="text-center">Toyota Hlux </span>

                            <button class="btn-view-img">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </swiper-slide>
        </swiper>
    </section>
</template>
<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";

const props = defineProps({
    vehiculos: Array,
});

const galeria = props.vehiculos.map((item) => item.imagenes);
//const galeria2 = Array.flat(galeria);
</script>

<style lang="scss">
.inicio-galeria {
    font-family: $font-raj;
    .img-wrapper {
        width: 100%;
        height: 350px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
        .detalle {
            position: absolute;
            background-color: rgba($color: $app-color1, $alpha: 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            scale: 0;
            transition: all 0.3s ease-in;

            .content {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                span {
                    width: 100%;
                    font-size: 1.5rem;
                    margin-bottom: 1rem;
                    color: white;
                    font-weight: 700;
                }
                button.btn-view-img {
                    border: none;
                    background-color: white;
                    padding: 0.5rem 0.8rem;
                    color: black;
                }
            }
        }
        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: all 0.5s ease-in;
        }

        &:hover {
            .detalle {
                scale: 1;
            }
            img {
                scale: 1.3;
            }
        }
    }
}
</style>
