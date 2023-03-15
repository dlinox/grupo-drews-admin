

<template>
  <section class="inicio-eligenos pb-5">
    <div class="container">
      <TituloSectionComponent
        titulo="Elígenos"
        descripcion="Por qué alquilar en DREWS"
      />

      <div class="row">
        <div class="col">
          <div class="card-eligenos">
            <div class="numero">01</div>
            <div class="detalle">SERVICIO DE TRANSPORTE RÁPIDO</div>
          </div>
        </div>
        <div class="col">
          <div class="card-eligenos">
            <div class="numero">02</div>
            <div class="detalle">SOPORTE EN LÍNEA 24/7</div>
          </div>
        </div>
        <div class="col">
          <div class="card-eligenos">
            <div class="numero">03</div>
            <div class="detalle">SEGURIDAD Y CONFIABILIDAD</div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script setup>
import TituloSectionComponent from "@/Components/Web/TituloSectionComponent.vue";

</script>

<style lang="scss">
.inicio-eligenos {
  background-image: radial-gradient(#474bff 0.5px, transparent 0.5px);
  background-size: 13px 13px;
  background-color: #fff;

  .card-eligenos {
    padding: 1rem 3rem;
    text-align: center;

    height: 100%;
    background: rgba(255, 255, 255, 1);

    backdrop-filter: blur(15px);

    .numero {
      line-height: 6rem;
      margin-bottom: 1rem;
      font-weight: 800;
      color: transparent;
      letter-spacing: 4px;
      font-size: 5rem;
      text-transform: capitalize;
      -webkit-text-stroke-width: 1px;
      -webkit-text-stroke-color: rgba(100, 100, 100, 0.5);
    }
    .detalle {
      font-size: 1.1rem;
    }
  }
}
</style>
