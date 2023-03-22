<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Dashboard" />

            <hr />

            <button @click="Alerta">Alerta</button>

            <hr />

            <CropCompressImageComponent @onCropper="linox = $event" />

            <img v-if="linox" :src="linox.blob" alt="" width="250" />

            <!-- <IconsComponent /> -->
        </div>
    </AdminLayout>
</template>
<script setup>
import { ref } from "vue";
import { useToast } from "vue-toastification";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
//import IconsComponent from "@/Components/IconsComponent.vue";
import CropCompressImageComponent from "../../Components/CropCompressImageComponent.vue";

const linox = ref(null);

const toast = useToast();

const Alerta = () => {
    toast.success("My toast content");
};
</script>

<style lang="scss">
@import url(https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css);
</style>
