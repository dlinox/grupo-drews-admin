<template>
    <Head>
        <title>Vehículos | Grupo Drews</title>
        <meta name="description" content="Más sobre Grupo Drews" />
    </Head>

    <WebLayout>
        <HeadingPageComponent titulo="Vehiculos" />
        <main class="main">
            <section class="vehiculos-filter-section">
                <div class="container">
                    <div class="filter-categorie">
                        <ul class="categories">
                            <li
                                class="item-categorie"
                                :class="
                                    filters.categoria == null ? 'active' : ''
                                "
                            >
                                <button
                                    class="btn btn-text"
                                    @click="filters.categoria = null"
                                >
                                    Todo
                                </button>
                            </li>
                            <li
                                v-for="(item, index) in categorias"
                                :key="index"
                                class="item-categorie"
                                :class="
                                    filters.categoria == item.detalle
                                        ? 'active'
                                        : ''
                                "
                            >
                                <button
                                    class="btn btn-text rounded-0"
                                    @click="filters.categoria = item.detalle"
                                >
                                    {{ item.detalle }}
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="row mt-4">
                        <div class="col-4 col-md-3 col-lg-2">
                            <label for="pasajeros" class="form-label">
                                Pasajeros
                            </label>
                            <input type="number" v-model="filters.pasajeros">
                        </div>
                        <div class="col-8 col-md-4 col-lg-4">
                            <label for="transmision" class="form-label"
                                >Transmisión</label
                            >
                            <select
                                aria-label="Default select example"
                                v-model="filters.transmision"
                            >
                                <option selected>-- Transmisión --</option>
                                <option :value="null">Todo</option>
                                <option value="Manual">Manual</option>
                                <option value="Automatico">Automática</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-5 col-lg-4 ms-auto">
                            <label for="buscar" class="form-label"
                                >Buscar</label
                            >
                            <input
                                v-model="filters.term"
                                type="text"
                                class=""
                                placeholder="Buscar"
                            />
                        </div>
                    </div>
                </div>
            </section>

            <section class="container py-5">
                <div class="row g-4">
                    <div
                        v-for="(item, index) in listVehiculos"
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
import { ref, reactive, watch } from "vue";
import WebLayout from "@/Layouts/WebLayout.vue";
import CardVehiculoComponent from "../../../Components/Web/CardVehiculoComponent.vue";
import HeadingPageComponent from "../../../Components/Web/HeadingPageComponent.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    vehiculos: Array,
    categorias: Array,
});

const listVehiculos = ref(props.vehiculos);

const filters = ref({
    term: null,
    categoria: null,
    pasajeros: null,
    transmision: null,
});

watch(
    filters,
    (val) => {
        filterVehiculo();
    },
    {
        deep: true,
    }
);

const filterVehiculo = () => {
    let temp = props.vehiculos;

    if (filters.value.categoria) {
        temp = temp.filter((item) => item.categoria == filters.value.categoria);
    }

    if (filters.value.pasajeros) {
        temp = temp.filter((item) => item.capacidad == filters.value.pasajeros);
    }

    if (filters.value.transmision) {
        console.log(filters.value.transmision);
        temp = temp.filter((item) => item.tipo == filters.value.transmision);
    }

    if (filters.value.term) {
        temp = temp.filter((item) => {
            return (
                item.detalle
                    .toLowerCase()
                    .indexOf(filters.value.term.toLowerCase()) > -1 ||
                item.marca
                    .toLowerCase()
                    .indexOf(filters.value.term.toLowerCase()) > -1 ||
                item.modelo
                    .toLowerCase()
                    .indexOf(filters.value.term.toLowerCase()) > -1
            );
        });
    }

    listVehiculos.value = temp;
};
</script>
<style lang="scss">
.vehiculos-filter-section {
    background-color: #efefef;
    width: 100%;
    padding: 1.5rem 0;
    font-family: $font-raj;
    .filter-categorie {
        .categories {
            display: flex;
            border-bottom: 1px solid #ddd;
            .item-categorie {
                &.active {
                    border-bottom: 4px solid $app-color1;
                    color: $app-color1;
                }
            }
        }
    }
}
</style>
