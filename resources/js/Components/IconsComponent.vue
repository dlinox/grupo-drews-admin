<template>
    <n-button type="info" @click="showModal = !showModal">
        <n-icon> <Search /> </n-icon>
    </n-button>
    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px; height: 60vh"
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
                    :loading="loading"
                >
                    <template #suffix>
                        {{ totalResults }}
                    </template>
                </n-input>

                
            </template>

            <n-space justify="space-around">
                <n-popover v-for="item in icons_list" trigger="hover">
                    <template #trigger>
                        <n-button
                            ize="large"
                            @click="
                                $emit('iconSelected', item.class),
                                    (showModal = false)
                            "
                        >
                            <i :class="item.class"></i>
                        </n-button>
                    </template>
                    <span>
                        {{ item.name }}
                    </span>
                </n-popover>
            </n-space>

            <template #footer>
                <n-space justify="end">
                    <n-pagination
                        v-model:page="page"
                        :page-slot="5"
                        :page-count="totalPages"
                    />
                </n-space>
            </template>
        </n-card>
    </n-modal>
</template>
<script setup>
import { ref, watch } from "vue";
import throttle from "lodash/throttle";
import { Search } from "@vicons/ionicons5";

const emit = defineEmits(["iconSelected"]);

const showModal = ref(false);
const icons_list = ref([]);

const iconoSearch = ref(null);

const page = ref(1);
const totalPages = ref(1);
const totalResults = ref(0);
const loading = ref(false);

const getIconos = async () => {
    loading.value = true;
    let res = await axios.get("/admin/iconos?page=" + page.value, {
        params: { search: iconoSearch.value },
    });

    page.value = res.data.current_page;
    totalResults.value = res.data.total;
    totalPages.value = res.data.last_page;
    icons_list.value = res.data.data;

    loading.value = false;
};

watch(
    iconoSearch,
    throttle( (val) => {
        page.value = 1;
         getIconos();
    }, 800)
);

watch(page, () => getIconos());
</script>
<style lang="css">
@import url(https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css);

.n-card__content {
    overflow-x: hidden;
    overflow-y: auto;
}
</style>
