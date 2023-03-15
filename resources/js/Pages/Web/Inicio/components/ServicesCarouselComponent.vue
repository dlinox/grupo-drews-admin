<template>
    <section class="inicio-servicios" v-if="servicios">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="border-0 bg-color1 shadow my-0 my-lg-3 p-3">
                        <div class="card-body text-white">
                            <div class="card-title">
                                <h1>GRUPO DREWS</h1>
                            </div>
                            <div class="card-subtitle">
                                <p>
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
                <div class="col-12 col-lg-7">
                    <swiper :slides-per-view="2" :space-between="10">
                        <swiper-slide
                            v-for="(item, index) in servicios"
                            :key="index"
                        >
                            <CardSmallServiceComponent :item="item" />
                        </swiper-slide>
                    </swiper>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import CardSmallServiceComponent from "./CardSmallServiceComponent.vue";

const servicios = [
    {
        id: 1,
        titulo: "CORPORATIVO",
        descripcion:
            "Contamos con una variedad de modelos de Camionetas 4×4, 4×2, Vans, Minivans y Custers, con la implementación y equipamiento requerido. Tarifas corporativas.",
        contenido: null,
        imagenes: [
            "http://grupo-drews.test/uploads/servicios/1678755537-img-1.jpg",
            "http://grupo-drews.test/uploads/servicios/1678755537-img-2.jpg",
            "http://grupo-drews.test/uploads/servicios/1678755537-img-3.jpg",
        ],
        figura: "fa-solid fa-building",
        detalles: [
            {
                titulo: "Detalle 1",
                descripcion: "Descripción del detalle 11",
            },
            {
                titulo: "Detalle 2",
                descripcion: "Descripción del detalle 22",
            },
        ],
    },
];
</script>

<style lang="scss">
.inicio-servicios {
   background-color: transparent;
    position: relative;
    z-index: 3;
    margin-top: -100px;
    overflow: hidden;
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
