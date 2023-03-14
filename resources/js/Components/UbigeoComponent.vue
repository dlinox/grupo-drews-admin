<template>
    <n-grid cols="1 400:2 800:3" :y-gap="10" :x-gap="10">
        <n-grid-item>
            <n-select
                v-model:value="model.departamento"
                filterable
                placeholder="Seleccione un depratamento"
                :options="ubigeo.departamento"
                @update:value="onSelectDepartamento"
            />
        </n-grid-item>

        <n-grid-item>
            <n-select
                v-model:value="model.provincia"
                filterable
                placeholder="Seleccione una provincia"
                :options="ubigeo.provincia"
                @update:value="onSelectProvincia"
            />
        </n-grid-item>

        <n-grid-item>
            <n-select
                value-field="ubigeo"
                label-field="distrito"
                v-model:value="model_ubigeo"
                filterable
                placeholder="PlSeleccione un Distrito"
                :options="ubigeo.distrito"
            />
        </n-grid-item>
    </n-grid>
</template>
<script setup>
import { reactive, computed } from "vue";
import ubigeoJson from "../../assets/data/ubigeo.json";

const props = defineProps({
    modelValue: String,
});
const emits = defineEmits(["update:modelValue"]);

const model_ubigeo = computed({
    get: () => props.modelValue,
    set: (value) => emits("update:modelValue", value),
});

const ubigeo = reactive({
    departamento: [],
    provincia: [],
    distrito: [],
});

const model = reactive({
    departamento: null,
    provincia: null,
});

const inicializar = () => {
    let departamento = [
        ...new Set(ubigeoJson.map((item) => item.departamento)),
    ];
    ubigeo.departamento = departamento.map((dep) => ({
        label: dep,
        value: dep,
    }));
};

const onSelectDepartamento = (e) => {
    let provinciasJson = ubigeoJson.filter((item) => item.departamento == e);

    let departamento = [
        ...new Set(provinciasJson.map((item) => item.provincia)),
    ];

    ubigeo.provincia = departamento.map((pro) => ({
        label: pro,
        value: pro,
    }));

};

const onSelectProvincia = (e) => {
    ubigeo.distrito = ubigeoJson.filter(
        (item) => item.provincia == e && item.departamento == model.departamento
    );

};

inicializar();
</script>
