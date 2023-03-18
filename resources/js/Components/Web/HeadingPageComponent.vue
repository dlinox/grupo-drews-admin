<script setup>
const props = defineProps({
    titulo: String,
    image: {
        type: String,
        default: "bg-header-page.jpg",
    },
});
</script>
<template>
    <div
        class="heading-page"
        :style="{ 'background-image': `url(/assets/image/bg/${image})` }"
    >
        <div class="container">
            <div class="heading-bread-crumb mb-3">
                <ul class="bread-crumb-ul">
                    <li class="text-color1 fw-bold">
                        Inicio
                        <i class="fa-solid fa-arrow-right"></i>
                    </li>
                    <li class="ms-2 text-white">{{ titulo }}</li>
                </ul>
            </div>
            <div class="heading-page-title">
                <h1 class="text-white mb-0">
                    {{ titulo }}
                </h1>
            </div>
        </div>
    </div>
</template>
<style lang="scss">
.heading-page {
    
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    padding: 40px 0px;
    position: relative;
    border-bottom: 10px solid $app-color1;
    &::before {
        position: absolute;
        content: "";
        background-color: rgba(0, 0, 0, 0.4);
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }
    .container {
        position: relative;
        z-index: 2;
        
        .heading-bread-crumb {
            .bread-crumb-ul {
                list-style: none;
                display: flex;
                align-items: center;
                margin: 0;
                padding: 0;
                font-family: $font-raj;
            }
        }
    }
    .heading-page-title {
        font-family: $font-teko;
    }
}
</style>
