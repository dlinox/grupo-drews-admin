<template>
<HeaderComponent />

<main>
  <slot></slot>
</main>

<footer>
footer
</footer>

</template>
<script setup>
import HeaderComponent from '@/Components/Web/HeaderComponent.vue';

</script>