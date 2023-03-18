<template>
    <div>
        <n-button class="select-picture">
            {{ text }}
            <template #icon>
                <n-icon>
                    <ImageSharp />
                </n-icon>
            </template>
            <input
                ref="uploadInput"
                type="file"
                accept="image/jpg, image/jpeg, image/png, image/gif"
                @change="selectFile"
            />
        </n-button>

        <n-modal v-model:show="showModalPic">
            <n-card
                style="width: 600px"
                title="cortar imagen"
                :bordered="false"
                size="huge"
                role="dialog"
                aria-modal="true"
            >
                <VuePictureCropper
                    :boxStyle="{
                        width: '100%',
                        height: '100%',
                        backgroundColor: '#f8f8f8',
                        margin: 'auto',
                    }"
                    :options="{
                        viewMode: 1,
                        dragMode: 'crop',
                        aspectRatio: 16 / 9,
                    }"
                    :img="pic"
                />

                <template #footer>
                    <n-button @click="Cortar"> Cortarr </n-button>
                </template>
            </n-card>
        </n-modal>
    </div>
</template>

<script setup>
import { ref, reactive } from "vue";
import VuePictureCropper, { cropper } from "vue-picture-cropper";
import { ImageSharp } from "@vicons/ionicons5";

const props = defineProps({
    modelValue: File,
    text: {
        type: String,
        default: "Seleccionar imagen",
    },
});

const emit = defineEmits(["update:modelValue", "preview-result", "on-cropper"]);

//MODULO DE IMGANE
const pic = ref("");
const showModalPic = ref(false);
const uploadInput = ref(null);

const aspectRatio = ref(16 / 9);

const result = reactive({
    dataURL: "",
    blobURL: "",
});

const selectFile = (e) => {
    console.log("adaf");
    pic.value = "";
    result.dataURL = "";
    result.blobURL = "";

    let files = e.target.files;

    if (!files || !files.length) return;
    // Convert to dataURL and pass to the cropper component
    console.log("paso");
    const file = files[0];
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
        // Update the picture source of the `img` prop
        pic.value = String(reader.result);
        // Show the modal
        showModalPic.value = true;
        // Clear selected files of input element
        if (!uploadInput.value) return;
        uploadInput.value = "";
    };
};

const Cortar = async () => {
    if (!cropper) return;
    console.log("Cortando");
    //const base64 = cropper.getDataURL();
    const blob = await cropper.getBlob();

    const file = await cropper.getFile({
        fileName: "preview-result",
    });

    if (!blob) return;
    //result.dataURL = base64;
    result.blobURL = URL.createObjectURL(blob);

    emit("update:modelValue", file);
    emit("preview-result", result.blobURL);

    showModalPic.value = false;

    emit("on-cropper", file);
};
</script>

<style>
.select-picture {
    position: relative;
}

.select-picture input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    font-size: 0;
    cursor: pointer;
    opacity: 0;
}
</style>
