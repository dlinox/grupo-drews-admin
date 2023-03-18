<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Configuraciones" />
            <n-tabs type="line" animated>
                <n-tab-pane name="configuraciones" tab="Datos Generales">
                    <n-divider title-placement="left"> Empresa </n-divider>

                    <n-grid cols="1  600:3" item-responsive>
                        <n-grid-item span="1  600:1">
                            <n-space justify="center">
                                <n-card title="Logo" embedded :bordered="false">
                                    <n-image
                                        width="150"
                                        :src="formData.web_logo"
                                    />

                                    <UploadImageComponent
                                        v-model="formImg.logo"
                                        @preview-result="
                                            formData.web_logo = $event
                                        "
                                        text="Cambiar Logo"
                                        @onCropper="updateLogo"
                                    />
                                </n-card>
                            </n-space>
                        </n-grid-item>
                        <n-grid-item span="1 600:2">
                            <n-card embedded :bordered="false">
                                <n-collapse
                                    default-expanded-names="1"
                                    accordion
                                >
                                    <n-collapse-item title="General" name="1">
                                        <n-card
                                            title="General"
                                            embedded
                                            :bordered="false"
                                        >
                                            <n-form ref="formRefGeneral">
                                                <n-form-item
                                                    path="nombre"
                                                    label="Nombre"
                                                >
                                                    <n-input
                                                        v-model:value="
                                                            formData.web_nombre
                                                        "
                                                        placeholder="Grupo Drews"
                                                    />
                                                </n-form-item>

                                                <n-form-item
                                                    path="web_descripcion"
                                                    label="Descripción"
                                                >
                                                    <n-input
                                                        v-model:value="
                                                            formData.web_descripcion
                                                        "
                                                        placeholder="descripcion"
                                                    />
                                                </n-form-item>

                                                <n-form-item
                                                    path="web_whatsapp"
                                                    label="N° Whatsapp"
                                                >
                                                    <n-input
                                                        v-model:value="
                                                            formData.web_whatsapp
                                                        "
                                                        placeholder="951201212"
                                                    />
                                                </n-form-item>

                                                <n-form-item
                                                    path="web_correo"
                                                    label="Correo Electronico"
                                                >
                                                    <n-input
                                                        v-model:value="
                                                            formData.web_correo
                                                        "
                                                        placeholder="info@grupodrews.com.pe"
                                                    />
                                                </n-form-item>

                                                <n-form-item
                                                    path="web_mision"
                                                    label="Mision"
                                                >
                                                    <n-space>
                                                        <QuillEditor
                                                            theme="snow"
                                                            v-model:content="
                                                                formData.web_mision
                                                            "
                                                            contentType="html"
                                                        />
                                                    </n-space>
                                                </n-form-item>

                                                <br />
                                                <br />

                                                <n-form-item
                                                    path="web_vision"
                                                    label="Visión"
                                                >
                                                    <n-space>
                                                        <QuillEditor
                                                            theme="snow"
                                                            v-model:content="
                                                                formData.web_vision
                                                            "
                                                            contentType="html"
                                                        />
                                                    </n-space>
                                                </n-form-item>
                                            </n-form>
                                        </n-card>
                                    </n-collapse-item>
                                    <n-collapse-item title="Social" name="2">
                                        <n-card
                                            title="Social"
                                            embedded
                                            :bordered="false"
                                        >
                                            <n-form
                                                ref="formRefSocial"
                                                :show-label="false"
                                            >
                                                <n-form-item
                                                    path="web_social_facebook"
                                                >
                                                    <n-input
                                                        v-model:value="
                                                            formData.web_social_facebook
                                                        "
                                                        placeholder="Facebook"
                                                    >
                                                        <template #prefix>
                                                            <n-icon
                                                                :component="
                                                                    LogoFacebook
                                                                "
                                                            />
                                                        </template>
                                                    </n-input>
                                                </n-form-item>

                                                <n-form-item
                                                    path="web_social_instagram"
                                                >
                                                    <n-input
                                                        v-model:value="
                                                            formData.web_social_instagram
                                                        "
                                                        placeholder="Instagram"
                                                    >
                                                        <template #prefix>
                                                            <n-icon
                                                                :component="
                                                                    LogoInstagram
                                                                "
                                                            />
                                                        </template>
                                                    </n-input>
                                                </n-form-item>

                                                <n-form-item
                                                    path="web_social_youtube"
                                                >
                                                    <n-input
                                                        v-model:value="
                                                            formData.web_social_youtube
                                                        "
                                                        placeholder="Youtube"
                                                    >
                                                        <template #prefix>
                                                            <n-icon
                                                                :component="
                                                                    LogoYoutube
                                                                "
                                                            />
                                                        </template>
                                                    </n-input>
                                                </n-form-item>

                                                <n-form-item
                                                    path="web_social_twitter"
                                                >
                                                    <n-input
                                                        v-model:value="
                                                            formData.web_social_twitter
                                                        "
                                                        placeholder="Twitter"
                                                    >
                                                        <template #prefix>
                                                            <n-icon
                                                                :component="
                                                                    LogoTwitter
                                                                "
                                                            />
                                                        </template>
                                                    </n-input>
                                                </n-form-item>
                                            </n-form>
                                        </n-card>
                                    </n-collapse-item>
                                    <!-- <n-collapse-item title="Contacto" name="3">
                                        <n-card
                                            title="Contacto"
                                            embedded
                                            :bordered="false"
                                        >
                                            <n-form ref="formRefContacto">
                                                <n-form-item
                                                    path="web_telefonos"
                                                    label="Telefono"
                                                >
                                                    <n-dynamic-tags
                                                        type="info"
                                                        v-model:value="
                                                            formData.web_telefonos
                                                        "
                                                    />
                                                </n-form-item>

                                                <n-form-item
                                                    path="web_celulares"
                                                    label="Celular"
                                                >
                                                    <n-dynamic-tags
                                                        type="info"
                                                        v-model:value="
                                                            formData.web_celulares
                                                        "
                                                    />
                                                </n-form-item>

                                                <n-form-item
                                                    path="web_direcciones"
                                                    label="Direccion"
                                                >
                                                    <n-dynamic-tags
                                                        type="info"
                                                        v-model:value="
                                                            formData.web_direcciones
                                                        "
                                                    />
                                                </n-form-item>
                                            </n-form>
                                        </n-card>
                                    </n-collapse-item> -->
                                </n-collapse>

                                <template #action>
                                    <n-space justify="end">
                                        <n-button
                                            :loading="formData.processing"
                                            type="primary"
                                            @click="submit"
                                        >
                                            Guardar Cambios
                                        </n-button>
                                    </n-space>
                                </template>
                            </n-card>
                        </n-grid-item>
                    </n-grid>
                </n-tab-pane>

                <n-tab-pane name="sedes" tab="Sedes">
                    <FormSedesComponent :sedes="configuracion.sedes" />
                </n-tab-pane>

                <n-tab-pane name="slider" tab="Slider">
                    <n-carousel show-arrow autoplay draggable>
                        <img
                            class="carousel-img"
                            src="https://images.pexels.com/photos/1073031/pexels-photo-1073031.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        />
                        <img
                            class="carousel-img"
                            src="https://images.pexels.com/photos/1683519/pexels-photo-1683519.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        />
                        <img
                            class="carousel-img"
                            src="https://images.pexels.com/photos/4781948/pexels-photo-4781948.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        />
                        <img
                            class="carousel-img"
                            src="https://images.pexels.com/photos/14542673/pexels-photo-14542673.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        />
                        <template #arrow="{ prev, next }">
                            <div class="custom-arrow">
                                <button
                                    type="button"
                                    class="custom-arrow--left"
                                    @click="prev"
                                >
                                    <n-icon><ArrowBack /></n-icon>
                                </button>
                                <button
                                    type="button"
                                    class="custom-arrow--right"
                                    @click="next"
                                >
                                    <n-icon><ArrowForward /></n-icon>
                                </button>
                            </div>
                        </template>
                        <template #dots="{ total, currentIndex, to }">
                            <ul class="custom-dots">
                                <li
                                    v-for="index of total"
                                    :key="index"
                                    :class="{
                                        ['is-active']:
                                            currentIndex === index - 1,
                                    }"
                                    @click="to(index - 1)"
                                />
                            </ul>
                        </template>
                    </n-carousel>
                </n-tab-pane>
            </n-tabs>
        </div>
    </AdminLayout>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import { QuillEditor } from "@vueup/vue-quill";

