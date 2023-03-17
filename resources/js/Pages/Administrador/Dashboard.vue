<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Dashboard" />

            <hr />

            <button @click="Alerta">
                Alerta
            </button>
        </div>
    </AdminLayout>
</template>
<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";

import { useToast } from "vue-toastification";
const toast = useToast();

const Alerta = ()=>{
    toast.success("My toast content");
}
</script>
