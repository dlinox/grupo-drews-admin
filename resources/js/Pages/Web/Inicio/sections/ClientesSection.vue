<template>
    <section class="section-clientes">
        <div class="container">
            <TituloSectionComponent
                titulo="Clientes"
                descripcion="uestros clientes"
            />

            <swiper
                :slides-per-view="1"
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
                    delay: 5000,
                    disableOnInteraction: true,
                }"
                :space-between="30"
            >
                <swiper-slide v-for="(item, index) in vehiculos" :key="index">
                    <img
                        width="100%"
                        src="https://grupo-dews-web.vercel.app/_nuxt/BEAR-CREEK.ef18592a.png"
                        alt=""
                    />
                </swiper-slide>
            </swiper>
        </div>
    </section>
</template>
<script setup></script>

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
                transition: all 0.5s ease-in;
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
