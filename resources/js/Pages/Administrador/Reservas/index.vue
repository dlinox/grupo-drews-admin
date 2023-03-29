<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Reservas" />
            <n-card>
                <n-space justify="space-between">
                    <n-input
                        v-model:value="search"
                        type="text"
                        placeholder="Buscar"
                    >
                        <template #prefix>
                            <n-icon> <Search /> </n-icon>
                        </template>
                    </n-input>
                </n-space>
            </n-card>

            <div class="table-wrapper">
                <n-table :bordered="false" :single-line="false">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Número</th>
                            <th>Correo</th>
                            <th>Asunto</th>
                            <th>mensaje</th>
                            <th>estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in reservas.data" :key="index">
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

                            <td>{{ item.mensaje }}</td>
                            <td>
                                <n-dropdown
                                    trigger="hover"
                                    :options="options"
                                    @select="cambiarEstado($event, item.id)"
                                >
                                    <n-button
                                        :loading="
                                            btnEstadoLoading &&
                                            btnEstadoLoadingID == item.id
                                        "
                                        secondary
                                        :type="
                                            item.estado == 0
                                                ? 'error'
                                                : item.estado == 1
                                                ? 'success'
                                                : 'warning'
                                        "
                                    >
                                        {{
                                            item.estado == 0
                                                ? "Cancelado"
                                                : item.estado == 1
                                                ? "Atendido"
                                                : "En espera"
                                        }}
                                    </n-button>
                                </n-dropdown>
                            </td>
                        </tr>
                    </tbody>
                </n-table>
            </div>
            <n-card>
                <n-space justify="end">
                    <n-pagination
                        v-model:page="page"
                        :page-slot="5"
                        :page-count="totalPages"
                        @click="goPage"
                    />
                </n-space>
            </n-card>
        </div>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import { router } from "@inertiajs/vue3";

import { ref, computed, watch } from "vue";
import { Search } from "@vicons/ionicons5";
import throttle from "lodash/throttle";

import { useToast } from "vue-toastification";
const toast = useToast();

const props = defineProps({
    reservas: Object,
    filters: Object,
});

const search = ref(props.filters.search);
const page = ref(props.reservas.current_page);
const totalPages = computed(() => props.reservas.last_page);
const totalResults = computed(() => props.reservas.total);

const btnEstadoLoading = ref(false);
const btnEstadoLoadingID = ref(false);

const options = [
    {
        label: "En espera",
        key: "espera",
    },

    {
        label: "Marcar como atendido",
        key: "atender",
    },
    {
        label: "Cancelar",
        key: "cancelar",
    },
];

const cambiarEstado = (val, id) => {
    console.log(val);
    console.log(id);

    router.post(
        "/admin/reservas/estado",
        { estado: val, id: id },
        {
            onStart: () => {
                btnEstadoLoadingID.value = id;
                btnEstadoLoading.value = true;
            },
            onFinish: () => {
                btnEstadoLoadingID.value = id;
                btnEstadoLoading.value = false;
            },
            onError: (e) => {
                for (const property in e) {
                    toast.error(e[property]);
                }
            },
            onSuccess: (e) => {
                toast.success("Estado actualizado");
            },
        }
    );
};

watch(
    search,
    throttle((val) => {
        router.get(
            "/admin/reservas",
            { search: val },
            {
                preserveState: true,
            }
        );
    }, 600)
);

const goPage = () => {
    if (page.value == props.reservas.current_page) return;
    let search_aux = "";
    if (search.value) {
        search_aux = "&search=" + search.value;
    }
    router.visit("/admin/reservas?page=" + page.value + search_aux, {
        preserveState: true,
    });
};
</script>

<style>
.table-wrapper {
    max-width: 100%;
    overflow-x: auto;
}
</style>
