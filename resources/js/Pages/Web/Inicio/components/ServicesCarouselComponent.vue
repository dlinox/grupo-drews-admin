<template>
    <section class="inicio-servicios" v-if="servicios">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="border-0 bg-white shadow my-0 my-lg-3 p-3 rounded-3">
                        <div class="card-body  p-3">
                            <div class="card-title text-color1">
                                <h1>GRUPO DREWS</h1>
                            </div>
                            <div class="card-subtitle text-secondary">
                                <p class="mb-0">
                                    Grupo Drews forma parte de un grupo
                                    empresarial conformado por Servicios
                                    Múltiples Drews S.A.C. - (Drews Rent A Car),
                                    Servicios Generales Drews Perú S.A.C.,
                                    Esbril S.A.C., Intermotors S.A.C. y Tamawi
                                    S.A.C. con amplia experiencia en el sector
                                    Automotriz
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7 slide-services">
                    <swiper
                        @swiper="onSwiper"
                        :slides-per-view="1"
                        :space-between="10"
                        :breakpoints="{
                    
                            500: {
                                slidesPerView: 2,
                            },
                        }"
                    >
                        <swiper-slide
                            v-for="(item, index) in servicios"
                            :key="index"
                        >
                            <CardSmallServiceComponent :item="item" />
                        </swiper-slide>
                    </swiper>

                    <div class="slider-actions">
                        <div class="view-all">
                            <Link href="/servicios"> Ver todo </Link>
                        </div>
                        <div class="navigation-buttons">
                            <button
                                class="btn btn-sm btn-outline-dark rounded-0"
                                @click="swiperServices.slidePrev()"
                            >
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>

                            <button
                                class="btn btn-sm btn-outline-dark rounded-0"
                                @click="swiperServices.slideNext()"
                            >
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import { Swiper, SwiperSlide } from "swiper/vue";
import { ref } from "vue";
import CardSmallServiceComponent from "./CardSmallServiceComponent.vue";

const props = defineProps({
    servicios: Array,
});

const swiperServices = ref(null);

const onSwiper = (swiper) => {
    swiperServices.value = swiper;
};
</script>

<style lang="scss">
.inicio-servicios {
    background-color: transparent;
    position: relative;
    z-index: 3;
    margin-top: -100px;
    overflow: hidden;

    .swiper-wrapper {
        display: flex;
        height: 100%;

        .swiper-slide {
            bottom: 0;
            height: 100%;
        }
    }

    h1 {
        font-family: $font-teko;
        font-weight: 800;
    }
    p {
        font-family: $font-raj;
        font-size: 1.2rem;
    }

    .slide-services {
        .slider-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1.5rem;
            .view-all {
                font-family: $font-raj;
                font-weight: 700;
                text-decoration: underline;
                &:hover {
                    a {
                        color: $app-color1;
                    }
                }
            }
        }
    }
}

@media (max-width: 992px) {
    .inicio-servicios {
        margin-top: -50px;
        .container {
            .card {
                border-radius: 0.5em;
            }
        }
    }
}

@media (max-width: 768px) {
    .inicio-servicios {
        margin-top: 0px;
        width: 100%;
        .container {
            max-width: 100%;
            padding: 0;
            .card {
                border-radius: 0;
            }
        }
    }
}
</style>
