<template>
    <Head>
        <title>Clientes | Grupo Drews</title>
        <meta name="description" content="Alquiler de vehiculos motorizados" />
    </Head>
    <WebLayout>
        <HeadingPageComponent titulo="Clientes" />
        <main class="page-clientes">
            <div class="container">
                <TituloSectionComponent
                    titulo="Clientes"
                    descripcion="Nuestros clientes"
                />

                <div class="row gx-5 gy-5 mb-5">
                    <div
                        class="col-6 col-md-3 col-lg-2 item-cliente"
                        v-for="(item, index) in clientes"
                        :key="index"
                    >
                        <img :src="item.logo" alt="" />
                    </div>
                </div>
            </div>
        </main>
    </WebLayout>
</template>
<script setup>
import WebLayout from "@/Layouts/WebLayout.vue";
import { Head } from "@inertiajs/vue3";
import TituloSectionComponent from "@/Components/Web/TituloSectionComponent.vue";
import HeadingPageComponent from "../../../Components/Web/HeadingPageComponent.vue";

const props = defineProps({
    clientes: Array,
});
</script>
<style lang="scss">
.page-clientes {
    .item-cliente {
        img {
            width: 100%;
        }
    }
}
</style>
