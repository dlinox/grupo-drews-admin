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

                <n-form-item path="marca" label="marca">
                    <n-input
                        v-model:value="formData.marca"
                        placeholder="user"
                    />
                </n-form-item>

                <n-form-item path="modelo" label="modelo">
                    <n-input
                        v-model:value="formData.modelo"
                        placeholder="user"
                    />
                </n-form-item>

                <n-form-item path="categoria" label="categoria">
                    <n-input
                        v-model:value="formData.categoria"
                        placeholder="user"
                    />
                </n-form-item>

                <n-form-item path="tipo" label="tipo">
                    <n-input
                        v-model:value="formData.tipo"
                        placeholder="user"
                    />
                </n-form-item>

                <n-form-item path="combustible" label="combustible">
                    <n-input
                        v-model:value="formData.combustible"
                        placeholder="user"
                    />
                </n-form-item>

                <n-form-item path="cilindrada" label="cilindrada">
                    <n-input
                        v-model:value="formData.cilindrada"
                        placeholder="user"
                    />
                </n-form-item>

                <n-form-item path="puertas" label="puertas">
                    <n-input
                        v-model:value="formData.puertas"
                        placeholder="user"
                    />
                </n-form-item>

                <n-form-item path="capacidad" label="capacidad">
                    <n-input
                        v-model:value="formData.capacidad"
                        placeholder="user"
                    />
                </n-form-item>

                <n-form-item path="aire_acondicionado" label="aire_acondicionado">
                    <n-input
                        v-model:value="formData.aire_acondicionado"
                        placeholder="user"
                    />
                </n-form-item>

                <n-form-item path="equipaje" label="equipaje">
                    <n-input
                        v-model:value="formData.equipaje"
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
    marca: "",
    modelo: "",
    categoria: "",
    tipo: "",
    combustible: "",
    cilindrada: "",
    puertas: "",
    capacidad: "",
    aire_acondicionado: "",
    equipaje: "",
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
        formData.marca = props.data.marca;
        formData.modelo = props.data.modelo;
        formData.categoria = props.data.categoria;
        formData.tipo = props.data.tipo;
        formData.combustible = props.data.combustible;
        formData.cilindrada = props.data.cilindrada;
        formData.puertas = props.data.puertas;
        formData.capacidad = props.data.capacidad;
        formData.aire_acondicionado = props.data.aire_acondicionado;
        formData.equipaje = props.data.equipaje;
    }
});

const rules = {
    detalle: {
        required: true,
        message: "Obligaorio",
        trigger: ["input", "blur"],
    },
    marca: {
        required: true,
        message: "Obligaorio",
        trigger: ["input", "blur"],
    },
    modelo: {
        required: true,
        message: "Obligaorio",
        trigger: ["input", "blur"],
    },
    tipo: {
        required: true,
        message: "Obligaorio",
        trigger: ["input", "blur"],
    },
    categoria: {
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
    formData.post("/admin/productos", {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                message.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: () => {
            showModal.value = false;
            message.success("Productos creado");
            formData.reset();
        },
    });
};

const editar = () => {
    formData.put("/admin/productos/" + props.data?.id, {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                message.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: () => {
            showModal.value = false;
            message.success("Productos editado");
            formData.reset();
        },
    });
};
</script>
