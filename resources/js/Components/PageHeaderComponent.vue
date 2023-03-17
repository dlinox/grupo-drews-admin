<template>
    <n-page-header>
        <template #title> {{ title }} </template>

        <template #header>
            <n-breadcrumb>
                <n-breadcrumb-item> Dashboard</n-breadcrumb-item>
                <n-breadcrumb-item> {{ title }} </n-breadcrumb-item>
            </n-breadcrumb>
        </template>
        <template #avatar>
            <n-avatar style="background-color: #aaa">
                <n-icon>
                    <AppsSharp />
                </n-icon>
            </n-avatar>
        </template>
        <template #extra>
            <n-space>
                <n-button>Actualizar</n-button>
            </n-space>
        </template>
    </n-page-header>
</template>
<script setup>
import { AppsSharp } from "@vicons/ionicons5";

const props = defineProps({
    title: String,
});
</script>
