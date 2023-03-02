<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Dashboard" />

            <hr />
            <QuillEditor
                theme="snow"
                v-model:content="text"
                contentType="html"
            />

            <pre>
                {{ text }}
            </pre>

            <div v-html="text"></div>
        </div>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { ref } from "vue";

const text = ref("");
</script>
