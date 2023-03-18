<template>
    <div class="title-section">
        <div class="big-text">{{ titulo }}</div>

        <h2 class="titulo">{{ titulo }}</h2>

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
        font-family: $font-raj;
        font-size: 1.5rem;
        color: $app-color1;
        font-weight: 900;
    }
    .big-text {
        position: absolute;
        left: -5px;
        top: 10px;
        font-weight: 900;
        color: transparent;
        letter-spacing: 4px;
        font-size: 5.5rem;
        font-family: $font-teko;
        text-transform: capitalize;
        -webkit-text-stroke-width: 1px;
        -webkit-text-stroke-color: rgba(0, 0, 0, 0.15);
    }
    .descripcion {
        font-size: 1.8rem;
        font-weight: 700;
        font-family: $font-raj;
        color: #333;
    }
}
</style>
