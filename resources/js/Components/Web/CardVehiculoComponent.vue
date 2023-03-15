<template>
    <div class="card-vehiculo">
        <div class="shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
        <div class="card-imagen">
            <button
                class="btn btn-outline-dark btn-galeria"
                @click="showGaleria = !showGaleria"
            >
                <i class="fa-solid fa-images"></i>
            </button>
            <img :src="item.imagenes[0]" alt="" />
        </div>
        <div class="card-content">
            <div class="card-title">{{ item.detalle }}</div>
            <div class="card-descripcion">
                <div class="row">
                    <div class="col-3">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAkUlEQVR4nO2UWwoDIQxFDy6n3UjFFbh97WddQ8tAKH2gzTixdaAX8qFHvETJhb9WKgBnIAPeiD1pOXCVSkbsuwYeKMAFOBmxN0UpS/YbA/ey75RMbXB8uMjJWsPUBr01j8Gh8QwtNs8n73MOgox8qSRmqTC1wZZAiyMNwofu7vJyUaokZq4wdVz3Ko82aHU3Vje9tGhqlGbX/QAAAABJRU5ErkJggg=="
                        />
                        <span>Automatico</span>
                    </div>
                    <div class="col-3">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAA7UlEQVR4nO2UvQ7BUBiGn8RiNLD4GWpgtyl3wc4NuAZuhzTpKCbuwMAkJJgRJAYWInklJ001EkcsfZNn6Pf3tv1OC7EsqQB4wFn4QNnm8D1wD3BQ7mt5GjgGqmKs2MCGwVnDnoMd4Sp2+rXB0YaBb7wiV0wU69swKGuhwSXvgDyWVNBCT6Jvc3ist0oAdaALpEPyGeVqqv1YSaADbI0TswQaQEo0gZWR36jn2RupHDA3GtfAIuSIvlio5nU9A7JRBiPjjltAUd9BD5gCFzFVrKSatvFEwyiDm4oqxm/B+ZCKeq9RBndL/M8gFkE9ABgndaNje0gbAAAAAElFTkSuQmCC"
                        />
                        <span> {{ item.capacidad }} pers.</span>
                    </div>
                    <div class="col-3">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAArElEQVR4nO2UPQrCQBBG3/GMbKGkNFXOJHaCbbT2DpIb2MYLWBmxWQlMICy7IssMKfSDr1jm580y7MKvqAV84IsmwCesDhiVBVgCtw/T+i899ChiAI3mXtzFAGPQicOzSzhVNz/AZVoFcAR6oLEC9JL7sAI0wQ0qYGWxgw1wAp7AVhNQA2fgNam7agL2k/w7cABKTUApE++AtcWSXc47MP+LCgloNF/EAH/NozczkM4nImzfogAAAABJRU5ErkJggg=="
                        />
                        <span> {{ item.equipaje }} Equipa.</span>
                    </div>
                    <div class="col-3">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAvElEQVR4nO2VsQrCQBBEX60giJWKVX4nhY0faOdfqOksBMFGtLZUISAoV5wcbJog2dukSSAD083O7LLcHvRoO8bAGngBvoIOyIDEYj4BTopxmXtL50cpOgMLRT8AnjKJihFwEPMLMI1s6i41lRjKmEF4BWaR5lEBYcytiG7A3GAeFbAxLtSX+NYCvg0DPlpAIUxr8tGJAP+H3QpIW70DJ4JVDfMlkGu3KGv4Drx2TRMRFJNY6ICd9T/oQcAPmXOt3NCFPAYAAAAASUVORK5CYII="
                        />
                        <span> {{ item.puertas }} prta.</span>
                    </div>
                </div>
            </div>
            <hr />

            <n-space justify="space-between">
                <button class="btn btn-color1" @click="showModal = !showModal">
                    Ver más
                </button>
            </n-space>
        </div>
    </div>

    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px"
            :title="item.detalle"
            :bordered="false"
            size="huge"
            role="dialog"
            aria-modal="true"
        >
            <n-grid cols="2 300:3" :y-gap="20">
                <n-gi>
                    <n-statistic label="Marca" :value="item.marca" />
                </n-gi>
                <n-gi>
                    <n-statistic label="Modelo" :value="item.modelo" />
                </n-gi>
                <n-gi>
                    <n-statistic label="Categoria" :value="item.categoria" />
                </n-gi>
                <n-gi>
                    <n-statistic label="Tipo" :value="item.tipo" />
                </n-gi>
                <n-gi>
                    <n-statistic
                        label="Combustible"
                        :value="item.combustible"
                    />
                </n-gi>
                <n-gi>
                    <n-statistic label="Cilindrada" :value="item.cilindrada" />
                </n-gi>
                <n-gi>
                    <n-statistic label="Puertas" :value="item.puertas" />
                </n-gi>
                <n-gi>
                    <n-statistic label="Capacidad" :value="item.capacidad" />
                </n-gi>

                <n-gi>
                    <n-statistic
                        label="Aire Acon."
                        :value="item.aire_acondicionado ? 'SI' : 'NO'"
                    />
                </n-gi>

                <n-gi>
                    <n-statistic label="Equipaje." :value="item.equipaje" />
                </n-gi>
            </n-grid>

            <template #footer>
                <n-space justify="flex-end">
                    <n-dropdown :options="options">
                        <button class="btn btn-color1">Solicitar</button>
                    </n-dropdown>
                </n-space>
            </template>
        </n-card>
    </n-modal>

    <n-modal v-model:show="showGaleria">
        <n-card
        class="bg-dark"
            style="width: 800px"
          
            :bordered="false"
            size="huge"
            role="dialog"
            aria-modal="true"
        >
            <n-carousel  :loop="false" show-arrow draggable>
                <img
                    class="carousel-img"
                    v-for="(img, index) in item.imagenes"
                    :key="index"
                    :src="img"
                />
            </n-carousel>

        </n-card>
    </n-modal>
