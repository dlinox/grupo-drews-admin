<template>
    <n-button @click="showModal = true"> Start Me up </n-button>
    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px"
            :bordered="false"
            size="huge"
            role="dialog"
            aria-modal="true"
        >
            <template #header>
                <n-input
                    v-model:value="iconoSearch"
                    type="text"
                    placeholder="Buscar Icono"
                />
            </template>

            <n-space justify="space-around">
                <n-card v-for="item in icons_list" style="width: 60px">
                    <i :class="item"></i>
                </n-card>
            </n-space>
        </n-card>
    </n-modal>
</template>
<script setup>
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

import FIcons from "../../assets/data/icons.json";

const showModal = ref(false);
const iconoSearch = ref(null);

const icons_list = ref(FIcons);

watch(
    iconoSearch,
    debounce((val) => {
        icons_list.value = FIcons.filter(
            (item) => item.toLowerCase().indexOf(val.toLowerCase()) > -1
        );
    }, 300)
);
</script>
<style lang="css">
@import url(https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css);

.n-card__content {
    max-height: 80vh;
    overflow-x: hidden;
    overflow-y: auto;
}
</style>
