<template>
    <Head>
        <title>Nosotros | Grupo Drews</title>
        <meta name="description" content="Más sobre Grupo Drews" />
    </Head>

    <WebLayout>
        <HeadingPageComponent titulo="Nosotros" />
        <main class="page-nosotros py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-12">
                        <TituloSectionComponent
                            titulo="GRUPO DREWS"
                            descripcion=" ALQUILER DE CAMIONETAS 4X4 PARA PROYECTOS DE MINERÍA, ENERGÍA Y CONSTRUCCIÓN "
                        />
                        <div class="descripcion-nosotros">
                            <p class="text-justify">
                                Grupo Drews forma parte de un grupo empresarial
                                conformado por
                                <b>
                                    Drews Rent A Car, Agara Logis tic, Esbril,
                                    Gairs, A&E Vital y Runner Track,</b
                                >
                                con amplia experiencia en el sector Automotriz.
                            </p>
                            <p class="text-justify">
                                Somos un grupo empresarial con más de 17 años de
                                experiencia en la Región Sur del Perú con el
                                objetivo de brindar servicios de transporte de
                                movilidad, transporte de personal, servicio de
                                taller mecánico, auxilio mecánico, venta de
                                repuestos, asesoría y venta de seguros,
                                monitoreo de gps.
                            </p>
                            <p class="text-justify">
                                <b>Drews Rent A Car</b>, inicia sus labores en la
                                región puno en el año 2007, con el objetivo de
                                brindar servicio de camionetas pick up 4x4, en
                                los diferentes sectores y actividades de
                                desarrollo en la región, centrándonos con mayor
                                interés en los sectores de minería,
                                exploraciones, energía, construcción,
                                ingeniería, etc.
                            </p>
                        </div>

                        <div class="mision-wrapper">
                            <h3 class="title">Misión</h3>
                            <div class="content" v-html="web.mision"></div>
                        </div>

                        <div class="vision-wrapper">
                            <h3 class="title">Visión</h3>
                            <div class="content" v-html="web.vision"></div>
                        </div>

                        <div class="valores-wrapper">
                            <h3 class="title">VALORES CORPORATIVOS</h3>

                            <div class="row">
                                <div class="col-6">
                                    <ul>
                                        <li>SEGURIDAD</li>
                                        <li>CONFIANZA</li>
                                        <li>COMPROMISO</li>
                                        <li>RESPETO</li>
                                        <li>RESPONSABILIDAD</li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul>
                                        <li>ASEQUIBILIDAD</li>
                                        <li>ORIENTACION AL CLIENTE</li>
                                        <li>SOSTENIBILIDAD</li>
                                        <li>TRABAJO EN EQU IPO</li>
                                        <li>EFICIENCIA</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-12">
                        <div class="w-100 text-end anios-experiencia mt-5">
                            <span>17 +</span>
                            <small>Experiencia</small>
                        </div>
                        <div class="img-wrapper">
                            <img
                                class="rounded-4"
                                width="100%"
                                src="/assets/image/nosotros.jpeg"
                                alt=""
                            />
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </WebLayout>
</template>

<script setup>
import WebLayout from "@/Layouts/WebLayout.vue";
import HeadingPageComponent from "../../../Components/Web/HeadingPageComponent.vue";
import TituloSectionComponent from "../../../Components/Web/TituloSectionComponent.vue";

import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const web = computed(() => usePage().props.web_data);
</script>
<style lang="scss">
.page-nosotros {
    .descripcion-nosotros {
        font-family: $font-raj;
        text-align: justify;
    }
    .text-end {
        span {
            font-family: $font-teko;
            font-size: 4.5rem;
            color: $app-color1;
            display: block;
            line-height: 5rem;
        }
        small {
            font-family: $font-teko;
            font-size: 1.5rem;
            color: $app-color1;
            display: block;
        }
    }

    img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
    }
    .vision-wrapper,
    .mision-wrapper {
        margin-top: 3rem;
        h3.title {
            line-height: 2rem;
            margin-bottom: 1rem;
            border-left: 5px $app-color1 solid;
            font-family: $font-teko;
            padding-left: 0.5rem;
            color: $app-color1;
        }
        .content {
            font-family: $font-raj;
            text-align: justify;
        }
    }
    .valores-wrapper {
        margin-top: 3rem;
        h3.title {
            line-height: 2rem;
            margin-bottom: 1rem;
            border-left: 5px $app-color1 solid;
            font-family: $font-teko;
            padding-left: 0.5rem;
            color: $app-color1;
        }
        ul {
            list-style: circle;
            margin-left: 1rem;
            li {
                font-family: $font-raj;
                font-weight: 500;
            }
        }
    }
}
</style>
