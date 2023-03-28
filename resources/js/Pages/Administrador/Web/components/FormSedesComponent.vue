<template>
    <n-card embedded>
        <n-grid cols="1  600:3" item-responsive :y-gap="10">
            <n-grid-item span="3">
                <n-space justify="end">
                    <n-button type="primary" @click="agregarSede">
                        Agregar Sede
                    </n-button>
                </n-space>
            </n-grid-item>

            <n-grid-item span="1 600:3">
                <n-form ref="formRefSedes">
                    <n-space vertical>
                        <n-card
                            v-for="(item, index) in formSedes.sedes"
                            :key="index"
                            class="mb-1"
                        >
                            <n-divider title-placement="left">
                                <template v-if="item.ubigeo == null">
                                    <ModalUbigeoComponent
                                        @on-select="item.ubigeo = $event"
                                    />
                                </template>
                                <template v-else>
                                    <ModalUbigeoComponent
                                        @on-select="item.ubigeo = $event"
                                    />
                                    <span style="margin-left: 1rem">
                                        {{ setSede(item?.ubigeo) }}
                                    </span>
                                </template>
                            </n-divider>
                            <n-form-item path="web_telefonos" label="Direccion">
                                <n-input
                                    v-model:value="item.direccion"
                                    placeholder="Direccion"
                                />
                            </n-form-item>

                            <n-form-item path="web_telefonos" label="Telefono">
                                <n-input
                                    v-model:value="item.telefono"
                                    placeholder="Telefono"
                                />
                            </n-form-item>

                            <n-form-item path="web_telefonos" label="Celulares">
                                <n-input
                                    v-model:value="item.celulares"
                                    placeholder="Celulares"
                                />
                            </n-form-item>

                            <n-space justify="end">
                                <n-button
                                    secondary
                                    type="error"
                                    class="btn-slide"
                                    @click="eliminarSede(item, index)"
                                >
                                    Eliminar
                                </n-button>
                            </n-space>
                        </n-card>
                    </n-space>

                    <n-card class="">
                        <n-space justify="end">
                            <n-button
                                @click="submit"
                                type="primary"
                                :loading="formSedes.processing"
                            >
                                GUARDAR
                            </n-button>
                        </n-space>
                    </n-card>
                </n-form>
            </n-grid-item>
        </n-grid>
    </n-card>
</template>

<script setup>
import ModalUbigeoComponent from "@/Components/ModalUbigeoComponent.vue";
import { useForm, router } from "@inertiajs/vue3";
import ubigeoJson from "../../../../../assets/data/ubigeo.json";

import { useToast } from "vue-toastification";
const toast = useToast();

const props = defineProps({
    sedes: Array,
});

const formSedes = useForm({
    sedes: props.sedes,
});

const getSede = (ubigeo) => ubigeoJson.filter((item) => item.ubigeo == ubigeo);

const setSede = (ubigeo) => {
    let aux = getSede(ubigeo)[0];
    return aux.departamento + " - " + aux.provincia + " - " + aux.distrito;
};

const agregarSede = () => {
    formSedes.sedes.push({
        id: null,
        ubigeo: null,
        direccion: null,
        telefono: null,
        celulares: null,
    });
};

const eliminarSedeDB = (id, index) => {
    router.delete("/admin/sedes/" + id, {
        onError: (e) => {
            for (const property in e) {
                toast.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: (e) => {
            toast.success("Eliminado con exito");
            formSedes.sedes.splice(index, 1);
            console.log(e);
        },
    });
};

const eliminarSede = (item, index) => {
    if (item.id) {
        console.log("eliminar en la base de datos");
        eliminarSedeDB(item.id, index);
    } else {
        console.log("eliminar con javascrippt");
        formSedes.sedes.splice(index, 1);
    }
};

const submit = () => {
    formSedes.post("/admin/sedes", {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                toast.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: (e) => {
            toast.success("Datos Actualizados");
            console.log("creado");
            //formSedes.reset();
        },
    });
};
</script>
