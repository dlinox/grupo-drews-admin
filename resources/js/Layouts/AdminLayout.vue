<template>
    <n-config-provider :theme-overrides="themeOverrides">
        <n-dialog-provider>
            <n-message-provider>
                <n-layout>
                    <n-layout has-sider>
                        <n-layout-sider
                            v-show="sider"
                            bordered
                            :collapsed="sider_collapse"
                            collapse-mode="width"
                            :position="sider_position"
                            :collapsed-width="collapsed_width"
                            :width="240"
                            :native-scrollbar="false"
                            :inverted="inverted"
                            style="height: 100vh"
                        >
                            <template v-if="sider_collapse">
                                <n-space justify="center">
                                    <n-avatar
                                        style="
                                            margin: 15px 0px;
                                            background-color: rgba(
                                                150,
                                                170,
                                                150,
                                                0.2
                                            );
                                            padding: 2px;
                                        "
                                        src="https://www.grupodrews.com.pe/wp-content/uploads/2019/06/logo.png"
                                    />
                                </n-space>
                            </template>

                            <template v-else>
                                <n-card
                                    :bordered="false"
                                    size="small"
                                    style="
                                        padding: 10px;
                                        background-color: rgba(
                                            150,
                                            170,
                                            150,
                                            0.2
                                        );
                                    "
                                >
                                    <template #cover>
                                        <img
                                            src="https://www.grupodrews.com.pe/wp-content/uploads/2019/06/logo.png"
                                        />
                                    </template>
                                </n-card>
                            </template>

                            <n-menu
                                :inverted="inverted"
                                :collapsed-width="collapsed_width"
                                :collapsed-icon-size="22"
                                :options="menuOptions"
                                :default-value="curren_url"
                                @update:value="handleUpdateExpandedKeys"
                            />
                        </n-layout-sider>

                        <n-layout style="height: 100vh">
                            <n-layout-header
                                bordered
                                :inverted="inverted"
                                style="padding: 10px"
                            >
                                <n-space justify="space-between">
                                    <n-button
                                        tertiary
                                        type="info"
                                        @click="
                                            sider_collapse = !sider_collapse
                                        "
                                    >
                                        <template #icon>
                                            <MenuOutline />
                                        </template>
                                    </n-button>
                                    <n-space>
                                        <n-button
                                            type="info"
                                            @click="inverted = !inverted"
                                        >
                                            <template #icon>
                                                <template v-if="inverted">
                                                    <SunnyOutline />
                                                </template>

                                                <template v-else>
                                                    <MoonOutline />
                                                </template>
                                            </template>
                                        </n-button>

                                        <n-dropdown :options="options">
                                            <n-button tertiary type="info">
                                                Jun Peres
                                            </n-button>
                                        </n-dropdown>
                                    </n-space>
                                </n-space>
                            </n-layout-header>
                            <n-layout-content
                                content-style="padding: 15px 20px;"
                            >
                                <Transition name="committee" appear>
                                    <slot></slot>
                                </Transition>
                            </n-layout-content>
                            <!-- <n-layout-footer>Chengfu Road</n-layout-footer> -->
                        </n-layout>
                    </n-layout>
                </n-layout>
            </n-message-provider>
        </n-dialog-provider>
    </n-config-provider>
</template>

<script setup>
import { h, ref, computed } from "vue";
import { NIcon } from "naive-ui";
import {
    PersonCircle,
    LogOutOutline,
    SunnyOutline,
    MoonOutline,
    MenuOutline,
    People,
    AppsSharp,
    AlbumsOutline,
    CarSportOutline,
    CheckboxOutline,
    GlobeOutline,
} from "@vicons/ionicons5";

import { router } from "@inertiajs/vue3";

import { NConfigProvider } from "naive-ui";

const themeOverrides = {
    common: {
        primaryColor: "#019136",
    },
    Menu: {
        itemColorActiveInverted: "rgba(1, 145, 54, 0.4)",
    },
};

function renderIcon(icon) {
    return () => h(NIcon, null, { default: () => h(icon) });
}
const inverted = ref(true); //modo dark

const sider = ref(true); //absolute
const sider_position = ref("static"); //absolute
const sider_collapse = ref(false);

const menuOptions = [
    {
        label: "Dasboard",
        key: "admin",
        icon: renderIcon(AppsSharp),
    },

    {
        label: "Usuarios",
        key: "usuarios",
        icon: renderIcon(People),
    },
    {
        label: "Reservas",
        key: "reservas",
        icon: renderIcon(CheckboxOutline),
    },

    {
        label: "Servicios",

        key: "servicios",
        icon: renderIcon(AlbumsOutline),
    },
    {
        label: "Productos",
        key: "productos",
        icon: renderIcon(CarSportOutline),
    },
    {
        label: "Web",
        key: "web",
        icon: renderIcon(GlobeOutline),
    },
];

const options = [
    {
        label: "Perfil",
        key: "profile",
        icon: renderIcon(PersonCircle),
    },
    {
        label: "Salir",
        key: "logout",
        icon: renderIcon(LogOutOutline),
    },
];

const widthScreen = ref(0);
const handleResize = () => {
    widthScreen.value = window.innerWidth;
};

const curren_url = computed(() => {
    return window.location.href.split("/").pop();
});

const handleUpdateExpandedKeys = (val) => {
    if (val == "admin") {
        router.get("/admin");
    } else {
        router.get("/admin/" + val);
    }
};

const initialize = () => {
    window.addEventListener("resize", handleResize);
    handleResize();
};

const collapsed_width = computed(() => {
    if (widthScreen.value < 768) {
        sider.value = false;
        sider_position.value = "absolute";
        return 0;
    } else {
        sider.value = true;
        sider_position.value = "static";
        return 64;
    }
});

initialize();
</script>

<style scoped>
.committee-enter-from {
    opacity: 0;
    transform: translateY(-2rem);
}
.committee-enter-active {
    transition: all 0.3s ease-in;
}
.committee-enter-to {
    opacity: 1;
    transform: translateX(0);
}
</style>
