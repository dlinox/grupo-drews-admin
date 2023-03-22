<template>
    <div class="form-wrapper">
        <div class="row form-web-cotizacion">
            <div class="col-12 col-md-6">
                <n-form-item path="nombres" label="Nombres">
                    <n-input
                        v-model:value="formData.nombres"
                        placeholder="Nombre"
                    />
                </n-form-item>
            </div>
            <div class="col-12 col-md-6">
                <n-form-item path="apellidos" label="apellidos">
                    <n-input
                        v-model:value="formData.apellidos"
                        placeholder="apellidos"
                    />
                </n-form-item>
            </div>
            <div class="col-12 col-md-6">
                <n-form-item path="correo" label="Correo">
                    <n-input
                        v-model:value="formData.correo"
                        placeholder="Correo"
                    />
                </n-form-item>
            </div>
            <div class="col-12 col-md-6">
                <n-form-item path="celular" label="Celular">
                    <n-input
                        v-model:value="formData.celular"
                        placeholder="Celular"
                    />
                </n-form-item>
            </div>

            <div class="col-12">
                <n-form-item path="sede" label="Mensaje">
                    <n-input
                        type="textarea"
                        v-model:value="formData.mensaje"
                        placeholder="Mensaje"
                    />
                </n-form-item>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button @click="enviarCotizacion" class="btn btn-color1">
                    <i class="fa-solid fa-paper-plane"></i>
                    <template v-if="formData.processing">
                        Procesando ...
                    </template>
                    <template v-else> Enviar </template>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { NDatePicker } from "naive-ui";
import { useToast } from "vue-toastification";
const toast = useToast();

const props = defineProps({
    producto: Number,
    tipo: String,
});

const formData = useForm({
    nombres: null,
    apellidos: null,
    correo: null,
    celular: null,
    mensaje: null,
});

const enviarCotizacion = () => {
    console.log(formData);

    formData.post("/msg-contacto", {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                toast.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: () => {
            console.log("enviado");
            toast.success("Enviado");
            formData.reset();
        },
    });
};
</script>

<style lang="scss">
.form-wrapper {
    font-family: $font-raj;
}
</style>
