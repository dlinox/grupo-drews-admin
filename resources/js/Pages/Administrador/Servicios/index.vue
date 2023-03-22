<template>
    <AdminLayout>
        <PageHeaderComponent title="Servicios" />

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

                <n-button
                    type="primary"
                    @click="() => router.get('/admin/servicios/create')"
                >
                    Nuevo servicio
                </n-button>
            </n-space>
        </n-card>
        <div class="table-wrapper">
        <n-table :bordered="false" :single-line="false">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Icono</th>
                    <th>Op.</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in servicios.data">
                    <td>{{ item.id }}</td>
                    <td>{{ item.titulo }}</td>
                    <td>{{ item.descripcion }}</td>
                    <td>{{ item.figura }}</td>
                    <td style="width: 180px">
                        <n-space justify="end">
                            <n-button
                                type="info"
                                tertiary
                                @click="
                                    router.get(
                                        '/admin/servicios/' + item.id + '/edit'
                                    )
                                "
                            >
                                Editar
                            </n-button>

                            <n-popconfirm
                                :show-icon="false"
                                negative-text="No"
                                positive-text="Si"
                                @positive-click="eliminarUsuario(item.id)"
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
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import { useToast } from "vue-toastification";

import { ref, computed, watch } from "vue";
import { Search } from "@vicons/ionicons5";
import debounce from "lodash/debounce";

const toast = useToast();
const props = defineProps({
    servicios: Object,
    filters: Object,
});

const search = ref(props.filters.search);
const page = ref(props.servicios.current_page);
const totalPages = computed(() => props.servicios.last_page);
const totalResults = computed(() => props.servicios.total);

watch(
    search,
    debounce((val) => {
        router.get(
            "/admin/servicios",
            { search: val },
            {
                preserveState: true,
            }
        );
    }, 300)
);

const goPage = () => {
    if (page.value == props.servicios.current_page) return;
    let search_aux = "";
    if (search.value) {
        search_aux = "&search=" + search.value;
    }
    router.visit("/admin/servicios?page=" + page.value + search_aux, {
        preserveState: true,
    });
};

const eliminarUsuario = (id) => {
    router.delete("/admin/servicios/" + id, {
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
