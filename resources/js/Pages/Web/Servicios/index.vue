<template>
    <Head>
        <title>Servicios | Grupo Drews</title>
        <meta name="description" content="Más sobre Grupo Drews" />
    </Head>

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
                            :href="'/servicios/' + item.id"
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
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    servicios: Array,
});
</script>
<style lang="scss"></style>
