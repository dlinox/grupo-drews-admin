<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Mensajes" />
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
                            <th>Mensaje</th>
                            <!-- <th>Opciones</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in mensajes.data" :key="index">
                            <td>
                                {{ item.id }}
                            </td>
                            <td>{{ item.nombres }} {{ item.apellidos }}</td>
                            <td>
                                {{ item.celular }}
                            </td>
                            <td>{{ item.correo }}</td>
                            <td>
                                {{ item.mensaje }}
                            </td>
                            <!-- <td>
                                <n-button> Confirmar </n-button>
                            </td> -->
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

const props = defineProps({
    mensajes: Object,
    filters: Object,
});

const search = ref(props.filters.search);
const page = ref(props.mensajes.current_page);
const totalPages = computed(() => props.mensajes.last_page);
const totalResults = computed(() => props.mensajes.total);

watch(
    search,
    throttle((val) => {
        router.get(
            "/admin/mensajes",
            { search: val },
            {
                preserveState: true,
            }
        );
    }, 600)
);

const goPage = () => {
    if (page.value == props.mensajes.current_page) return;
    let search_aux = "";
    if (search.value) {
        search_aux = "&search=" + search.value;
    }
    router.visit("/admin/mensajes?page=" + page.value + search_aux, {
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
