<template>
    <section class="hero-side">
        <swiper
            :modules="[Autoplay, EffectCube]"
            :slides-per-view="1"
            :loop="true"
            :autoplay="{
                delay: 3000,
                disableOnInteraction: true,
            }"
            :space-between="0"
        >
            <swiper-slide
                v-for="(item, index) in sliders"
                :key="index"
                class="side-wrapper"
            >
                <img class="imagen" :src="item.src" alt="" />

                <!-- <video
                class="video"
                muted
                autoplay
                loop
                poster="@/assets/static/img/preview_vide.png"
            >
                <source
                    src="@/assets/static/video/main-video.mp4"
                    type="video/mp4"
                />
                Your browser does not support the video tag.
            </video> -->

                <div class="slide-content">
                    <div class="container">
                        <span class="slide-title">
                            {{ item.titulo }}
                        </span>
                        <span class="slide-subtitle">
                            {{ item.sub_titulo }}
                        </span>
                    </div>
                </div>
            </swiper-slide>
        </swiper>
    </section>
</template>
<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, EffectCube } from "swiper";
const props = defineProps({
    sliders: Array,
});
</script>
<style lang="scss">
.hero-side {
    position: relative;

    .side-wrapper {
        width: 100%;
        //height: 600px;
        aspect-ratio: 21 / 9;
        overflow: hidden;
        position: relative;

        video.video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        img.imagen {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        .slide-content {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgb(192, 248, 216);
            background: linear-gradient(
                54deg,
                rgba(12, 12, 12, 0.5) 0%,
                rgba(73, 77, 77, 0.2) 59%,
                rgba(154, 157, 157, 0.1) 100%
            );
            .container {
                .slide-title {
                    color: white;
                    display: block;
                    font-size: 3.5rem;
                    font-family: $font-teko;
                    font-weight: 800;
                }
                .slide-subtitle {
                    color: #eee;
                    display: block;
                    font-size: 2rem;
                    font-family: $font-teko;
                    letter-spacing: 1.5px;
                }
            }
        }
    }
}

@media (max-width: 992px) {
    .hero-side {
        .side-wrapper {
            aspect-ratio: 19 / 9;
            .slide-content {
                .container {
                    .slide-title {
                        font-size: 2rem;
                    }
                    .slide-subtitle {
                        font-size: 1.5rem;

                        letter-spacing: 1.3px;
                    }
                }
            }
        }
    }
}

@media (max-width: 768px) {
    .hero-side {
        .side-wrapper {
            aspect-ratio: 19 / 9;
            .slide-content {
                .container {
                    .slide-title {
                        font-size: 1.5rem;
                    }
                    .slide-subtitle {
                        font-size: 1rem;

                        letter-spacing: 1px;
                    }
                }
            }
        }
    }
}
</style>
