<template>
    <n-space justify="end" style="margin-bottom: 10px">
        <n-button :type="edit ? '' : 'primary'" @click="showModal = true">
            {{ btn_text }}
        </n-button>
    </n-space>

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
                            />
                        </n-form-item>
                    </n-grid-item>
                    <n-grid-item>
                        <n-form-item path="num_doc" label="N° Documento">
                            <n-input
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
                                v-model:value="formData.r_social"
                                placeholder="clientse"
                            />
                        </n-form-item>
                    </n-grid-item>

                    <n-grid-item>
                        <n-form-item path="nombre" label="Nombre">
                            <n-input
                                v-model:value="formData.nombre"
                                placeholder="clientse"
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
                        <n-form-item path="publico" label="Sitio web">
                            <n-switch v-model:value="formData.publico" />
                        </n-form-item>
                    </n-grid-item>

                    <n-grid-item>
                        <upload-image-component
                            v-model="formData.logo"
                            @preview-result="preview_img = $event"
                        >
                        </upload-image-component>
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
import { useMessage } from "naive-ui";
import UploadImageComponent from "@/components/UploadImageComponent.vue";

const onlyAllowNumber = (value) => !value || /^\d+$/.test(value);

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
    data: Object,
    edit: {
        type: Boolean,
        default: false,
    },
});

const formRef = ref(null);
const message = useMessage();

const showModal = ref(false);

const formData = useForm({
    r_social: null,
    num_doc: null,
    tipo_doc: null,
    nombre: null,
    apellidos: null,
    logo: null,
    web: null,
    publico: true,
});

const preview_img = ref(null);

watch(showModal, (val) => {
    // console.log(data);
    if (val == false) {
        formData.reset();
        return;
    }

    if (props.edit) {
        formData.detalle = props.data.detalle;
    }
});

const rules = {
    detalle: {
        required: true,
        message: "Obligaorio",
        trigger: ["input", "blur"],
    },
    descripcion: {
        required: true,
        message: "Obligaorio",
        trigger: ["input", "blur"],
    },
    figura: {
        required: true,
        message: "Obligaorio",
        trigger: ["input", "blur"],
    },
};

const submit = async (e) => {
    e.preventDefault();

    await formRef.value?.validate(async (errors) => {
        if (!errors) {
            if (props.edit) {
                editar();
            } else {
                crear();
            }
        } else {
            console.log(errors);
            message.error("Datos ingresado no validos");
        }
    });
};

const crear = () => {
    formData.post("/admin/clientes", {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                message.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: () => {
            showModal.value = false;
            message.success("Servicios creado");
            formData.reset();
        },
    });
};

const editar = () => {
    formData.put("/admin/clientes/" + props.data?.id, {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                message.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: () => {
            showModal.value = false;
            message.success("Servicios editado");
            formData.reset();
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
