<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Productos" />

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
                        @click="() => router.get('/admin/productos/create')"
                    >
                        Nuevo Producto
                    </n-button>
                </n-space>
            </n-card>

            <n-grid
                cols="1 740:2 1024:3"
                :x-gap="20"
                :y-gap="20"
                style="margin: 1rem 0"
            >
                <n-grid-item
                    v-for="(item, index) in productos.data"
                    :key="index"
                >
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
                                <n-popconfirm
                                    :show-icon="false"
                                    negative-text="No"
                                    positive-text="Si"
                                    @positive-click="eliminarProducto(item.id)"
                                >
                                    <template #activator>
                                        <n-button
                                            secondary
                                            size="small"
                                            type="error"
                                        >
                                            <n-icon>
                                                <Trash />
                                            </n-icon>
                                        </n-button>
                                    </template>
                                    ¿ Seguro de eliminar el vehiculo ?
                                </n-popconfirm>

                                <n-button
                                    secondary
                                    size="small"
                                    @click="
                                        router.get(
                                            '/admin/productos/' +
                                                item.id +
                                                '/edit'
                                        )
                                    "
                                >
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
                    <p>
                        {{ detalleProducto.descripcion }}
                    </p>
                    <hr />

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



                    <div v-if="detalleProducto.tipo_v == 'Empresa'">
                        <hr />
                        <h4>Implementos de Seguridad</h4>
                        <div class="row">
                            <div class="col-12">
                                <ul>
                                    <li v-for="j in detalleProducto.seguridad">
                                   
                                        {{ j }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <template #footer>
                        <n-space justify="end">
                            <n-button
                                @click="detalleModal = false"
                                type="error"
                                secondary
                            >
                                Cancelar
                            </n-button>
                        </n-space>
                    </template>
                </n-card>
            </n-modal>

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
import { ref, computed, watch } from "vue";
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import { Add, Pencil, Trash } from "@vicons/ionicons5";

import { useToast } from "vue-toastification";
import { Search } from "@vicons/ionicons5";
import throttle from "lodash/throttle";

const toast = useToast();
const props = defineProps({
    productos: Object,
    filters: Object,
});

const search = ref(props.filters.search);
const page = ref(props.productos.current_page);
const totalPages = computed(() => props.productos.last_page);
const totalResults = computed(() => props.productos.total);

const detalleModal = ref(false);
const detalleProducto = ref({});

watch(
    search,
    throttle((val) => {
        router.get(
            "/admin/productos",
            { search: val },
            {
                preserveState: true,
            }
        );
    }, 600)
);

const goPage = () => {
    if (page.value == props.productos.current_page) return;
    let search_aux = "";
    if (search.value) {
        search_aux = "&search=" + search.value;
    }
    router.visit("/admin/productos?page=" + page.value + search_aux, {
        preserveState: true,
    });
};

const eliminarProducto = (id) => {
    router.delete("/admin/productos/" + id, {
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
