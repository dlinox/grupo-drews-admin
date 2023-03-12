<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Servicios - Nuevo" />
            <n-divider />

            <n-form ref="formRef" :model="formData">
                <n-grid cols="1 600:3" :x-gap="20" :y-gap="20">
                    <n-grid-item span="1  600:2">
                        <div class="light-green">
                            <n-form-item path="titulo" label="Detalle">
                                <n-input
                                    v-model:value="formData.titulo"
                                    placeholder="Corporativo"
                                />
                            </n-form-item>
                            <n-form-item path="figura" label="Icono">
                                <n-input
                                    v-model:value="formData.figura"
                                    placeholder="fa-light fa-bell-concierge"
                                />
                            </n-form-item>
                            <n-form-item path="descripcion" label="Descripción">
                                <n-input
                                    type="textarea"
                                    v-model:value="formData.descripcion"
                                    placeholder="Contamos con una variedad..."
                                />
                            </n-form-item>

                            <n-table
                                :bordered="false"
                                :single-line="true"
                                size="small"
                            >
                                <thead>
                                    <tr>
                                        <th>Detalles</th>
                                        <th style="width: 100px">
                                            <n-space justify="end">
                                                <n-button
                                                    @click="agregarDetalle"
                                                >
                                                    Agregar
                                                </n-button>
                                            </n-space>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(
                                            item, index
                                        ) in formData.detalles"
                                        :key="index"
                                    >
                                        <td>
                                            <n-form-item
                                                :label="`Tiotulo ${index + 1}`"
                                                :path="`detalles[${index}].titulo`"
                                                :rule="{
                                                    required: true,
                                                    message: 'Obligatorio',
                                                    trigger: ['input', 'blur'],
                                                }"
                                            >
                                                <n-input
                                                    v-model:value="item.titulo"
                                                    clearable
                                                />
                                            </n-form-item>

                                            <n-form-item
                                                :label="`Descripcion ${
                                                    index + 1
                                                }`"
                                                :path="`detalles[${index}].descripcion`"
                                                :rule="{
                                                    required: true,
                                                    message: 'Obligatorio',
                                                    trigger: ['input', 'blur'],
                                                }"
                                            >
                                                <n-input
                                                    type="textarea"
                                                    v-model:value="
                                                        item.descripcion
                                                    "
                                                    clearable
                                                />
                                            </n-form-item>
                                        </td>
                                        <td>
                                            <n-space justify="end">
                                                <n-button
                                                    @click="
                                                        quitarDetalle(index)
                                                    "
                                                >
                                                    Quitar
                                                </n-button>
                                            </n-space>
                                        </td>
                                    </tr>
                                </tbody>
                            </n-table>

                            <!--                                 
                                Contenido
                                <QuillEditor
                                    theme="snow"
                                    v-model:content="formData.contenido"
                                    contentType="html"
                                /> -->
                        </div>
                    </n-grid-item>
                    <n-grid-item span="1  600:1">
                        <n-card embedded>
                            <n-form-item path="imagen" label="Imagenes">
                                <input
                                    @change="previsualizarImagenes"
                                    @input="
                                        formData.imagenes = $event.target.files
                                    "
                                    :multiple="true"
                                    :showUploadButton="false"
                                    accept="image/*"
                                    type="file"
                                    :maxFileSize="3000000"
                                    :maxFile="3"
                                />
                            </n-form-item>

                            <n-space size="large">
                                <n-image
                                    v-for="(item, index) in imagenes"
                                    :key="index"
                                    width="100"
                                    :src="item"
                                />
                            </n-space>

                            <n-button @click="guardar" type="primary">
                                Guardar
                            </n-button>
                        </n-card>
                    </n-grid-item>
                </n-grid>
            </n-form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import { QuillEditor } from "@vueup/vue-quill";
const formRef = ref(null);

const imagenes = ref([]);
const formData = useForm({
    titulo: "", //titulo
    descripcion: "", //descripcon corta
    contenido: "", //descripcon larga
    figura: "",
    imagenes: "",
    detalles: [{ titulo: "", descripcion: "" }],
});

const previsualizarImagenes = (e) => {
    imagenes.value = [];
    let files = e.target;

    for (let i = 0; i < files.files.length; i++) {
        let file = files.files[i];

        let objectURL = URL.createObjectURL(file);

        imagenes.value.push(objectURL);
    }

    console.log(imagenes);
};

const guardar = () => {
    console.log(formData);

    formData.post("/admin/servicios", {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                console.log(e[property]);
            }
            console.log(e);
        },
        onSuccess: (e) => {
            console.log(e);
            console.log("creado");
            formData.reset();
        },
    });
};

const agregarDetalle = () => {
    formData.detalles.push({ titulo: "", descripcion: "" });
};

const quitarDetalle = (index) => {
    formData.detalles.splice(index, 1);
};
</script>
