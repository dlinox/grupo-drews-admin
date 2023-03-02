<template>
    <AdminLayout>
        <div class="container">
            <PageHeaderComponent title="Web" />
            <n-tabs type="line" animated>
                <n-tab-pane name="configuraciones" tab="Configuraciones">
                    <n-divider title-placement="left"> Empresa </n-divider>

                    <n-grid cols="1  600:3" item-responsive>
                        <n-grid-item span="1  600:1">
                            <n-space justify="center">
                                <n-card title="Logo" embedded :bordered="false">
                                    <n-image
                                        width="150"
                                        src="https://07akioni.oss-cn-beijing.aliyuncs.com/07akioni.jpeg"
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
                                            <n-form ref="formRef">
                                                <n-form-item
                                                    path="nombre"
                                                    label="Nombre"
                                                >
                                                    <n-input
                                                        placeholder="Grupo Drews"
                                                    />
                                                </n-form-item>

                                                <n-form-item
                                                    path="descripcion"
                                                    label="Descripción"
                                                >
                                                    <n-input
                                                        placeholder="descripcion"
                                                    />
                                                </n-form-item>

                                                <n-form-item
                                                    path="mision"
                                                    label="Mision"
                                                >
                                                    <n-input
                                                        type="textarea"
                                                        placeholder="mision"
                                                    />
                                                </n-form-item>

                                                <n-form-item
                                                    path="vision"
                                                    label="Visión"
                                                >
                                                    <n-input
                                                        type="textarea"
                                                        placeholder="vision"
                                                    />
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
                                                ref="formRef"
                                                :show-label="false"
                                            >
                                                <n-form-item path="vision">
                                                    <n-input
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

                                                <n-form-item path="vision">
                                                    <n-input
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

                                                <n-form-item path="vision">
                                                    <n-input
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

                                                <n-form-item path="vision">
                                                    <n-input
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
                                    <n-collapse-item title="Contacto" name="3">
                                        <n-card
                                            title="Contacto"
                                            embedded
                                            :bordered="false"
                                        >
                                            <n-form ref="formRef">
                                                <n-form-item
                                                    path="vision"
                                                    label="Telefono"
                                                >
                                                    <n-dynamic-tags
                                                        type="info"
                                                        v-model:value="
                                                            formContacto.telefonos
                                                        "
                                                    />
                                                </n-form-item>

                                                <n-form-item
                                                    path="vision"
                                                    label="Celular"
                                                >
                                                    <n-dynamic-tags
                                                        type="info"
                                                        v-model:value="
                                                            formContacto.celulares
                                                        "
                                                    />
                                                </n-form-item>

                                                <n-form-item
                                                    path="vision"
                                                    label="Direccion"
                                                >
                                                    <n-dynamic-tags
                                                        type="info"
                                                        v-model:value="
                                                            formContacto.direcciones
                                                        "
                                                    />
                                                </n-form-item>
                                            </n-form>
                                        </n-card>
                                    </n-collapse-item>
                                </n-collapse>
                            </n-card>
                        </n-grid-item>
                    </n-grid>
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
                        </template> </n-carousel
                ></n-tab-pane>
            </n-tabs>
        </div>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeaderComponent from "@/Components/PageHeaderComponent.vue";
import { ref } from "vue";
import {
    LogoFacebook,
    LogoInstagram,
    LogoYoutube,
    LogoTwitter,
    ArrowBack,
    ArrowForward,
} from "@vicons/ionicons5";

const formContacto = ref({
    telefonos: ["3213213"],
    celulares: ["951208106", "95564654"],
    direcciones: [
        "Jr. Mariano Nuñez # 230 - Cercado - Juliaca - Puno",
        "Calle Mariano Melgar # 107 - Cerro Colorado - Arequipa",
    ],
});
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
