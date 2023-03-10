<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Categorias" />
            <n-divider />
            <FormularioCategoriaComponent btn_text="Nueva Categoria" />
           
            <n-table :bordered="false" :single-line="false">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Detalle</th>
                        <th>Op.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in categorias">
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
    </AdminLayout>
</template>
<script setup>
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import FormularioCategoriaComponent from "./Components/FormularioCategoriaComponent.vue";

const props = defineProps({
    categorias: Array,
});
const eliminar = (id) => {
    router.delete("/admin/categorias/" + id);
};
</script>
