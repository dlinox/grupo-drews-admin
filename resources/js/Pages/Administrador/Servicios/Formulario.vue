<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Servicios - Nuevo" />
            <n-divider />

            <n-form ref="formRef" :model="formData">
                <n-grid cols="1 600:3" :x-gap="20" :y-gap="20">
                    <n-grid-item span="1  600:2">
                        <div class="light-green">
                            <n-form-item path="detalle" label="Detalle">
                                <n-input
                                    v-model:value="formData.detalle"
                                    placeholder="Corporativo"
                                />
                            </n-form-item>

                            <n-form-item path="descripcion" label="Descripción">
                                <n-input
                                    type="textarea"
                                    v-model:value="formData.descripcion"
                                    placeholder="Contamos con una variedad..."
                                />
                            </n-form-item>

                            Contenido
                            <QuillEditor
                                theme="snow"
                                v-model:content="formData.contenido"
                                contentType="html"
                            />
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
    detalle: "", //titulo
    descripcion: "", //descripcon corta
    contenido: "", //descripcon larga
    figura: "",
    imagenes: "",
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
</script>
