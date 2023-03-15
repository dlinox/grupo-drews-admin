<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Productos" />
            <n-divider></n-divider>

            <n-space class="my-1" justify="end">
                <n-button
                    type="primary"
                    @click="() => router.get('/admin/productos/create')"
                >
                    Nuevo Producto
                </n-button>
            </n-space>

            <n-grid cols="1 740:2 1024:3" :x-gap="20" :y-gap="20">
                <n-grid-item v-for="(item, index) in productos" :key="index">
                    <n-card :title="item.detalle">
                        <template #cover>
                            <n-carousel
                                draggable
                                effect="custom"
                                :transition-props="{ name: 'creative' }"
                                show-arrow
                                style="width: 100%; height: 240px"
                            >
                                <img
                                    v-for="item in item.imagenes"
                                    class="carousel-img"
                                    :src="item"
                                />
                            </n-carousel>
                        </template>

                        <template #header-extra>
                            <n-button-group>
                                <n-button secondary size="small" type="error">
                                    <n-icon>
                                        <Trash />
                                    </n-icon>
                                </n-button>

                                <n-button secondary size="small">
                                    <n-icon>
                                        <Pencil />
                                    </n-icon>
                                </n-button>

                                <n-button
                                    secondary
                                    size="small"
                                    @click="
                                        (detalleModal = !detalleModal),
                                            (detalleProducto = item)
                                    "
                                >
                                    <n-icon>
                                        <Add />
                                    </n-icon>
                                </n-button>
                            </n-button-group>
                        </template>
                        {{ item.descripcion }}
                    </n-card>
                </n-grid-item>
            </n-grid>

            <n-modal v-model:show="detalleModal">
                <n-card
                    style="width: 600px"
                    :title="detalleProducto.detalle"
                    :bordered="false"
                    size="huge"
                    role="dialog"
                    aria-modal="true"
                >
                    <n-grid cols="2 300:3" :y-gap="20">
                        <n-gi>
                            <n-statistic
                                label="Marca"
                                :value="detalleProducto.marca"
                            />
                        </n-gi>
                        <n-gi>
                            <n-statistic
                                label="Modelo"
                                :value="detalleProducto.modelo"
                            />
                        </n-gi>
                        <n-gi>
                            <n-statistic
                                label="Categoria"
                                :value="detalleProducto.categoria"
                            />
                        </n-gi>
                        <n-gi>
                            <n-statistic
                                label="Tipo"
                                :value="detalleProducto.tipo"
                            />
                        </n-gi>
                        <n-gi>
                            <n-statistic
                                label="Combustible"
                                :value="detalleProducto.combustible"
                            />
                        </n-gi>
                        <n-gi>
                            <n-statistic
                                label="Cilindrada"
                                :value="detalleProducto.cilindrada"
                            />
                        </n-gi>
                        <n-gi>
                            <n-statistic
                                label="Puertas"
                                :value="detalleProducto.puertas"
                            />
                        </n-gi>
                        <n-gi>
                            <n-statistic
                                label="Capacidad"
                                :value="detalleProducto.capacidad"
                            />
                        </n-gi>

                        <n-gi>
                            <n-statistic
                                label="Aire Acon."
                                :value="
                                    detalleProducto.aire_acondicionado
                                        ? 'SI'
                                        : 'NO'
                                "
                            />
                        </n-gi>

                        <n-gi>
                            <n-statistic
                                label="Equipaje."
                                :value="detalleProducto.equipaje"
                            />
                        </n-gi>
                    </n-grid>
                    <template #action>
                        <div v-html="detalleProducto.contenido"></div>
                    </template>
                </n-card>
            </n-modal>

            <!-- <n-table :bordered="false" :single-line="false">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Detalle</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Tipo</th>
                        <th>Conbustible</th>
                        <th>Categoria</th>
                        <th>Cilindrada</th>
                        <th>Puertas</th>
                        <th>Capacidad</th>
                        <th>Aire Acont.</th>
                        <th>Equipaje</th>
                        <th>Descripcon</th>
                        <th>Fotos</th>
                        <th>OP</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in productos">
                        <td>{{ item.id }}</td>
                        <td>{{ item.detalle }}</td>
                        <td>{{ item.marca }}</td>
                        <td>{{ item.modelo }}</td>
                        <td>{{ item.tipo }}</td>
                        <td>{{ item.combustible }}</td>
                        <td>{{ item.categoria }}</td>
                        <td>{{ item.cilindrada }}</td>
                        <td>{{ item.puertas }}</td>
                        <td>{{ item.capacidad }}</td>
                        <td>{{ item.aire_acondicionado }}</td>
                        <td>{{ item.equipaje }}</td>
                        <td>{{ item.descripcion }}</td>
                        <td>-</td>
                        <td style="width: 180px">
                            <n-space justify="end">
                                <FormularioProductoComponent
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
            </n-table> -->
        </div>
    </AdminLayout>
</template>
<script setup>
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import FormularioProductoComponent from "./Components/FormularioProductoComponent.vue";
import { ref } from "vue";
import { Add, Pencil, Trash } from "@vicons/ionicons5";

const props = defineProps({
    productos: Array,
});

const detalleModal = ref(false);
const detalleProducto = ref({});

const eliminar = (id) => {
    console.log("eliminar " + id);
};

const editar = () => {
    console.log("editar");
};

const eliminarUsuario = (id) => {
    router.delete("/admin/productos/" + id);
};
</script>
<style scoped>
.carousel-img {
    width: 100%;
    height: 240px;
    object-fit: cover;
}

:deep(.creative-enter-from),
:deep(.creative-leave-to) {
    opacity: 0;
    transform: scale(0.8);
}

:deep(.creative-enter-active),
:deep(.creative-leave-active) {
    transition: all 0.3s ease;
}
</style>
