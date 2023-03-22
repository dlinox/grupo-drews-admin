<template>
    <AdminLayout>
        <PageHeaderComponent title="Clientes" />

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

                <FormularioClienteComponent btn_text="Crear Cliente" />
            </n-space>
        </n-card>

        <div class="table-wrapper">
            <n-table :bordered="false" :single-line="false">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Detalle</th>
                        <th>N° Doc</th>
                        <th>Logo</th>
                        <th>Op.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in clientes.data">
                        <td>{{ item.id }}</td>
                        <td>{{ item.r_social }}</td>
                        <td>{{ item.num_doc }}</td>
                        <td>
                            <n-space justify="center">
                                <n-image width="80" :src="item.logo" />
                            </n-space>
                        </td>
                        <td style="width: 180px">
                            <n-space justify="end">
                                <FormularioClienteComponent
                                    btn_text="Editar"
                                    :cliente="item"
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
    </AdminLayout>
</template>
<script setup>
import { ref, computed, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import FormularioClienteComponent from "./Components/FormularioClienteComponent.vue";
import { Search } from "@vicons/ionicons5";
import debounce from "lodash/debounce";

const toast = useToast();

const props = defineProps({
    clientes: Object,
    filters: Object,
});

const search = ref(props.filters.search);
const page = ref(props.clientes.current_page);
const totalPages = computed(() => props.clientes.last_page);
const totalResults = computed(() => props.clientes.total);

watch(
    search,
    debounce((val) => {
        router.get(
            "/admin/clientes",
            { search: val },
            {
                preserveState: true,
            }
        );
    }, 300)
);

const goPage = () => {
    if (page.value == props.clientes.current_page) return;
    let search_aux = "";
    if (search.value) {
        search_aux = "&search=" + search.value;
    }
    router.visit("/admin/clientes?page=" + page.value + search_aux, {
        preserveState: true,
    });
};

const eliminar = (id) => {
    router.delete("/admin/clientes/" + id, {
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
