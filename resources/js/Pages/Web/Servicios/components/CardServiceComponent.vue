<template>
  <div class="card-shape">
    <div class="shapes">
      <div class="shape shape-1"></div>
      <div class="shape shape-2"></div>
      <div class="shape shape-3"></div>
      <div class="shape shape-4"></div>
    </div>
    <div class="card-icon">
      <i :class="item.figura"></i>
    </div>
    <div class="card-content">
      <div class="card-title"> {{ item.titulo }} </div>
      <div class="card-descripcion">
        {{ item.descripcion }}

      </div>

      <div class="card-button mt-4">


        <Link class="btn btn-dark w-100" :href="href"> Solicitar </Link>
          
      </div>
    </div>
  </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
 href: {
   type: String,
   default: '',
 },
 item: Array
});
</script>
<style lang="scss">
.card-shape {
  position: relative;
  background-color: #fff;
  -webkit-box-shadow: 0px 11px 38px 0px rgb(32 42 48 / 8%);
  box-shadow: 0px 11px 38px 0px rgb(32 42 48/ 8%);
  padding: 40px 40px 30px;
  border-radius: 5px;
  overflow: hidden;
  -webkit-transition: all 0.3s ease-out 0s;
  transition: all 0.3s ease-out;
  .shapes {
    .shape {
      position: absolute;
      content: "";
      top: 0;
      right: -100px;
      background-color: rgba($app-color1, 0.04);
      border-radius: 5px;
      -webkit-transform: rotate(45deg);
      transform: rotate(45deg);
      transition: all 0.5s ease-out;
    }
    .shape-1 {
      width: 150px;
      height: 150px;
      top: 28px;
    }
    .shape-2 {
      width: 170px;
      height: 170px;
      top: 20px;
    }
    .shape-3 {
      width: 190px;
      height: 190px;
      top: 10px;
    }
    .shape-4 {
      width: 210px;
      height: 210px;
      top: 0px;
    }
  }
  .card-icon {
    margin-bottom: 30px;
    i {
      width: 65px;
      height: 65px;
      line-height: 65px;
      text-align: center;
      background-color: $app-color1;
      color: #fff;
      border-radius: 10px;
      font-size: 36px;
      box-shadow: 0px 11px 20px 0px rgba($app-color1, 0.3);
      transition: all 0.4s ease-out;
    }
  }
  .card-title {
    margin-bottom: 18px;
    font-size: 25px;
    line-height: 35px;
    transition: all 0.4s ease-out;
  }
  .card-descripcion {
    color: #626262;
    margin: 0px;
    transition: all 0.3s ease-out;
  }
  &:hover {
    background-color: $app-color1;
    .shapes {
      .shape {
        background-color: rgba(255, 255, 255, 0.08);
      }
    }
    .card-icon {
      i {
        background-color: #fff;
        color: $app-color1;
      }
    }
    .card-title {
      color: white;
    }
    .card-descripcion {
      color: #ddd;
    }
  }
}
</style>
