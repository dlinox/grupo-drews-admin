<template>
    <n-card>
        <n-form>
            <n-card
                v-for="(item, index) in formData.sliders"
                :key="index"
                class="card-slide"
            >
                <n-button secondary type="error" class="btn-slide">
                    Eliminar
                </n-button>

                <n-grid cols="1  600:2" item-responsive :y-gap="10">
                    <n-grid-item>
                        <n-form-item path="titulo" label="Titulo">
                            <n-input
                                v-model:value="item.titulo"
                                placeholder="Titulo"
                            />
                        </n-form-item>

                        <n-form-item path="sub_titulo" label="Sub Titulo">
                            <n-input
                                v-model:value="item.sub_titulo"
                                placeholder="Sub Titulo"
                            />
                        </n-form-item>

                        <n-form-item path="web_telefonos" label="Imagen">
                            <n-radio-group v-model:value="item.tipo">
                                <n-space>
                                    <n-radio disabled value="V"> Video </n-radio>
                                    <n-radio value="I"> Imagen </n-radio>
                                </n-space>
                            </n-radio-group>
                        </n-form-item>

                        <CropCompressImageComponent
                            @onCropper="
                                (item.blob = $event.blob),
                                    (item.src = $event.file)
                            "
                        />
                    </n-grid-item>
                    <n-grid-item>
                        <div class="wrapper-img-preview">
                            <n-image
                                class="img-preview"
                                v-if="item.blob || item.src"
                                :src="item.blob ?? item.src"
                            />
                        </div>
                    </n-grid-item>
                </n-grid>
            </n-card>
        </n-form>

        <template #action>
            <n-space justify="space-between">
                <n-button @click="agregarSlide"> Agregar Slide </n-button>

                <n-button type="primary" @click="submit"> Guardar </n-button>
            </n-space>
        </template>
    </n-card>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import CropCompressImageComponent from "@/Components/CropCompressImageComponent.vue";
import { ref } from "vue";

import { useToast } from "vue-toastification";
const toast = useToast();

const props = defineProps({
    sliders: Array,
});

const formData = useForm({
    sliders: props.sliders,
});

const preview_imgs = ref([]);

const agregarSlide = () => {
    formData.sliders.push({
        id: null,
        titulo: null,
        sub_titulo: null,
        src: null,
        tipo: null,
        blob: null,
    });
};

const submit = () => {
    console.log(formData);
    formData.post("/admin/sliders", {
        preserveScroll: true,
        onError: (e) => {
            for (const property in e) {
                toast.error(e[property]);
            }
            console.log(e);
        },
        onSuccess: (e) => {
            toast.success("Datos Actualizados");
            console.log("creado");
            //formSedes.reset();
        },
    });
};
</script>

<style lang="scss">
.wrapper-img-preview {
    padding: 1rem;
}
.wrapper-img-preview .img-preview {
    width: 100%;
    margin: auto;
    object-fit: contain;
    img {
        width: 100%;
    }
}
.card-slide {
    position: relative;
    .btn-slide {
        position: absolute;
        top: 0;
        right: 0;
    }
}
</style>

<!-- <n-carousel show-arrow autoplay draggable>
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
</n-carousel> -->
