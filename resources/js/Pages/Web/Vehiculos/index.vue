<template>
    <WebLayout>
        <HeadingPageComponent titulo="Vehiculos" />
        <main class="main">
            <section class="vehiculos-filter-section">
                <div class="container">
                    <div class="filter-categorie">
                        <ul class="categories">
                            <li class="item-categorie active">Todo</li>
                            <li class="item-categorie">Autmovil</li>
                            <li class="item-categorie">Camioneta</li>
                            <li class="item-categorie">MiniVan</li>
                        </ul>
                    </div>

                    <div class="row mt-4">
                        <div class="col-4 col-md-3 col-lg-2">
                            <label for="pasajeros" class="form-label"
                                >Pasajeros</label
                            >
                            <input type="number" class="" placeholder="4" />
                        </div>
                        <div class="col-8 col-md-4 col-lg-4">
                            <label for="transmision" class="form-label"
                                >Transmisión</label
                            >
                            <select
                                class=""
                                aria-label="Default select example"
                                id="transmision"
                            >
                                <option selected>-- Transmisión --</option>
                                <option value="1">Manual</option>
                                <option value="2">Automática</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-5 col-lg-4 ms-auto">
                            <label for="buscar" class="form-label"
                                >Buscar</label
                            >
                            <input type="text" class="" placeholder="Buscar" />
                        </div>
                    </div>
                </div>
            </section>
            <section class="container py-5">
                <div class="row g-4">
                    <div
                        v-for="(item, index) in vehiculos"
                        :key="index"
                        class="col-12 col-md-6 col-lg-4"
                    >
                        <CardVehiculoComponent :item="item" />
                    </div>
                </div>
            </section>
        </main>
    </WebLayout>
</template>

<script setup>
import WebLayout from "@/Layouts/WebLayout.vue";
import CardVehiculoComponent from "../../../Components/Web/CardVehiculoComponent.vue";
import HeadingPageComponent from "../../../Components/Web/HeadingPageComponent.vue";

const props = defineProps({
    vehiculos: Array,
});
</script>
<style lang="scss">
.vehiculos-filter-section {
    background-color: #efefef;
    width: 100%;
    padding: 1.5rem 0;
    .filter-categorie {
        .categories {
            display: flex;
            border-bottom: 1px solid #ddd;
            .item-categorie {
                padding: 0.5rem 1rem;
                &.active {
                    border-bottom: 4px solid $app-color1;
                    color: $app-color1;
                }
            }
        }
    }
}
</style>