</template>
<script setup>
import { ref } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";

const props = defineProps({
    item: Object,
});

const showModal = ref(false);

const showGaleria = ref(false);

const options = [
    {
        label: "Escribenos",
        key: "email",
    },

    {
        label: "Whatsapp",
        key: "whatsapp",
    },
];
</script>
<style lang="scss">
.carousel-img {
    width: 100%;
    height: 500px;
    object-fit: cover;
}

.card-vehiculo {
    position: relative;
    background-color: #fff;
    -webkit-box-shadow: 0px 11px 38px 0px rgb(32 42 48 / 8%);
    box-shadow: 0px 11px 38px 0px rgb(32 42 48/ 8%);

    border-radius: 5px;
    overflow: hidden;
    -webkit-transition: all 0.3s ease-out 0s;
    transition: all 0.3s ease-out;
    width: 100%;
    .shapes {
        .shape {
            position: absolute;
            content: "";
            top: 120;
            right: -100px;
            background-color: rgba($app-color1, 0.04);
            border-radius: 5px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            transition: all 0.5s ease-out;
        }
        .shape-1 {
            width: 150px;
            height: 150px;
            top: 148px;
        }
        .shape-2 {
            width: 170px;
            height: 170px;
            top: 140px;
        }
        .shape-3 {
            width: 190px;
            height: 190px;
            top: 130px;
        }
        .shape-4 {
            width: 210px;
            height: 210px;
            top: 20px;
        }
    }

    .card-imagen {
        position: relative;
        width: 100%;
        z-index: 3;
        overflow: hidden;

        .btn-galeria {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 5;
        }
        img {
            width: 100%;
            height: 250px;
            transition: all 0.4s ease-out;
            object-fit: cover;
            object-position: center;
        }
    }
    .card-content {
        padding: 20px;
        .card-title {
            margin-bottom: 18px;
            font-size: 25px;
            line-height: 35px;
            transition: all 0.4s ease-out;
        }
        .card-descripcion {
            .col-3 {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                img {
                    width: 20px;
                }
                span {
                    width: 100%;
                    text-align: center;
                    font-size: 0.7rem;
                    color: #333;
                }
            }
        }
    }

    &:hover {
        .shapes {
            .shape {
                background-color: rgba($app-color1, 0.08);
            }
        }

        .card-imagen {
            img {
                scale: 1.2;
            }
        }
        .card-title {
            color: $app-color1;
        }
        .card-descripcion {
            color: #ddd;
        }
    }
}
</style>
