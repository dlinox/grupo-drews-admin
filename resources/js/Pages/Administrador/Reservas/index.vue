<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Reservas" />
            <n-divider />

            <n-table :bordered="false" :single-line="false">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Número</th>
                        <th>Correo</th>
                        <th>Asunto</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in reservas" :key="index">
                        <td>
                            {{ item.id }}
                        </td>
                        <td>
                            {{ item.cliente?.r_social }}
                        </td>
                        <td>
                            {{ item.cliente?.celular }}
                        </td>
                        <td>{{ item.cliente?.correo }}</td>
                        <td>
                            {{ item.tipo }} :
                            <strong>{{
                                item.tipo == "Vehiculo"
                                    ? item.producto?.detalle
                                    : item.producto?.titulo
                            }}</strong>
                        </td>
                        <td>
                            <n-button> Confirmar </n-button>
                        </td>
                    </tr>
                </tbody>
            </n-table>
        </div>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";

const props = defineProps({
    reservas: Array,
});
</script>
