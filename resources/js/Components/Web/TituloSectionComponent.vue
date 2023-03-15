<template>
    <div class="title-section">
        <div class="big-text">{{ titulo }}</div>
        <div class="titulo pb-1 text-color1">
            <h5>{{ titulo }}</h5>
        </div>
        <div class="descripcion">
            {{ descripcion }}
        </div>
    </div>
</template>
<script setup>
const props = defineProps({
    titulo: String,
    descripcion: String,
});
</script>
<style lang="scss">
.title-section {
    position: relative;
    z-index: 1;
    padding: 45px 0 35px 0;
    .titulo {
        position: relative;
    }
    .big-text {
        position: absolute;
        left: -5px;
        top: 10px;
        font-weight: 800;
        color: transparent;
        letter-spacing: 4px;
        font-size: 5rem;
        text-transform: capitalize;
        -webkit-text-stroke-width: 1px;
        -webkit-text-stroke-color: rgba(0, 0, 0, 0.15);
    }
    .descripcion {
        font-size: 1.8rem;
        font-weight: 700;
    }
}
</style>
