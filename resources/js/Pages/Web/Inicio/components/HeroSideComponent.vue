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
            background: rgb(12, 127, 64);
            background: linear-gradient(
                54deg,
                rgba(12, 127, 64, 1) 0%,
                rgba(4, 183, 190, 0.2) 59%,
                rgba(0, 212, 255, 0.1) 100%
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
</style>
