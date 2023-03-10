<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Usuarios" />
            <n-divider />
            <FormularioUsuarioComponent btn_text="Nuevo usuario" />

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
                    <tr v-for="item in usuarios">
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.email }}</td>
                        <td style="width: 180px">
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

            <!-- <cropper
                class="cropper"
                src="https://images.pexels.com/photos/15174803/pexels-photo-15174803.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                :stencil-props="{
                    aspectRatio: 10 / 12,
                }"
               
            /> -->
        </div>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import FormularioUsuarioComponent from "./Components/FormularioUsuarioComponent.vue";
import { router } from "@inertiajs/vue3";
import { Cropper } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";

const props = defineProps({
    usuarios: Array,
});
const eliminarUsuario = (id) => {
    router.delete("/admin/usuarios/" + id);
};
</script>
