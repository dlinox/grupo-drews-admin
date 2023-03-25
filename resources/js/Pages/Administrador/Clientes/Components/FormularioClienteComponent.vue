<template>
    <n-button :type="edit ? '' : 'primary'" @click="showModal = true">
        {{ btn_text }}
    </n-button>

    <n-modal v-model:show="showModal">
        <n-card
            style="width: 650px"
            :title="edit ? 'Editar Categoria' : 'Nueva Categoria'"
            :bordered="false"
            role="dialog"
            aria-modal="true"
        >
            <n-form ref="formRef" :model="formData" :rules="rules">
                <n-grid cols="1 600:2" :x-gap="20" item-responsive>
                    <n-grid-item>
                        <n-form-item path="tipo_doc" label="Tipo documento">
                            <n-select
                                v-model:value="formData.tipo_doc"
                                :options="ops_tipo_doc"
                                placeholder="Seleccione uno"
                            />
                        </n-form-item>
                    </n-grid-item>
                    <n-grid-item>
                        <n-form-item path="num_doc" label="N° Documento">
                            <n-input
                                :disabled="!formData.tipo_doc"
                                v-model:value="formData.num_doc"
                                placeholder="71822318"
                                :allow-input="onlyAllowNumber"
                                show-count
                            />
                        </n-form-item>
                    </n-grid-item>

                    <n-grid-item span="2">
                        <n-form-item path="r_social" label="Razon social">
                            <n-input
                                :disabled="
                                    formData.tipo_doc == 'RUC' ||
                                    !formData.tipo_doc
                                        ? false
                                        : true
                                "
                                v-model:value="formData.r_social"
                                placeholder="Razon social"
                            />
                        </n-form-item>
                    </n-grid-item>

                    <n-grid-item>
                        <n-form-item path="nombre" label="Nombre">
                            <n-input
                                v-model:value="formData.nombre"
                                placeholder="Nombres"
                            />
                        </n-form-item>
                    </n-grid-item>

                    <n-grid-item>
                        <n-form-item path="apellidos" label="Apellidos">
                            <n-input
                                v-model:value="formData.apellidos"
                                placeholder="Apellidos"
                            />
                        </n-form-item>
                    </n-grid-item>

                    <n-grid-item>
                        <n-form-item path="web" label="Sitio web">
                            <n-input
                                v-model:value="formData.web"
                                placeholder="https://..."
                            />
                        </n-form-item>
                    </n-grid-item>

                    <n-grid-item>
                        <n-form-item path="publico" label="Publico">
                            <n-switch v-model:value="formData.publico" />
                        </n-form-item>
                    </n-grid-item>

                    <n-grid-item>
                        <n-form-item path="logo" label="Logo">
                            <CropCompressImageComponent
                                @onCropper="
                                    (preview_img = $event.blob),
                                        (formData.logo = $event.file)
                                "
                            />
                        </n-form-item>
                    </n-grid-item>

                    <n-grid-item>
                        <n-image
                            v-if="preview_img"
                            width="200"
                            :src="preview_img"
                        />
                    </n-grid-item>
                </n-grid>

                <n-row :gutter="[0, 24]">
                    <n-col :span="24">
                        <div style="display: flex; justify-content: flex-end">
                            <n-button
                                :loading="formData.processing"
                                type="primary"
                                @click="submit"
                            >
                                Guardar
                            </n-button>
                        </div>
                    </n-col>
                </n-row>
            </n-form>
        </n-card>
    </n-modal>
</template>

<script setup>
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";

import CropCompressImageComponent from "@/Components/CropCompressImageComponent.vue";
import { useToast } from "vue-toastification";

import { onlyAllowNumber } from "@/helpers/validaciones";

const toast = useToast();

const ops_tipo_doc = [
    {
        label: "Seleccione un tipo de documento",
        value: null,
        disabled: true,
    },
    {
        label: "DNI",
        value: "DNI",
    },
    {
        label: "RUC",
        value: "RUC",
    },
    {
        label: "CARNE DE EXTRANGERIA",
        value: "CARNE DE EXTRANGERIA",
    },
];

const props = defineProps({
    btn_text: String,
    cliente: {
        type: Object,
        default: {
            r_social: null,
            num_doc: null,
            tipo_doc: null,
            nombre: null,
            apellidos: null,
            logo: null,
            web: null,
            publico: true,
        },
    },

    edit: {
        type: Boolean,
        default: false,
    },
});

const showModal = ref(false);
const preview_img = ref(props.cliente.logo);

const formRef = ref(null);
const formData = useForm({ ...props.cliente });

watch(showModal, (val) => {
    if (val == false) {
        formData.reset();
        return;
    }
    if (props.edit) {
        formData.logo = null;
    }
});

const rules = {
    num_doc: {
        required: formData.tipo_doc ? true : false,
        validator(rule, value) {
            let long =
                formData.tipo_doc == "DNI"
                    ? 8
                    : formData.tipo_doc == "RUC"
                    ? 11
                    : 12;
            if (!value) {
                return true;
            } else if (value.toString().length != long) {
                return new Error("Número de documento invalido");
            }
            return true;
        },

        trigger: ["input", "blur"],
    },
    r_social: {
        required: true,
        message: "Razon social obligatorio",
        trigger: ["input", "blur"],
    },
    logo: {
        required: true,
        message: "Logo  obligaorio",

    },
};

const submit = async (e) => {
    e.preventDefault();

    formData.r_social =
        formData.tipo_doc == "RUC" || !formData.tipo_doc
            ? formData.r_social
            : formData.nombre + " " + formData.apellidos;

    await formRef.value?.validate((errors) => {
        if (!errors) {
            guardar();
        } else {
            console.log(errors);

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
    formData.post("/admin/clientes", {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                toast.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: () => {
            toast.success(
                props.edit ? "Servicios editado" : "Servicios creado"
            );
            formData.reset();
            showModal.value = false;
        },
    });
};
</script>

<style>
.select-picture {
    position: relative;
}

.select-picture input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    font-size: 0;
    cursor: pointer;
    opacity: 0;
}
</style>
