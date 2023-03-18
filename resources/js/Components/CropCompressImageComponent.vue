<template>
    <n-button class="btn-upload-image">
        <input
            type="file"
            ref="file"
            @change="cargarImagen($event)"
            accept="image/*"
        />
        Subir imagen
    </n-button>

    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px"
            title="Modal"
            :bordered="false"
            size="huge"
            role="dialog"
            aria-modal="true"
        >
            <template #header-extra>
                <n-button-group size="small">
                    <n-button
                        @click="movable = !movable"
                        :type="movable ? 'info' : 'tertiary'"
                    >
                        <template #icon>
                            <n-icon><Move /></n-icon>
                        </template>
                    </n-button>
                    <n-button
                        @click="resizable = !resizable"
                        :type="resizable ? 'info' : 'tertiary'"
                    >
                        <template #icon>
                            <n-icon><Resize /></n-icon>
                        </template>
                    </n-button>

                    <n-dropdown
                        trigger="hover"
                        @select="aspectRatio = $event"
                        :options="aspectRatio_options"
                    >
                        <n-button>
                            <template #icon>
                                <n-icon>
                                    <ScanCircleSharp />
                                </n-icon>
                            </template>
                            {{
                                aspectRatio_options.find(
                                    (item) => item.key == aspectRatio
                                ).label
                            }}
                        </n-button>
                    </n-dropdown>
                </n-button-group>
            </template>

            <cropper
                ref="cropperRef"
                class="upload-example-cropper"
                :src="image.src"
                :stencil-props="{
                    aspectRatio: aspectRatio,
                    movable: movable,
                    resizable: resizable,
                }"
            />

            <template #footer>
                <n-space>
                    <n-button>Reestablecer </n-button>
                    <n-button @click="movable = !movable">movable </n-button>

                    <n-button @click="cropAndOptimize">
                        <template #icon>
                            <n-icon><Crop /></n-icon>
                        </template>
                        Cortar {{ optimize }}
                    </n-button>
                </n-space>
            </template>
        </n-card>
    </n-modal>
</template>

<script setup>
import { ref, computed, reactive } from "vue";
import { Cropper } from "vue-advanced-cropper";
import { Crop, Move, Resize, ScanCircleSharp } from "@vicons/ionicons5";
import { loadImageHelper } from "@/helpers/uploadFile.js";
const emits = defineEmits(["onCropper"]);

const props = defineProps({
    mimeType: String,
    optimize: {
        type: Number,
        default: 0.5,
    },
});

const aspectRatio = ref(16 / 9);
const movable = ref(true);
const resizable = ref(true);

const aspectRatio_options = [
    { label: "16:9", key: 16 / 9 },
    { label: "4:3", key: 4 / 3 },
    { label: "1:1", key: 1 },
];

const showModal = ref(false);

const cropperRef = ref(null);

const image = reactive({
    src: null,
    type: null,
});

const cropAndOptimize = () => {
    const canvas = cropperRef.value.getResult().canvas;
    canvas.toBlob(
        (blob) => {
            let file = new File([blob], "imagen_crop_optimize", {
                type: blob.type,
                quality: 0.5,
            });
            emits("onCropper", { file: file, blob: URL.createObjectURL(blob) });
            showModal.value = false;
        },
        image.type,
        0.6
    );
};

const cargarImagen = async (e) => {
    console.log("ini");
    let res = await loadImageHelper(e);

    if (res) {
        image.src = res.src;
        image.type = res.type;

        showModal.value = true;
    } else {
        console.log("error");
    }

    console.log("fin");
};
</script>

<style lang="scss">
.btn-upload-image {
    position: relative;

    input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        font-size: 0;
        cursor: pointer;
        opacity: 0;
    }
}
</style>
