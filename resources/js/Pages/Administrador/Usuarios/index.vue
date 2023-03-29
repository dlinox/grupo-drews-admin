<template>
    <AdminLayout>
        <div class="container-xxl">
            <PageHeaderComponent title="Usuarios" />

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

                    <FormularioUsuarioComponent btn_text="Nuevo usuario" />
                </n-space>
            </n-card>
            <div class="table-wrapper">
                <n-table :bordered="false" :single-line="false">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Op.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in usuarios.data">
                            <td>{{ item.id }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.email }}</td>
                            <td style="max-width: 200px">
                                <n-space justify="end">
                                    <FormularioUsuarioComponent
                                        btn_text="Editar"
                                        :data="item"
                                        :edit="true"
                                    />

                                    <n-popconfirm
                                        :show-icon="false"
                                        negative-text="No"
                                        positive-text="Si"
                                        @positive-click="
                                            eliminarUsuario(item.id)
                                        "
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
import throttle from "lodash/throttle";
import { ref, watch, computed } from "vue";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import FormularioUsuarioComponent from "./Components/FormularioUsuarioComponent.vue";
import { Search } from "@vicons/ionicons5";

const props = defineProps({
    filters: Object,
    usuarios: Object,
});

const toast = useToast();

const search = ref(props.filters.search);
const page = ref(props.usuarios.current_page);
const totalPages = computed(() => props.usuarios.last_page);
const totalResults = computed(() => props.usuarios.total);

watch(
    search,
    throttle((val) => {
        router.get(
            "/admin/usuarios",
            { search: val },
            {
                preserveState: true,
            }
        );
    }, 600)
);

const goPage = () => {
    if (page.value == props.usuarios.current_page) return;
    let search_aux = "";
    if (search.value) {
        search_aux = "&search=" + search.value;
    }
    router.visit("/admin/usuarios?page=" + page.value + search_aux, {
        preserveState: true,
    });
};

const eliminarUsuario = (id) => {
    router.delete("/admin/usuarios/" + id, {
        onError: () => {
            toast.error("Ocurrio un error, vuelva a intentar.");
        },
        onSuccess: () => {
            toast.success("Eliminado con exito.");
        },
    });
};
</script>
