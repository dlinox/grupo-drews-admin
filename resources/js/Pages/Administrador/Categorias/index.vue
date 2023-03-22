<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Categorias" />

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
                    <FormularioCategoriaComponent btn_text="Nueva Categoria" />
                </n-space>
            </n-card>
            <div class="table-wrapper">
                <n-table :bordered="false" :single-line="false">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Detalle</th>
                            <th>Op.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in categorias.data">
                            <td>{{ item.id }}</td>
                            <td>{{ item.detalle }}</td>
                            <td style="width: 180px">
                                <n-space justify="end">
                                    <FormularioCategoriaComponent
                                        btn_text="Editar"
                                        :data="item"
                                        :edit="true"
                                    />

                                    <n-popconfirm
                                        :show-icon="false"
                                        negative-text="No"
                                        positive-text="Si"
                                        @positive-click="eliminar(item.id)"
                                    >
                                        <template #activator>
                                            <n-button type="error" tertiary>
                                                Eliminar
                                            </n-button>
                                        </template>
                                        ¿ Seguro de elimnar al usuario ?
                                    </n-popconfirm>
                                </n-space>
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
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import FormularioCategoriaComponent from "./Components/FormularioCategoriaComponent.vue";

import { useToast } from "vue-toastification";

import { ref, computed, watch } from "vue";
import { Search } from "@vicons/ionicons5";
import debounce from "lodash/debounce";

const toast = useToast();
const props = defineProps({
    categorias: Object,
    filters: Object,
});

const search = ref(props.filters.search);
const page = ref(props.categorias.current_page);
const totalPages = computed(() => props.categorias.last_page);
const totalResults = computed(() => props.categorias.total);

watch(
    search,
    debounce((val) => {
        router.get(
            "/admin/categorias",
            { search: val },
            {
                preserveState: true,
            }
        );
    }, 300)
);

const goPage = () => {
    if (page.value == props.categorias.current_page) return;
    let search_aux = "";
    if (search.value) {
        search_aux = "&search=" + search.value;
    }
    router.visit("/admin/categorias?page=" + page.value + search_aux, {
        preserveState: true,
    });
};

const eliminar = (id) => {
    router.delete("/admin/categorias/" + id, {
        onError: (e) => {
            for (const property in e) {
                toast.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: (e) => {
            toast.success("Eliminado con exito");
            console.log(e);
        },
    });
};
</script>