import {
    LogoFacebook,
    LogoInstagram,
    LogoYoutube,
    ArrowBack,
    LogoTwitter,
    ArrowForward,
} from "@vicons/ionicons5";

import UploadImageComponent from "@/Components/UploadImageComponent.vue";
import FormSedesComponent from "./components/FormSedesComponent.vue";

const props = defineProps({
    configuracion: Object,
});

const formImg = useForm({
    logo: null,
});

const formData = useForm(props.configuracion);

const submit = () => {
    console.log(formData);

    formData.post("/admin/configuraciones", {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                console.log(e[property]);
            }
            console.log(e);
        },
        onSuccess: (e) => {
            console.log(e);
            console.log("creado");
        },
    });
};

const updateLogo = () => {
    console.log(formImg);

    formImg.post("/admin/configuraciones/update-logo", {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                console.log(e[property]);
            }
            console.log(e);
        },
        onSuccess: (e) => {
            console.log(e);
            console.log("Logo Cambio");
        },
    });
};
</script>

<style scoped>
.carousel-img {
    width: 100%;
    height: 500px;
    object-fit: cover;
}

.custom-arrow {
    display: flex;
    position: absolute;
    bottom: 25px;
    right: 10px;
}

.custom-arrow button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    margin-right: 12px;
    color: #fff;
    background-color: rgba(255, 255, 255, 0.1);
    border-width: 0;
    border-radius: 8px;
    transition: background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}

.custom-arrow button:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.custom-arrow button:active {
    transform: scale(0.95);
    transform-origin: center;
}

.custom-dots {
    display: flex;
    margin: 0;
    padding: 0;
    position: absolute;
    bottom: 20px;
    left: 20px;
}

.custom-dots li {
    display: inline-block;
    width: 12px;
    height: 4px;
    margin: 0 3px;
    border-radius: 4px;
    background-color: rgba(255, 255, 255, 0.4);
    transition: width 0.3s, background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}

.custom-dots li.is-active {
    width: 40px;
    background: #fff;
}
</style>
