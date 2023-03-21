<template>
    <n-button  type="info" @click="showModal = true"> Ubicacion </n-button>
    <n-modal v-model:show="showModal">
        <n-card
            style="width: 500px"
            title="Selecionar Ubicacion"
            :bordered="false"
            size="huge"
            role="dialog"
            aria-modal="true"
        >
            <UbigeoComponent v-model="ubigeo" />
            <template #footer>
                <n-space justify="space-between">
                    <n-button @click="showModal = false">Cancelar</n-button>
                    <n-button @click=" emits('onSelect',ubigeo ) , showModal = false ">Aceptar</n-button>
                </n-space>
            </template>
        </n-card>
    </n-modal>
</template>
<script setup>
import { ref } from "vue";
import UbigeoComponent from "@/Components/UbigeoComponent.vue";

const emits = defineEmits(["onSelect"]);

const showModal = ref(false);
const ubigeo = ref(null);
</script>
