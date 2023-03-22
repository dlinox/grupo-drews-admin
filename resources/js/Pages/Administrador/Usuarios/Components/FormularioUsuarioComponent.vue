<template>
    <n-button :type="edit ? '' : 'primary'" @click="showModal = true">
        <template #icon>
            <n-icon>
                <template v-if="edit">
                    <Pencil />
                </template>
                <template v-else>
                    <Add />
                </template>
            </n-icon>
        </template>
        {{ btn_text }}
    </n-button>

    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px"
            :title="edit ? 'Editar Usuario' : 'Nuevo Usuario'"
            :bordered="false"
            role="dialog"
            aria-modal="true"
        >
            <n-form ref="formRef" :model="formData" :rules="rules">
                <n-form-item path="name" label="Nombre">
                    <n-input
                        v-model:value="formData.name"
                        placeholder="Nombre completo"
                    />
                </n-form-item>

                <n-form-item path="email" label="Correo">
                    <n-input
                        v-model:value="formData.email"
                        placeholder="correo electronico"
                    />
                </n-form-item>

                <template v-if="!edit">
                    <n-form-item path="password" label="Contraseña">
                        <n-input
                            type="password"
                            v-model:value="formData.password"
                            placeholder="Contraseña"
                            show-password-on="mousedown"
                        />
                    </n-form-item>
                </template>

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

import { useToast } from "vue-toastification";
import { Add, Pencil } from "@vicons/ionicons5";
const toast = useToast();

const props = defineProps({
    btn_text: String,
    data: Object,
    edit: {
        type: Boolean,
        default: false,
    },
});

const formRef = ref(null);

const showModal = ref(false);

const formData = useForm({
    name: "",
    email: "",
    password: "",
});

watch(showModal, (val) => {
    // console.log(data);
    if (val == false) {
        formData.reset();
        return;
    }

    if (props.edit) {
        formData.name = props.data.name;
        formData.email = props.data.email;
    }
});

const ruleEamil = {
    type: "email",
    required: true,
    message: "Correo no valido",
    trigger: ["input", "blur"],
};

const rules = {
    name: {
        required: true,
        message: "Obligaorio",
        trigger: ["input", "blur"],
    },
    email: {
        type: "email",
        required: true,
        message: "Correo no valido",
        trigger: ["input", "blur"],
    },
    password: {
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
            toast.error("Datos ingresado no validos");
        }
    });
};

const crear = () => {
    formData.post("/admin/usuarios", {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                toast.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: () => {
            showModal.value = false;
            toast.success("Usuario creado");
            formData.reset();
        },
    });
};

const editar = () => {
    formData.put("/admin/usuarios/" + props.data?.id, {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                toast.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: () => {
            showModal.value = false;
            toast.success("Usuario editado");
            formData.reset();
        },
    });
};
</script>
