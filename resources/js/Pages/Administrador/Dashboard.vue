<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Dashboard" />

            <div class="contenido">
                <n-grid
                    cols="1  300:2 800:4 "
                    item-responsive
                    :x-gap="20"
                    :y-gap="20"
                >
                    <n-grid-item>
                        <n-card class="card-stadistic">
                            <div class="shapes">
                                <div class="shape shape-1"></div>
                                <div class="shape shape-2"></div>
                                <div class="shape shape-3"></div>
                            </div>
                            <n-icon class="card-icon"> <Car /> </n-icon>
                            <h1>{{ vehiculos }}</h1>
                            <span> Vehiculos</span>
                        </n-card>
                    </n-grid-item>

                    <n-grid-item>
                        <n-card class="card-stadistic">
                            <div class="shapes">
                                <div class="shape shape-1"></div>
                                <div class="shape shape-2"></div>
                                <div class="shape shape-3"></div>
                            </div>
                            <n-icon class="card-icon"> <Business /> </n-icon>

                            <h1>{{ servicios }}</h1>
                            <span> Servicios</span>
                        </n-card>
                    </n-grid-item>

                    <n-grid-item>
                        <n-card class="card-stadistic">
                            <div class="shapes">
                                <div class="shape shape-1"></div>
                                <div class="shape shape-2"></div>
                                <div class="shape shape-3"></div>
                            </div>
                            <n-icon class="card-icon"> <PeopleSharp /> </n-icon>
                            <h1>{{ clientes }}</h1>
                            <span> Clientes</span>
                        </n-card>
                    </n-grid-item>

                    <n-grid-item>
                        <n-card class="card-stadistic">
                            <div class="shapes">
                                <div class="shape shape-1"></div>
                                <div class="shape shape-2"></div>
                                <div class="shape shape-3"></div>
                            </div>
                            <n-icon class="card-icon"> <PersonSharp /> </n-icon>
                            <h1>{{ usuarios }}</h1>

                            <span>Usuarios</span>
                        </n-card>
                    </n-grid-item>

                    <n-grid-item span="1  300:2 800:4 ">
                        <n-card>
                            <h2>Ultimas reservas</h2>
                            <div class="table-wrapper">
                                <n-table :bordered="false" :single-line="false">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cliente</th>
                                            <th>Número</th>
                                            <th>Correo</th>
                                            <th>Asunto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(item, index) in reservas"
                                            :key="index"
                                        >
                                            <td>
                                                {{ item.id }}
                                            </td>
                                            <td>
                                                {{ item.r_social }}
                                            </td>
                                            <td>
                                                {{ item.celular }}
                                            </td>
                                            <td>{{ item.correo }}</td>
                                            <td>
                                                {{ item.tipo }} :
                                                <strong>{{
                                                    item.tipo == "Vehiculo"
                                                        ? item.detalle
                                                        : item.titulo
                                                }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </n-table>
                            </div>
                        </n-card>
                    </n-grid-item>
                </n-grid>
            </div>
        </div>
    </AdminLayout>
</template>
<script setup>
import { ref } from "vue";
import { useToast } from "vue-toastification";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import {
    Business,
    Car,
    Card,
    PeopleSharp,
    PersonSharp,
} from "@vicons/ionicons5";

const props = defineProps({
    vehiculos: Number,
    servicios: Number,
    clientes: Number,
    usuarios: Number,
    reservas: Array,
});
</script>

<style lang="scss">
.card-stadistic {
    overflow: hidden;
    position: relative;
    border: none;
    box-shadow: 0px 5px 10px 0px rgba($app-color1, 0.3);
    .card-icon {
        position: absolute;
        bottom: 0;
        right: 0;
        font-size: 8rem;
        color: rgba($app-color1, 0.5);
        transform: translate(2.5rem, 2.5rem);
    }
    .shapes {
        .shape {
            position: absolute;
            content: "";
            left: 0;
            top: -100px;
            background-color: rgba($app-color1, 0.04);
            border-radius: 5px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            transition: all 0.3s ease-out;
        }
        .shape-1 {
            width: 150px;
            height: 150px;
            left: calc(50% - 75px);
        }
        .shape-2 {
            width: 170px;
            height: 170px;
            left: calc(50% - 85px);
        }
        .shape-3 {
            width: 190px;
            height: 190px;
            left: calc(50% - 95px);
        }
        .shape-4 {
            width: 210px;
            height: 210px;
            left: 0px;
        }
    }
    h1 {
        font-size: 3rem;
        line-height: 3rem;
        margin: 1rem 0;
    }
    span {
        color: $app-color1;
        font-weight: 700;
    }
}
</style>
