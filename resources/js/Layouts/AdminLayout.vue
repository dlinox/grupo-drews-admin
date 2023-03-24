<template>
    <n-config-provider :theme-overrides="themeOverrides">
        <n-dialog-provider>
            <div style="height: 100vh; position: relative">
                <n-layout position="absolute">
                    <n-layout-header
                        bordered
                        :inverted="state.inverted"
                        style="padding: 10px"
                    >
                        <n-space justify="space-between">
                            <n-button
                                tertiary
                                type="info"
                                @click="
                                    (sider_collapse = !sider_collapse),
                                        (sider = true)
                                "
                            >
                                <template #icon>
                                    <MenuOutline />
                                </template>
                            </n-button>

                            <n-space>
                                <n-button
                                    type="info"
                                    @click="state.inverted = !state.inverted"
                                >
                                    <template #icon>
                                        <template v-if="state.inverted">
                                            <SunnyOutline />
                                        </template>

                                        <template v-else>
                                            <MoonOutline />
                                        </template>
                                    </template>
                                </n-button>

                                <n-dropdown
                                    :options="options"
                                    @select="onMenuDropdown"
                                >
                                    <n-button tertiary type="info">
                                        {{ user?.name }}
                                    </n-button>
                                </n-dropdown>
                            </n-space>
                        </n-space>
                    </n-layout-header>

                    <n-layout has-sider position="absolute" style="top: 55px">
                        <n-layout-sider
                            v-show="sider"
                            bordered
                            :collapsed="sider_collapse"
                            collapse-mode="width"
                            :position="sider_position"
                            :collapsed-width="collapsed_width"
                            :width="240"
                            :native-scrollbar="false"
                            :inverted="state.inverted"
                        >
                            <n-menu
                                :inverted="state.inverted"
                                :collapsed-width="collapsed_width"
                                :collapsed-icon-size="22"
                                :options="menuOptions"
                                :default-value="curren_url"
                                @update:value="handleUpdateExpandedKeys"
                            />
                        </n-layout-sider>

                        <n-layout-content style="background-color: #eee">
                            <Transition name="committee" appear>
                                <div class="wrapper">
                                    <slot></slot>
                                </div>
                            </Transition>
                        </n-layout-content>
                        <!-- <n-layout-footer>Chengfu Road</n-layout-footer> -->
                    </n-layout>
                </n-layout>
            </div>
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

import { router, usePage } from "@inertiajs/vue3";

import { createGlobalState, useStorage } from "@vueuse/core";

const useState = createGlobalState(() =>
    useStorage("vue-use-locale-storage", {
        inverted: false,
    })
);

const state = useState();

const user = computed(() => usePage().props?.auth?.user);
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
const inverted = false; //modo dark
//router.remember(data, 'my-key')

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
        key: "_reservas",
        icon: renderIcon(CheckboxOutline),
        children: [
            {
                label: "Cotizaciones",
                key: "reservas",
            },
            {
                label: "Mensajes de Contacto",
                key: "mensajes",
            },
            {
                label: "Clientes",
                key: "clientes",
            },
        ],
    },

    {
        label: "Servicios",

        key: "servicios",
        icon: renderIcon(AlbumsOutline),
    },
    {
        label: "Productos",
        key: "_productos",
        icon: renderIcon(CarSportOutline),
        children: [
            {
                label: "Vehiculos",
                key: "productos",
            },
            {
                label: "Categorias",
                key: "categorias",
            },
        ],
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
    console.log(val);

    if (val == "admin") {
        router.get("/admin");
    } else {
        router.get("/admin/" + val);
    }
};

const onMenuDropdown = (val) => {
    console.log(val);
    if (val == "logout") {
        router.post("auth/logout");
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
.wrapper{
    padding: 1rem 2rem
}
@media (max-width: 600px) {
  .wrapper {
    padding: 1rem .5rem

  }

}
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
