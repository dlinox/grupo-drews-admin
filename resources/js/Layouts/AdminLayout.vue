<template>
    <n-config-provider :theme-overrides="themeOverrides">
        <n-dialog-provider>
            <n-modal v-model:show="showModal">
                <n-card
                    style="width: 500px"
                    title="Cambiar contraseña"
                    :bordered="false"
                    size="huge"
                    role="dialog"
                    aria-modal="true"
                >
                    <n-input
                        type="text"
                        placeholder="Nueva contraseña"
                        v-model:value="formPass.newPassword"
                    />
           
                      <small style="color: red;">

                          {{ formPass.errors.newPassword }}
                      </small>
                    
        
                    <template #footer>
                        <n-space justify="space-between" size="large">
                            <n-button @click="showModal = !showModal"
                                >Cancelar</n-button
                            >

                            <n-button type="success" @click="changePassword"
                                >Guardar</n-button
                            >
                        </n-space>
                    </template>
                </n-card>
            </n-modal>

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

import { router, useForm, usePage } from "@inertiajs/vue3";

import { createGlobalState, useStorage } from "@vueuse/core";

const useState = createGlobalState(() =>
    useStorage("vue-use-locale-storage", {
        inverted: false,
    })
);

const state = useState();

const showModal = ref(false);

const formPass = useForm({
    newPassword: "",
});

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
        router.post("/auth/logout");
    } else if (val === "profile") {
        showModal.value = true;
    }
};

const changePassword = () => {
    formPass.post("/admin/change-password", {
        preserveScroll: true,
        onError: (e) => {
            // message.error("Ocurrio un error, vuelva a intentarlo");
        },
        onSuccess: () => {
            showModal.value = false;
            // message.success("Contraseña actualizada");
            formPass.reset();
        },
    });
};

const initialize = () => {
    window.addEventListener("resize", handleResize);
    handleResize();
};

const collapsed_width = computed(() => {
    if (widthScreen.value < 768) {
        sider.value = false;
        sider_position.value = "absolute";
        sider_collapse.value = true;
        return 0;
    } else {
        sider.value = true;
        sider_position.value = "static";
        return 64;
    }
});

initialize();
</script>

<style lang="scss">
.wrapper {
    padding: 1rem 2rem;
}
@media (max-width: 600px) {
    .wrapper {
        padding: 1rem 0.5rem;
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
* {
    font-family: $font-raj;
    letter-spacing: 0.2px;
    font-weight: 600;
}
th {
    font-weight: 900;
}
td {
    font-weight: 400;
}

h1,
h2,
h3,
h4,
h5,
h6 {
    font-family: $font-teko;
    letter-spacing: 1px;
}

.n-button__content {
    font-family: $font-raj;
    font-weight: 500;
    text-transform: uppercase;
}

.n-form-item-feedback__line {
    font-size: 0.7rem;
}
.n-input__input-el {
    font-weight: 500;
}
</style>
