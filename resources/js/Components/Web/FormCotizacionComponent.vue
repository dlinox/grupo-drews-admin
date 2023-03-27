<template>
    <n-form class="form-web-cotizacion">
        <div class="row">
            <div class="col-12">
                <n-form-item path="web_telefonos" label="Seleecione una">
                    <n-radio-group v-model:value="formData.para">
                        <n-space>
                            <n-radio value="Empresa"> Empresa </n-radio>
                            <n-radio value="Persona"> Persona </n-radio>
                        </n-space>
                    </n-radio-group>
                </n-form-item>
            </div>

            <template v-if="formData.para == 'Empresa'">
                <div class="col-12 col-md-6">
                    <n-form-item path="ruc" label="RUC">
                        <n-input
                            v-model:value="formData.ruc"
                            placeholder="RUC"
                        />
                    </n-form-item>
                </div>
                <div class="col-12 col-md-6">
                    <n-form-item path="r_social" label="Razón social">
                        <n-input
                            v-model:value="formData.r_social"
                            placeholder="Razón social"
                        />
                    </n-form-item>
                </div>
            </template>

            <template v-else>
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
            </template>

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

            <template v-if="!producto">
                <div class="col-12">
                    <n-form-item
                        path="web_telefonos"
                        label="Vehiculos / Servicios "
                    >
                        <n-radio-group v-model:value="formData.tipo">
                            <n-space>
                                <n-radio value="Vehiculo"> Vehiculos </n-radio>
                                <n-radio value="Servicio"> Servicios </n-radio>
                            </n-space>
                        </n-radio-group>
                    </n-form-item>
                </div>
            </template>

            <div class="col-12">
                <n-form-item
                    class="w-full"
                    path="rango"
                    :label="'Seleccione un: ' + formData.tipo"
                >
                    <template v-if="formData.tipo == 'Vehiculo'">
                        <n-select
                            label-field="detalle"
                            value-field="id"
                            placeholder="Seleccione uno"
                            v-model:value="formData.producto"
                            :options="vehiculos"
                        />
                    </template>
                    <template v-if="formData.tipo == 'Servicio'">
                        <n-select
                            label-field="titulo"
                            value-field="id"
                            placeholder="Seleccione uno"
                            v-model:value="formData.producto"
                            :options="servicios"
                        />
                    </template>
                </n-form-item>
            </div>

            <div class="col-12">
                <n-form-item
                    class="w-full"
                    path="rango"
                    label="Lo quiero desde - Hasta"
                >
                    <n-date-picker
                        v-model:value="formData.rango"
                        type="daterange"
                        clearable
                    />
                </n-form-item>
            </div>
            <div class="col-12">
                <n-form-item path="sede" label="Sede">
                    <n-input
                        v-model:value="formData.sede"
                        placeholder="Lugar de recojo"
                    />
                </n-form-item>
            </div>

            <div class="col-12">
                <n-form-item path="mensaje" label="Mensaje">
                    <n-input
                        type="textarea"
                        v-model:value="formData.mensaje"
                        placeholder="Mensaje"
                    />
                </n-form-item>
            </div>

            <div class="col-12 d-flex justify-content-end">
                <button
                    @click="enviarCotizacion"
                    class="btn btn-color1"
                    :disabled="formData.processing"
                >
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
import { useForm, usePage } from "@inertiajs/vue3";
import { NDatePicker } from "naive-ui";
import { computed } from "vue";
import { useToast } from "vue-toastification";
const toast = useToast();

const props = defineProps({
    producto: Number,
    tipo: String,
});

const emits = defineEmits(["onSubmit"]);

const vehiculos = computed(() => usePage().props.vehiculos);
const servicios = computed(() => usePage().props.servicios);

const formData = useForm({
    para: "Empresa",
    nombres: null,
    apellidos: null,
    correo: null,
    celular: null,
    producto: props.producto,
    rango: null,
    sede: null,
    tipo: props.tipo,

    ruc: null,
    r_social: null,
    mensaje: null,
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
            toast.success("Solicitud Enviada");
            formData.reset();

            emits("onSubmit");
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
