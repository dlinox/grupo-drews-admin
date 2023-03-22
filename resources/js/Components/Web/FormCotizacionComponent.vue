<template>
    <n-form class="form-web-cotizacion">
        <div class="row">
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
                <n-form-item
                    class="w-full"
                    path="rango"
                    label="Lo quiero de - Hasta"
                >
                    <n-date-picker
                        v-model:value="formData.rango"
                        type="daterange"
                        clearable
                    />
                </n-form-item>
            </div>
            <div class="col-12">
                <n-form-item path="sede" label="Lugar de entrega">
                    <n-input
                        v-model:value="formData.sede"
                        placeholder="Lugar de entrega"
                    />
                </n-form-item>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button @click="enviarCotizacion" class="btn btn-color1">
                    <i class="fa-solid fa-paper-plane"></i>
                    <template v-if="formData.processing">
                        Procesando ...
                    </template>
                    <template v-else> Cotizar </template>
                </button>
            </div>
        </div>
    </n-form>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { NDatePicker } from "naive-ui";
import { useToast } from "vue-toastification";
const toast = useToast();


const props = defineProps({
    producto: Number,
    tipo: String
});

const formData = useForm({
    nombres: null,
    apellidos: null,
    correo: null,
    celular: null,
    producto: props.producto,
    rango: null,
    sede: null,
    tipo: props.tipo
});

const enviarCotizacion = () => {
    console.log(formData);

    formData.post("/reservas", {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                toast.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: () => {
            console.log("enviado");
            toast.success('Solicitud Enviada');
            formData.reset();
        },
    });
};
</script>
<style lang="scss">
.form-web-cotizacion {
    .n-date-picker {
        width: 100%;
    }

    .n-form-item-label__text {
        font-family: $font-raj;
    }
    .n-input {
        background-color: white;
        border: 1px solid #eee;
        -webkit-box-shadow: none;
        box-shadow: none;
        padding: 8px 16px;
        font-size: 16px;
        color: #888;
        width: 100%;

        border-radius: 0;
        transition: all 0.2s ease-in;

        .n-input__input {
            input {
                border: none;
            }
        }

        &::placeholder {
            color: #888;
        }
        &:focus {
            border: 1px solid $app-color1;
            list-style: none;
            &::placeholder {
                color: $app-color1;
            }
        }

        &:focus-visible {
            border: 1px solid $app-color1;
            list-style: none;
            outline-style: none;
            &::placeholder {
                color: $app-color1;
            }
        }
    }
}
</style>
