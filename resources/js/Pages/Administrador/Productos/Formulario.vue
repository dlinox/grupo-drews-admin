<template>
    <AdminLayout>
        
        <div class="container">
            <PageHeaderComponent title="Productos - Nuevo" />
            <n-divider />
            <n-card>
                <n-form ref="formRef" :model="formData" :rules="rules">
                    <n-grid cols="1 600:3" :x-gap="20" :y-gap="20">
                        <n-grid-item span="1  600:2">
                            <div class="light-green">
                                <n-form-item
                                    path="tipo_v"
                                    label="Tipo de vihiculo"
                                >
                                    <n-radio-group
                                        v-model:value="formData.tipo_v"
                                    >
                                        <n-space>
                                            <n-radio value="Empresa">
                                                Empresa
                                            </n-radio>
                                            <n-radio value="Particular">
                                                Particular
                                            </n-radio>
                                        </n-space>
                                    </n-radio-group>
                                </n-form-item>

                                <n-form-item path="detalle" label="Detalle">
                                    <n-input
                                        v-model:value="formData.detalle"
                                        placeholder="Corporativo"
                                    />
                                </n-form-item>

                                <n-form-item
                                    path="descripcion"
                                    label="Descripción"
                                >
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
                                        <n-form-item
                                            path="modelo"
                                            label="modelo"
                                        >
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
                                                v-model:value="
                                                    formData.categoria
                                                "
                                                :options="categorias"
                                                placeholder="Seleccione uno"
                                            />
                                        </n-form-item>
                                    </n-grid-item>

                                    <n-grid-item>
                                        <n-form-item path="tipo" label="Tipo">
                                            <n-select
                                                label-field="detalle"
                                                value-field="detalle"
                                                v-model:value="formData.tipo"
                                                :options="tipos"
                                                placeholder="Seleccione uno"
                                            />
                                        </n-form-item>
                                    </n-grid-item>

                                    <n-grid-item>
                                        <n-form-item
                                            path="combustible"
                                            label="combustible"
                                        >
                                            <n-select
                                                label-field="detalle"
                                                value-field="detalle"
                                                v-model:value="
                                                    formData.combustible
                                                "
                                                :options="combustibles"
                                                placeholder="Seleccione uno"
                                            />
                                        </n-form-item>
                                    </n-grid-item>

                                    <n-grid-item>
                                        <n-form-item
                                            path="puertas"
                                            label="puertas"
                                        >
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
                                                v-model:value="
                                                    formData.capacidad
                                                "
                                                placeholder="capacidad"
                                            />
                                        </n-form-item>
                                    </n-grid-item>

                                    <n-grid-item>
                                        <n-form-item
                                            path="carga"
                                            label="Carga Maxima"
                                        >
                                            <n-input-number
                                                :min="1"
                                                v-model:value="
                                                    formData.equipaje
                                                "
                                                placeholder="Carga Maxima"
                                            />
                                        </n-form-item>
                                    </n-grid-item>

                                    <n-grid-item>
                                        <n-form-item
                                            path="aire_acondicionado"
                                            label="aire acondicionado"
                                        >
                                            <n-switch
                                                v-model:value="formData.aire_acondicionado"
                                            />
                                        </n-form-item>
                                    </n-grid-item>

                                    <template
                                        v-if="formData.tipo_v == 'Empresa'"
                                    >
                                        <n-grid-item
                                            span="1 300:2 600:3  800:4"
                                        >
                                            <n-form-item
                                                path="seguridad"
                                                label="Implementos de seguridad"
                                            >
                                                <n-dynamic-input
                                                    v-model:value="
                                                        formData.seguridad
                                                    "
                                                    placeholder="Implementos de seguridad"
                                                    show-sort-button
                                                    :min="1"
                                                    :max="15"
                                                />
                                            </n-form-item>
                                        </n-grid-item>
                                    </template>
                                </n-grid>
                            </div>
                        </n-grid-item>
                        <n-grid-item span="1  600:1">
                            <n-card embedded>
                                <n-form-item path="imagenes" label="Imagenes">
                                    <n-space vertical>
                                        <n-card
                                            v-for="(item, index) in num_imgs"
                                            :key="index"
                                        >
                                            <n-space>
                                                <n-form-item
                                                    :path="`imagenes[${index}]`"
                                                    :label="
                                                        'Imagen ' + (index + 1)
                                                    "
                                                    :rule="{
                                                        required: producto.id
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
                                                    width="120"
                                                />

                                                <n-button
                                                    :disabled="
                                                        num_imgs == 1
                                                            ? true
                                                            : false
                                                    "
                                                    @click="
                                                        num_imgs--,
                                                            blob_imgs.splice(
                                                                index,
                                                                1
                                                            ),
                                                            file_imgs.splice(
                                                                index,
                                                                1
                                                            )
                                                    "
                                                    secondary
                                                    type="error"
                                                >
                                                    -
                                                </n-button>
                                            </n-space>
                                        </n-card>

                                        <n-button @click="num_imgs++">
                                            Agregar Imagen
                                        </n-button>
                                    </n-space>
                                </n-form-item>
                                <n-button @click="guardar" type="primary">
                                    Guardar
                                </n-button>
                            </n-card>
                        </n-grid-item>
                    </n-grid>
                </n-form>
            </n-card>
        </div>

        <pre>
            {{ formData }}
        </pre>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";

import CropCompressImageComponent from "../../../Components/CropCompressImageComponent.vue";
import { useToast } from "vue-toastification";
const toast = useToast();

const props = defineProps({
    producto: {
        type: Object,
        default: {
            tipo_v: "Empresa",
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
            aire_acondicionado: false,
            equipaje: null,
            imagenes: null,
            seguridad: null,
        },
    },
    categorias: Array,
});

const tipos = [{ detalle: "Manual" }, { detalle: "Automatico" }];

const combustibles = [{ detalle: "Gasolina" }, { detalle: "Diesel" }];

const formRef = ref(null);

const formData = useForm({ ...props.producto });

/*************************** */
const num_imgs = ref(props.producto.imagenes?.length ?? 1);

const blob_imgs = ref(props.producto.imagenes ?? []);
const file_imgs = ref([]);

/*************************** */

const rules = {
    detalle: {
        required: true,
        message: "Titulo obligatorio",
        trigger: ["input", "blur"],
    },
    marca: {
        required: true,
        message: "Marca obligatorio",
        trigger: ["input", "blur"],
    },
    modelo: {
        required: true,
        message: "Modelo obligatorio",
        trigger: ["input", "blur"],
    },

    categoria: {
        required: true,
        message: "Categoria obligatorio",
        trigger: ["input", "blur"],
    },

    tipo: {
        required: true,
        message: "Tipo obligatorio",
        trigger: ["input", "blur"],
    },


};

const guardar = async () => {
    formData.imagenes = file_imgs.value;

    await formRef.value?.validate((errors) => {
        if (!errors) {
            formData.post("/admin/productos", {
                preserveScroll: true,
                onError: (e) => {
                    for (const property in e) {
                        console.log(e[property]);
                        toast.error(e[property]);
                    }
                    console.log(e);
                },
                onSuccess: (e) => {
                    console.log(e);
                    toast.success(
                        props.producto?.id
                            ? "Producto actualizado"
                            : "Producto Creado"
                    );
                    formData.reset();
                },
            });
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
</script>

<style>
.n-form-item-label__text {
    text-transform: uppercase;
}

.n-input__placeholder {
    text-transform: capitalize;
}
</style>
