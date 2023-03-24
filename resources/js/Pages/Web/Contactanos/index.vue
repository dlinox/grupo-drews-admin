<template>
    <WebLayout>
        <HeadingPageComponent titulo="Contactanos" />
        <main class="main">
            <section class="section-info-contacto py-5">
                <div class="container">
                    <div class="row shadow g-0 overflow-hidden">
                        <div class="col-12 col-md-6">
                            <div class="titulo-concant">
                                Envíanos un mensaje

                                <hr />
                            </div>
                            <div class="px-3 pb-4">
                                <FormContactoComponent />
                            </div>
                        </div>
                        <div class="col-12 col-md-6 bg-color1">
                            <div class="info-contacto pb-4">
                                <div class="titulo-concant text-white">
                                    Información contacto
                                    <hr />
                                </div>
                                <div class="row gy-3 px-3 pb-4">

                                    <div class="col-12 item-contact">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-titulo">
                                                    Números de contacto:
                                                </div>
                                                <div class="card-icon">
                                                    <i
                                                        class="fa-solid fa-phone"
                                                    ></i>
                                                </div>
                                                <div class="card-content">
                                                    <ul>
                                                        <li>
                                                            <a href="">
                                                                {{
                                                                    web.whatsapp
                                                                }}
                                                            </a>
                                                        </li>

                                                        <li
                                                            v-for="(
                                                                item, index
                                                            ) in web.sedes"
                                                        >
                                                            <a v-if="index < 3" href="">
                                                                {{
                                                                    item.celulares
                                                                }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 item-contact">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-titulo">
                                                    Correo de contacto:
                                                </div>
                                                <div class="card-icon">
                                                    <i
                                                        class="fa-solid fa-envelope"
                                                    ></i>
                                                </div>
                                                <div class="card-content">
                                                    <ul>
                                                        <li>
                                                            <a href="">
                                                                {{ web.correo }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 item-contact">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-titulo">
                                                    Ubícanos en:
                                                </div>
                                                <div class="card-icon">
                                                    <i
                                                        class="fa-solid fa-location-dot"
                                                    ></i>
                                                </div>
                                                <div class="card-content">
                                                    <ul>
                                                        <li
                                                            v-for="(
                                                                item, index
                                                            ) in web.sedes"
                                                        >
                                                            <a href="">
                                                                <h4>
                                                                    {{
                                                                       setSede(item.ubigeo)
                                                                    }}
                                                                </h4>
                                                                <span>
                                                                    {{
                                                                        item.direccion
                                                                    }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-mapa">
                <iframe
                    class="iframe"
                    src="https://www.google.com/maps/d/u/0/embed?mid=1WO9L_l9Zeli4AJrSn9J4OHfOOGdlk4E&ehbc=2E312F"
                ></iframe>
            </section>
        </main>
    </WebLayout>
</template>

<script setup>
import WebLayout from "@/Layouts/WebLayout.vue";
import HeadingPageComponent from "../../../Components/Web/HeadingPageComponent.vue";
import FormContactoComponent from "./components/FormContactoComponent.vue";


import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

import ubigeoJson from "@/../assets/data/ubigeo.json";

const web = computed(() => usePage().props.web_data);


const getSede = (ubigeo) => ubigeoJson.filter((item) => item.ubigeo == ubigeo);

const setSede = (ubigeo) => {
    let aux = getSede(ubigeo)[0];
    return aux.departamento + " - " + aux.provincia + " - " + aux.distrito;
};


</script>
<style lang="scss">
.section-info-contacto {
    .titulo-concant {
        font-size: 2rem;
        padding: 1rem;
        font-family: $font-teko;
        letter-spacing: 1px;
    }
    .info-contacto {
        .item-contact {
            .card {
                background-color: white;
                .card-body {
                    display: flex;
                    flex-wrap: wrap;
                    padding: 1.2rem;

                    .card-titulo {
                        width: 100%;
                        font-weight: 600;
                        margin-bottom: 1em;
                        font-family: $font-teko;
                        font-size: 1.3rem;
                    }
                    .card-icon {
                        width: 100px;
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
                    .card-content {
                        width: auto;
                        ul {
                            li {
                                a {
                                    text-decoration: none;
                                    color: inherit;

                                    font-family: $font-raj;
                                    font-weight: 500;
                                    h4{
                                        font-size: 1rem;
                                        font-weight: 600;

                                    }
                                   
                                }
                                margin-bottom: 1rem;
                            }
                        }
                    }
                }
            }
        }
    }
}

.section-mapa {
    width: 100%;
    height: 100%;
    .iframe {
        width: 100%;
        height: 450px;
    }
}
</style>
