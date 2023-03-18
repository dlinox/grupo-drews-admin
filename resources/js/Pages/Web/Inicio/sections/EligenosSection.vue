<template>
    <section class="inicio-eligenos pb-5">
        <div class="container">
            <TituloSectionComponent
                titulo="Elígenos"
                descripcion="Por qué alquilar en DREWS"
            />

            <div class="row">
                <div
                    class="col-6 col-md-3 col-lg-4 "
                    v-for="(item, index) in items"
                >
                    <div class="card-eligenos rounded-3 shadow-sm">
                        <div class="numero">0{{ index + 1 }}</div>
                        <div class="detalle">
                            {{ item }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import TituloSectionComponent from "@/Components/Web/TituloSectionComponent.vue";

const items = [
    "SERVICIO DE TRANSPORTE RÁPIDO",
    "SOPORTE EN LÍNEA 24/7",
    "SEGURIDAD Y CONFIABILIDAD",
];
</script>

<style lang="scss">
.inicio-eligenos {
    background-image: repeating-linear-gradient(
        45deg,
        rgba($app-color1, 0.1) 0,
        rgba($app-color1, 0.1) 0.5px,
        transparent 0,
        transparent 50%
    );

    background-size: 13px 13px;
    background-color: #fff;

    .card-eligenos {
        padding: 1rem 3rem;
        text-align: center;
        height: 100%;
        background: rgba(255, 255, 255, 1);

        backdrop-filter: blur(15px);

        .numero {
            line-height: 5rem;
            margin-bottom: 1rem;
            font-weight: 900;
            color: transparent;
            letter-spacing: 4px;
            font-size: 4rem;
            font-family: $font-teko;
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: rgba(100, 100, 100, 0.5);
        }
        .detalle {
            font-size: 1.5rem;
            font-family: $font-teko;
            letter-spacing: 1px;
        }
    }
}
</style>
