<template>
    <WebLayout>
        <HeadingPageComponent titulo="Nosotros" />
        <main class="page-nosotros py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-12">
                        <TituloSectionComponent
                            titulo="GRUPO DREWS"
                            descripcion=" Alquiler de camionetas 4x4 y otros veiculos motorizados"
                        />
                        <p>
                            Grupo Drews forma parte de un grupo empresarial
                            conformado por Servicios Múltiples Drews S.A.C. –
                            (Drews Rent A Car), Servicios Generales Drews Perú
                            S.A.C., Esbril S.A.C., Intermotors S.A.C. y Tamawi
                            S.A.C. con amplia experiencia en el sector
                            Automotriz. Somos un grupo empresarial con más de 10
                            años de experiencia en la Región Puno y el Sur del
                            Perú con el objetivo de brindar servicios de
                            alquiler de Camionetas 4X4, Alquiler de maquinaria
                            pesada y otros Vehículos motorizados. Servicio de
                            taller mecánico, Auxilio mecánico, Venta de
                            repuestos, Asesoría y venta de seguros,
                            Consultorías, Movimiento de tierras, Líneas de media
                            tensión, Ejecución de obras y otros.
                        </p>
                        <p>
                            Drews Rent A Car, inicia sus labores en la región
                            puno en el año 2007, con el objetivo de brindar
                            servicio de camionetas 4×4, en los diferentes
                            sectores y actividades de desarrollo en la región,
                            centrándonos con mayor interés en los sectores de
                            minería, exploraciones, energía, construcción,
                            ingeniería, etc.
                        </p>
                    </div>
                    <div class="col-md-5 col-12 d-flex flex-wrap">
                        <div class="w-100 text-end mt-5">
                            <h1 class="text-color1">10 +</h1>
                            <h5>Experiencia</h5>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <img
                                    class="rounded-4"
                                    width="100%"
                                    src="https://www.grupodrews.com.pe/wp-content/uploads/2019/06/quienes-somos2.jpg"
                                    alt=""
                                />
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
import TituloSectionComponent from "../../../Components/Web/TituloSectionComponent.vue";
</script>
<style lang="scss">
.page-nosotros {
    img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
    }
}
</style>
