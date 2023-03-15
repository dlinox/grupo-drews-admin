<template>
    <WebLayout>
        <HeadingPageComponent titulo="Servicios Detalle" />
        <main class="detalle-servicio py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 left">
                        <span class="servicio-titulo text-color1">
                            {{ servicio.titulo }}
                        </span>
                        <p class="servicio-descripcion">
                            {{ servicio.descripcion }}
                        </p>
                        <div class="servicio-detalles">
                            <div
                                v-for="(val, index) in servicio?.detalles"
                                class="item-detalle"
                            >
                                <div class="detalle-index">{{ index + 1 }}</div>
                                <div class="detalle-contenido">
                                    <span class="detalle-titulo">
                                        {{ val.titulo }}
                                    </span>
                                    <p class="detalle-descripcion">
                                        {{ val.descripcion }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="my-4">

                          <button class="btn btn-dark me-3"> Solititar</button>
                          <button class="btn btn-color1"> WhatsApp </button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 right">
                        <div class="images-group">
                            <div
                                v-for="(val, index) in servicio?.imagenes"
                                :key="index"
                                class="image shadow-sm rounded-3"
                            >
                                <img :src="val" alt="" />
                            </div>
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

const props = defineProps({
    servicio: Object,
});
</script>
<style lang="scss">
.detalle-servicio {
    .left {
        .servicio-titulo {
            font-size: 1rem;
            font-weight: 700;
        }
        .servicio-descripcion {
            font-weight: 600;
            font-size: 1.5rem;
            line-height: 2.5rem;
            color: #444;
        }
        .servicio-detalles {
            .item-detalle {
                display: flex;
                margin-top: 20px;
                .detalle-index {
                    margin-right: 20px;
                    font-weight: 800;
                    color: transparent;
                    font-size: 5rem;
                    line-height: 5.1rem;
                    text-transform: capitalize;
                    -webkit-text-stroke-width: 1px;
                    -webkit-text-stroke-color: rgba(0, 0, 0, 0.15);
                }
                .detalle-contenido {
                    width: auto;
                    .detalle-titulo {
                        font-size: 1.4rem;
                        font-weight: 600;
                    }
                    .detalle-descripcion {
                        font-weight: 300;
                    }
                }
            }
        }
    }
    .right {
        .images-group {
            .image {
                display: flex;
                position: relative;
                border: 8px solid white;
                overflow: hidden;
                img {
                    width: 100%;
                    object-fit: cover;
                    object-position: center;
                }

                &:nth-child(1) {
                    width: calc(100% - 250px);
                    height: 200px;
                    z-index: 3;
                }
                &:nth-child(2) {
                    margin-top: -100px;
                    width: calc(100% - 150px);
                    height: 250px;
                    margin-left: auto;
                    z-index: 2;
                }

                &:nth-child(3) {
                    margin-top: -50px;
                    width: calc(100% - 250px);
                    z-index: 1;
                    height: 200px;
                }

                &:hover {
                    z-index: 5;
                }
            }
        }
    }
}
</style>
