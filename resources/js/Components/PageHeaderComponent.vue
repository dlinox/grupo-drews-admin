<template>
    <n-page-header class="page-header">
        <template #title> {{ title }} </template>
        <template #avatar>
            <n-avatar style="background-color: #aaa">
                <n-icon>
                    <AppsSharp />
                </n-icon>
            </n-avatar>
        </template>
        <template #extra>
            <n-breadcrumb>
                <n-breadcrumb-item> Dashboard</n-breadcrumb-item>
                <n-breadcrumb-item> {{ title }} </n-breadcrumb-item>
            </n-breadcrumb>
        </template>
    </n-page-header>
</template>
<script setup>
import { AppsSharp } from "@vicons/ionicons5";

const props = defineProps({
    title: String,
});
</script>

<style>
.page-header{
    margin-bottom: 1rem;
}
</style>
