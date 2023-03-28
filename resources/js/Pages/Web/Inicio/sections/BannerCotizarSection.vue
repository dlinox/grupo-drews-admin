<template>
    <section class="section-banner-cotizar">
        <div class="polygon">
            <div class="container">
                <div class="left">
                    <strong class="text1"> ¿NECESITAS AYUDA? </strong>
                    <span class="text2">
                        Estamos Siempre Listos Para Ayudarte
                    </span>
                </div>
                <div class="right">
                    <a
                        class="btn btn-color1"
                        :href="
                            'https://api.whatsapp.com/send?phone=051' +
                            web.whatsapp
                        "
                        target="_blank"
                    >
                        <i class="fa-brands fa-whatsapp"></i> Escribenos
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import {  usePage } from "@inertiajs/vue3";
import { computed } from "vue";
const web = computed(() => usePage().props.web_data);
</script>

<style lang="scss">
.section-banner-cotizar {
    background-image: url(/assets/image/bg/bg-banner-help2.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-color: #eee;
    background-position: center;
    .polygon {
        color: white;
        padding: 40px 0px;
        position: relative;
        z-index: 1;

        &::after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            clip-path: polygon(0 0, 70% 0, 50% 100%, 0 100%);
            background-color: rgba($app-color1, 0.9);
        }

        .container {
            position: relative;
            z-index: 2;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            strong.text1 {
                display: block;
                font-size: 2rem;
                width: 100%;
                font-family: $font-teko;
            }
            span.text2 {
                display: block;
                font-family: $font-raj;
                font-size: 1.1rem;
            }
        }
    }
}

@media (max-width: 768px) {
    .section-banner-cotizar {
        .polygon {
            padding: 20px 0px;
            &::after {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            }

            .container {
                .left {
                    width: 100%;
                    margin-bottom: 20px;
                }
            }
        }
    }
}
</style>
