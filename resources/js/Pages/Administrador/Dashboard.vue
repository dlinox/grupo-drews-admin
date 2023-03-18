<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Dashboard" />

            <hr />

            <button @click="Alerta">Alerta</button>

            <hr />

            <CropCompressImageComponent @onCropper="linox = $event" />

            <img v-if="linox" :src="linox.blob" alt="" width="250" />
        </div>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";

import { useToast } from "vue-toastification";
import CropCompressImageComponent from "../../Components/CropCompressImageComponent.vue";
import { ref } from "vue";

const linox = ref(null);

const toast = useToast();

const Alerta = () => {
    toast.success("My toast content");
};
</script>
