<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Productos - Nuevo" />
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

                            <n-grid
                                cols="1 300:2 600:3  800:4"
                                :x-gap="10"
                                :y-gap="0"
                            >
                                <n-grid-item>
                                    <n-form-item path="marca" label="marca">
                                        <n-input
                                            v-model:value="formData.marca"
                                            placeholder="marca"
                                        />
                                    </n-form-item>
                                </n-grid-item>

                                <n-grid-item>
                                    <n-form-item path="modelo" label="modelo">
                                        <n-input
                                            v-model:value="formData.modelo"
                                            placeholder="modelo"
                                        />
                                    </n-form-item>
                                </n-grid-item>

                                <n-grid-item>
                                    <n-form-item
                                        path="categoria"
                                        label="categoria"
                                    >
                                        <n-select
                                            label-field="detalle"
                                            value-field="detalle"
                                            v-model:value="formData.categoria"
                                            :options="categorias"
                                        />
                                    </n-form-item>
                                </n-grid-item>

                                <n-grid-item>
                                    <n-form-item
                                        path="combustible"
                                        label="combustible"
                                    >
                                        <n-input
                                            v-model:value="formData.combustible"
                                            placeholder="combustible"
                                        />
                                    </n-form-item>
                                </n-grid-item>

                                <n-grid-item>
                                    <n-form-item path="puertas" label="puertas">
                                        <n-input-number
                                            v-model:value="formData.puertas"
                                            clearable
                                            :min="1"
                                            placeholder="puertas"
                                        />
                                    </n-form-item>
                                </n-grid-item>

                                <n-grid-item>
                                    <n-form-item
                                        path="capacidad"
                                        label="capacidad"
                                    >
                                        <n-input-number
                                            :min="1"
                                            v-model:value="formData.capacidad"
                                            placeholder="capacidad"
                                        />
                                    </n-form-item>
                                </n-grid-item>

                                <n-grid-item>
                                    <n-form-item
                                        path="equipaje"
                                        label="equipaje"
                                    >
                                        <n-input-number
                                            :min="1"
                                            v-model:value="formData.equipaje"
                                            placeholder="equipaje"
                                        />
                                    </n-form-item>
                                </n-grid-item>

                                <n-grid-item>
                                    <n-form-item
                                        path="aire_acondicionado"
                                        label="aire acondicionado"
                                    >
                                        <n-switch
                                            v-model:value="
                                                formData.aire_acondicionado
                                            "
                                        />
                                    </n-form-item>
                                </n-grid-item>
                            </n-grid>

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

const props = defineProps({
    producto: Object,
    categorias: Array,
});

const formRef = ref(null);

const imagenes = ref([]);

const formData = useForm({
    detalle: null,
    descripcion: null,
    marca: null,
    modelo: null,
    categoria: null,
    tipo: null,
    combustible: null,
    cilindrada: null,
    puertas: null,
    capacidad: null,
    aire_acondicionado: null,
    equipaje: null,
    imagenes: null,
    contenido: "",
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

    formData.post("/admin/productos", {
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

<style>
.n-form-item-label__text {
    text-transform: capitalize;
}

.n-input__placeholder {
    text-transform: capitalize;
}
</style>
