<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent :title="'Servicios - ' + text_form" />

            <n-card class="mt-1">
                <n-form ref="formRef" :model="formData" :rules="rules">
                    <n-grid cols="1 600:5" :x-gap="20" :y-gap="20">
                        <n-grid-item span="1  600:3">
                            <n-form-item path="titulo" label="titulo">
                                <n-input
                                    v-model:value="formData.titulo"
                                    placeholder="Corporativo"
                                />
                            </n-form-item>

                            <n-form-item path="descripcion" label="Descripción">
                                <n-input
                                    type="textarea"
                                    v-model:value="formData.descripcion"
                                    placeholder="Descripción corta..."
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
                        </n-grid-item>
                        <n-grid-item span="1  600:2">
                            <n-card>
                                <n-form-item path="figura" label="Icono">
                                    <n-input
                                        v-model:value="formData.figura"
                                        placeholder="fa-light fa-bell-concierge"
                                    >
                                        <template #prefix>
                                           <i :class="formData.figura"></i>
                                        </template>
                                    </n-input>

                                    <IconsComponent
                                        @iconSelected="formData.figura = $event"
                                    />
                                </n-form-item>

                                <n-form-item label="Imagenes">
                                    <n-space vertical>
                                        <n-card
                                            v-for="(item, index) in 3"
                                            :key="index"
                                        >
                                            <n-space>
                                                <n-form-item
                                                    :path="`imagenes[${index}]`"
                                                    :label="
                                                        'Imagen ' + (index + 1)
                                                    "
                                                    :rule="{
                                                        required: servicio.id
                                                            ? false
                                                            : true,
                                                        message: `Imagen ${
                                                            index + 1
                                                        } obligatorio`,
                                                    }"
                                                >
                                                    <CropCompressImageComponent
                                                        @onCropper="
                                                            (blob_imgs[index] =
                                                                $event.blob),
                                                                file_imgs.push(
                                                                    $event.file
                                                                )
                                                        "
                                                    />
                                                </n-form-item>

                                                <n-image
                                                    :src="blob_imgs[index]"
                                                    width="100"
                                                />
                                            </n-space>
                                        </n-card>
                                    </n-space>
                                </n-form-item>

                                <n-button
                                    @click="submit"
                                    type="primary"
                                    :loading="formData.processing"
                                >
                                    {{ text_btn }}
                                </n-button>
                            </n-card>
                        </n-grid-item>
                    </n-grid>
                </n-form>
            </n-card>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import CropCompressImageComponent from "../../../Components/CropCompressImageComponent.vue";

import { useToast } from "vue-toastification";
import IconsComponent from "../../../Components/IconsComponent.vue";
const toast = useToast();

const props = defineProps({
    servicio: {
        type: Object,
        default: {
            titulo: null, //titulo
            descripcion: null, //descripcon corta
            contenido: null, //descripcon larga
            figura: null,
            imagenes: null,
            detalles: [{ titulo: "", descripcion: "" }],
        },
    },
});

const text_form = computed(() => (props.servicio.id ? "Editar" : "Crear"));
const text_btn = computed(() => (props.servicio.id ? "Actualizar" : "Guardar"));

const formRef = ref(null);

//const imagenes = ref(props.servicio.imagenes ?? []);

const formData = useForm({ ...props.servicio });

/*************************** */
const blob_imgs = ref(props.servicio.imagenes ?? [null, null, null]);
const file_imgs = ref([]);
/*************************** */

const rules = {
    titulo: {
        required: true,
        message: "Titulo obligatorio",
        trigger: ["input", "blur"],
    },
    figura: {
        required: true,
        message: "Icono obligatorio",
        trigger: ["input", "blur"],
    },
    descripcion: {
        required: true,
        message: "Descripción obligatorio",
        trigger: ["input", "blur"],
    },
};

const submit = async () => {
    formData.imagenes = file_imgs.value;
    console.log(formData.imagenes);
    // return;

    await formRef.value?.validate((errors) => {
        if (!errors) {
            console.log(formData);
            if (props.servicio.id) {
                console.log("editar");
                editar();
            } else {
                console.log("nuevo");
                guardar();
            }
        } else {
            errors.forEach((element) => {
                console.log(element);

                element.forEach((item) => {
                    toast.error(item.message);
                });
            });
        }
    });
};

const guardar = () => {
    formData.post("/admin/servicios", {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                toast.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: (e) => {
            console.log(e);
            toast.success("Servicio creado");
            formData.reset();
        },
    });
};

const editar = () => {
    formData
        .transform((data) => ({
            ...data,
            imagenes:
                data.imagenes == props.servicio.imagenes ? null : data.imagenes,
        }))
        .post("/admin/servicios", {
            preserveScroll: true,
            onError: (e) => {
                for (const property in e) {
                    toast.error(e[property]);
                }
                console.log(e);
            },
            onSuccess: (e) => {
                console.log(e);
                toast.success("Servicio actualizado");
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
