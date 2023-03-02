<template>
    <n-space justify="end" style="margin-bottom: 10px">
        <n-button :type="edit ? '' : 'primary'" @click="showModal = true">
            {{ btn_text }}
        </n-button>
    </n-space>

    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px"
            :title="edit ? 'Editar Servicio' : 'Nuevo Servicio'"
            :bordered="false"
            role="dialog"
            aria-modal="true"
        >
            <n-form ref="formRef" :model="formData" :rules="rules">
                <n-form-item path="detalle" label="Detalle">
                    <n-input
                        v-model:value="formData.detalle"
                        placeholder="Corporativo"
                    />
                </n-form-item>

                <n-form-item path="figura" label="Figura">
                    <n-input
                        v-model:value="formData.figura"
                        placeholder="user"
                    />
                </n-form-item>

                <n-form-item path="descripcion" label="Descripcion">
                    <n-input
                        type="textarea"
                        v-model:value="formData.descripcion"
                        placeholder="Contamos con una variedad..."
                    />
                </n-form-item>

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
    detalle: "",
    descripcion: "",
    figura: "",
});

watch(showModal, (val) => {
    // console.log(data);
    if (val == false) {
        formData.reset();
        return;
    }

    if (props.edit) {
        formData.detalle = props.data.detalle;
        formData.descripcion = props.data.descripcion;
        formData.figura = props.data.figura;
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
    formData.post("/admin/servicios", {
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
    formData.put("/admin/servicios/" + props.data?.id, {
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
