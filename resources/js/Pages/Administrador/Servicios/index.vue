<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Servicios" />
            <n-divider />

            <n-space class="my-1" justify="end">
                <n-button
                    type="primary"
                    @click="() => router.get('/admin/servicios/create')"
                >
                    Nuevo servicio
                </n-button>
            </n-space>

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
                    <tr v-for="item in servicios">
                        <td>{{ item.id }}</td>
                        <td>{{ item.titulo }}</td>
                        <td>{{ item.descripcion }}</td>
                        <td>{{ item.figura }}</td>
                        <td style="width: 180px">
                            <n-space justify="end">
                                <FormularioServicioComponent
                                    btn_text="Editar"
                                    :data="item"
                                    :edit="true"
                                />

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
    </AdminLayout>
</template>
<script setup>
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import FormularioServicioComponent from "./Components/FormularioServicioComponent.vue";
const props = defineProps({
    servicios: Array,
});
const eliminarUsuario = (id) => {
    router.delete("/admin/servicios/" + id);
};
</script>
