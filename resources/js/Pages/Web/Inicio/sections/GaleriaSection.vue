<template>
    <section class="inicio-galeria">
        <swiper
            :slides-per-view="1"
            :loop="false"
            :space-between="0"
            :breakpoints="{
                1400: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 2,
                },
            }"
        >
            <swiper-slide v-for="(item, index) in galeria.flat()" :key="index">
                <div class="img-wrapper">
                    <img :src="item" alt="" />
                    <div class="detalle">
                        <div class="content text-center">
                            <span class="text-center">Toyota Hlux </span>

                            <button
                                class="btn-view-img"
                                @click="
                                    (initial = index),
                                        (showGalery = !showGalery)
                                "
                            >
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </swiper-slide>
        </swiper>

        <transition name="fade">
            <div v-if="showGalery" class="modal-gallery">
                <div class="overlay" @click="showGalery = !showGalery"></div>
                <div class="modal-content">
                    <div class="wrapper-swiper">
                        <swiper
                            @swiper="onSwiper"
                            :initial-slide="initial"
                            :space-between="0"
                            :loop="true"
                        >
                            <swiper-slide
                                v-for="(item, index) in galeria.flat()"
                                :key="index"
                            >
                                <div class="img-gallery">
                                    <img :src="item" alt="" />
                                </div>
                            </swiper-slide>
                        </swiper>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="footer-action">
                        <button
                            class="btn btn-dark rounded-0"
                            @click="showGalery = false"
                        >
                            <i class="fa-solid fa-xmark"></i>
                        </button>

                        <button
                            class="btn btn-dark rounded-0"
                            @click="swiperGallery.slidePrev()"
                        >
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>

                        <button
                            class="btn btn-dark rounded-0"
                            @click="swiperGallery.slideNext()"
                        >
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </section>
</template>
<script setup>
import { ref } from "vue";
import { Swiper, SwiperSlide, useSwiper } from "swiper/vue";

const props = defineProps({
    vehiculos: Array,
});

const galeria = props.vehiculos.map((item) => item.imagenes);

const initial = ref(null);

const showGalery = ref(false);

const swiperGallery = ref(null);

const onSwiper = (swiper) => {
    swiperGallery.value = swiper;
};

//const galeria2 = Array.flat(galeria);
</script>

<style lang="scss">
.fade-enter-active,
.fade-leave-active {
    opacity: 1;
    transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.modal-gallery {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    .overlay {
        background-color: rgba($color: #000000, $alpha: 0.5);
        backdrop-filter: blur(15px);
        width: 100%;
        height: 100%;
    }
    .modal-content {
        position: absolute;
        width: 700px;
        max-width: 100%;
        padding: 2rem;
        .wrapper-swiper {
            .img-gallery {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 500px;
                max-height: 80vh;
                overflow: hidden;
                img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                    object-position: center;
                }
            }
        }
    }
    .modal-footer {
        position: absolute;
        bottom: 0;
        right: 0;
    }
}
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
