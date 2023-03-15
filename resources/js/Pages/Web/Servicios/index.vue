<template>
    <WebLayout>
        <HeadingPageComponent titulo="Servicios" />
        <main class="main py-5">
            <div class="container">
                <div class="row g-4">
                    <div
                        v-for="item in servicios"
                        class="col-12 col-md-6 col-lg-4"
                    >
                        <CardServiceComponent
                            :item="item"
                            :href="'/servicios/' + item.titulo"
                        />
                    </div>
                </div>
            </div>
        </main>
    </WebLayout>
</template>

<script setup>
import WebLayout from "@/Layouts/WebLayout.vue";
import HeadingPageComponent from "../../../Components/Web/HeadingPageComponent.vue";
import CardServiceComponent from "./components/CardServiceComponent.vue";

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

    {
        id: 2,
        titulo: "CORPORATIVO 2",
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
<style lang="scss"></style>
