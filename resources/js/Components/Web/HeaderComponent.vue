<template>
    <header class="web-header">
        <div ref="headerTop" class="header-top">
            <div class="container d-flex justyfy-content-between">
                <div class="top-left">
                    <!-- Button trigger modal -->
                    <button
                        type="button"
                        class="btn btn-light rounded-0 text-color1 fw-semibold"
                        @click="showModal = !showModal"
                    >
                        Cotizacion
                    </button>
                </div>

                <div class="top-right top-social">
                    <ul class="social-list">
                        <li class="social-item">
                            <a
                                class="item-link"
                                :href="web.social.facebook"
                                target="_blank"
                            >
                                <i class="fa-brands fa-square-facebook"></i>
                            </a>

                            <a
                                class="item-link"
                                :href="web.social.linkedin"
                                target="_blank"
                            >
                                <i class="fa-brands fa-linkedin"></i>
                            </a>

                            <a class="item-link" target="_blank">
                                <i class="fa-solid fa-location-dot me-2"></i>
                                <small
                                    >{{ web?.sedes[0]?.direccion }} -
                                    {{ setSede(web?.sedes[0]?.ubigeo) }}
                                </small>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-bot">
            <div class="container">
                <div class="bot-left">
                    <Link class="bot-logo" href="/">
                        <img :src="logo" alt="" />
                    </Link>
                </div>
                <div ref="header" class="bot-right">
                    <div class="bot-contact">
                        <ul class="contact d-none d-md-flex">
                            <li class="contact-item">
                                <div class="item-icon">
                                    <i
                                        class="fa-solid fa-mobile-screen-button"
                                    ></i>
                                </div>
                                <div class="item-content">
                                    <span class="item-title"> LLamanos</span>
                                    <span class="item-ref">
                                        {{ web.whatsapp }}
                                    </span>
                                </div>
                            </li>

                            <li class="contact-item">
                                <div class="item-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div class="item-content">
                                    <span class="item-title"> Escribenos</span>
                                    <span class="item-ref">
                                        {{ web.correo }}
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div
                class="header-bot-menu "
                :class="[
                    targetIsVisible ? '' : 'fixed shadow',
                    headerTopVisible ? '' : 'fixed-small shadow',
                ]"
            >
                <div class="container">
                    <Link class="bot-fixed-logo" href="/">
                        <img :src="logo" alt="" />
                    </Link>

                    <nav class="nav-menu">
                        <ul class="menu">
                            <li class="btn-menu d-lg-none">
                                <button
                                    type="button"
                                    class="btn btn-outline-dark"
                                    @click="showMenu = !showMenu"
                                >
                                    <i class="fa-solid fa-bars"></i>
                                </button>
                            </li>
                            <li
                                v-for="(item, index) in menu_items"
                                :key="index"
                                class="menu-item d-none d-lg-flex"
                                :class="
                                    router.page.url == item.href
                                        ? 'current'
                                        : ''
                                "
                            >
                                <Link class="item" :href="item.href">
                                    <i :class="item.icon"></i>

                                    <span>{{ item.name }}</span>
                                </Link>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <n-drawer v-model:show="showMenu" :width="320" placement="left">
            <n-drawer-content class="menu-drawer" title="Menu">
                <div class="shapes">
                    <div class="shape shape-1"></div>
                    <div class="shape shape-2"></div>
                    <div class="shape shape-3"></div>
                    <div class="shape shape-4"></div>
                </div>

                <nav class="menu-wrapper">
                    <ul class="menu-ul">
                        <li
                            class="menu-item"
                            v-for="(item, index) in menu_items"
                            :key="index"
                        >
                            <Link class="item" :href="item.href">
                                {{ item.name }}
                            </Link>
                        </li>
                    </ul>

                    <hr />
                    <ul class="contacts">
                        <li class="contact-item">
                            <div class="item-icon">
                                <i class="fa-solid fa-mobile-screen-button"></i>
                            </div>
                            <div class="item-content">
                                <span class="item-title"> LLamanos</span>
                                <span class="item-ref">
                                    {{ web.whatsapp }}
                                </span>
                            </div>
                        </li>

                        <li class="contact-item">
                            <div class="item-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="item-content">
                                <span class="item-title"> Escribenos</span>
                                <span class="item-ref">
                                    {{ web.correo }}
                                </span>
                            </div>
                        </li>
                    </ul>
                </nav>
            </n-drawer-content>
        </n-drawer>
    </header>
    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px"
            title="Cotizaciones"
            :bordered="false"
            size="huge"
            role="dialog"
            aria-modal="true"
        >
            <FormCotizacionComponent @onSubmit="showModal = false" />
        </n-card>
    </n-modal>

    <a
        class="btn-floating text-white"
        :href="
            'https://api.whatsapp.com/send?phone=%2B51' +
            web.whatsapp +
            '&text=Hola Grupo Drews:'
        "
        target="_blank"
    >
        <i class="fa-brands fa-whatsapp"></i>
    </a>
</template>

<script setup>
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import ubigeoJson from "@/../assets/data/ubigeo.json";
import { useElementVisibility } from "@vueuse/core";
import FormCotizacionComponent from "./FormCotizacionComponent.vue";
const header = ref(null);
const targetIsVisible = useElementVisibility(header);

const headerTop = ref(null);
const headerTopVisible = useElementVisibility(headerTop);

const logo = computed(() => usePage().props.web.logo);
const web = computed(() => usePage().props.web_data);

const showMenu = ref(false);

const showModal = ref(false);

const menu_items = [
    {
        name: "Inicio",
        href: "/",
        icon: "fa-solid fa-house",
    },
    {
        name: "Nosotros",
        href: "/nosotros",
        icon: "fa-solid fa-people-group",
    },

    {
        name: "Servicios",
        href: "/servicios",
        icon: "fa-brands fa-slack",
    },
    {
        name: "Vehiculos",
        href: "/vehiculos",
        icon: "fa-solid fa-car-side",
    },
    {
        name: "Clientes",
        href: "/clientes",
        icon: "fa-solid fa-users-between-lines",
    },
    {
        name: "Contactanos",
        href: "/contactanos",
        icon: "fa-solid fa-phone-volume",
    },
];

const getSede = (ubigeo) => ubigeoJson.filter((item) => item.ubigeo == ubigeo);

const setSede = (ubigeo) => {
    let aux = getSede(ubigeo)[0];
    return aux.departamento;
};
</script>

<style lang="scss">


/******  TEMA 1 ********* */
$bg-color-header-top: #1c1c1c;
$bg-color-header-bot: white;

/******  MENU ********* */
$bg-color-menu: #f8f9fa;
$color-menu-a: #757575;
/******  MENU:HOVER ********* */
$color-menu-a_hover: $app-color1;
$border-menu-a_hover: $app-color1;
/******  TEMA 1 ********* */


// /******  TEMA 1 ********* */
// $bg-color-header-top: #1c1c1c;
// $bg-color-header-bot: aliceblue;

// /******  MENU ********* */
// $bg-color-menu: $app-color1;
// $color-menu-a: rgb(194, 249, 211);
// /******  MENU:HOVER ********* */
// $color-menu-a_hover: white;
// $border-menu-a_hover: white;
// /******  TEMA 1 ********* */

$h-header-top: 50px;

.web-header {
    position: relative;
    background-color: white;
    z-index: 10;
 
    .header-top {
        background-color: $bg-color-header-top;
        .container {
            display: flex;
            justify-content: space-between;


            .top-right.top-social {
                ul.social-list {
                    height: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 0 0 0 15px;
                    position: relative;
                    z-index: 2;
                    clip-path: polygon(10px 0%, 100% 0%, 100% 100%, 0% 100%);

                    &::after {
                        content: "";
                        right: 0;
                        top: 0px;
                        bottom: 0px;
                        height: 100%;
                        width: 100%;
                        z-index: 1;
                        position: absolute;
                        background-color: rgba(255, 255, 255, 0.6);
                        clip-path: polygon(10px 0%, 12px 0%, 2px 100%, 0% 100%);
                    }

                    li.social-item {
                        a.item-link {
                            color: white;
                            font-size: 1.2rem;
                            padding: 0.3rem;
                            margin-left: 0.3rem;
                            transition: color 0.3s ease;
                            &:hover {
                                color: $app-color1;
                            }

                            small {
                                font-weight: 400;
                                font-size: 1rem;
                            }
                        }
                    }
                }
            }
        }
    }
    .header-bot {
        position: relative;
        background-color: $bg-color-header-bot;
        .container {
            height: 120px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            .bot-left {
                height: 100%;
                a.bot-logo {
                    display: block;
                    height: 100%;
                    width: 180px;
                    padding: 1rem 1rem 1rem 0rem;
             
                    img {
                        width: 100%;
                        height: 100%;
                        object-fit: contain;
                        object-position: center;
                    }
                }
            }

            .bot-right {
                .bot-contact {
                    height: 80px;

                    .contact {
                        display: flex;
                        height: 80px;
                        font-family: $font-raj;
                        .contact-item {
                            display: flex;
                            padding: 10px 0px;
                            .item-icon {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                padding: 10px;
                                width: 60px;
                                font-size: 40px;
                                color: $app-color1;
                            }
                            .item-content {
                                display: flex;
                                flex-wrap: wrap;
                                span {
                                    width: 100%;
                                    font-weight: 400;
                                    &:first-child {
                                        font-weight: 700;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        .header-bot-menu {
            height: 80px;
            transform: translateY(40px);
            width: 100%;

            position: absolute;
            bottom: 0;
            right: 0;

            &.fixed {
                position: fixed;
                top: 0;
                transform: translateY(0px);
                background-color: $bg-color-header-bot;

                .container {
                    justify-content: space-between;
                    .bot-fixed-logo {
                        width: 150px;
                        visibility: visible;
                        opacity: 1;
                    }
                }
            }
            &::before {
                position: absolute;
                content: "";
                top: 0;
                right: 0;
                height: 100%;
                width: 35vw;
                background-color: $bg-color-menu;
            }
            .container {
                height: 100%;
                display: flex;
                justify-content: end;

                .bot-fixed-logo {
                    height: 100%;
                    width: 180px;
                    opacity: 0;
                    visibility: hidden;
                    padding: 0.5rem 0.5rem 0.5rem 0rem;

                    img {
                        width: 100%;
                        height: 100%;
                        object-fit: contain;
                    }
                }

                nav.nav-menu {
                    height: 100%;

                    ul.menu {
                        display: flex;
                        justify-content: center;
                        height: 100%;
                        background-color: $bg-color-menu;
                        clip-path: polygon(
                            40px 0%,
                            100% 0%,
                            100% 100%,
                            0% 100%
                        );
                        padding-left: 100px;

                        li.btn-menu {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }

                        li.menu-item {
                            a.item {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                color: $color-menu-a;
                                height: 100%;
                                padding: 0 1rem;
                                font-family: $font-raj;
                                font-weight: 600;
                                font-size: 1.1rem;
                                transition: all 0.3s ease-in-out;
                                border-bottom: 3px solid transparent;

                                i {
                                    font-size: 0.8rem;
                                    margin-right: 0.5rem;
                                }
                            }

                            &.current,
                            &:hover {
                                a.item {
                                    color: $color-menu-a_hover;
                                    border-bottom: 3px solid
                                        $border-menu-a_hover;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

.n-drawer-content-wrapper {
    .shapes {
        .shape {
            position: absolute;
            content: "";
            top: 100;
            left: -180px;
            background-color: rgba($app-color1, 0.04);
            border-radius: 5px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            transition: all 0.5s ease-out;
            z-index: 1;
        }
        .shape-1 {
            width: 250px;
            height: 350px;
            top: 120px;
        }
        .shape-2 {
            width: 270px;
            height: 370px;
            top: 110px;
        }
        .shape-3 {
            width: 290px;
            height: 390px;
            top: 100px;
        }
        .shape-4 {
            width: 310px;
            height: 410px;
            top: 90px;
        }
    }

    nav.menu-wrapper {
        position: relative;
        z-index: 2;

        .menu-ul {
            .menu-item {
                a.item {
                    font-family: $font-raj;
                    font-weight: 600;
                    letter-spacing: 0.8px;
                    text-decoration: none;
                    color: inherit;
                    display: block;
                    padding: 10px 20px;
                    &:hover {
                        color: $app-color1;
                        background-color: rgba($app-color1, 0.1);
                    }
                }
            }
        }
        .contacts {
            display: flex;
            flex-wrap: wrap;
            .contact-item {
                display: flex;
                padding: 10px 0px;
                width: 100%;
                .item-icon {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    width: 50px;
                    font-size: 1.5rem;
                    color: $app-color1;
                }
                .item-content {
                    display: flex;
                    flex-wrap: wrap;
                    span {
                        width: 100%;
                        font-weight: 400;
                        font-family: $font-raj;
                        font-size: 1rem;
                        &:first-child {
                            font-weight: 700;
                        }
                    }
                }
            }
        }
    }
}

@media (max-width: 992px) {
    .web-header {
        .header-top {
            .container {
                .top-right.top-social {
                    ul.social-list {
                        li.social-item {
                            a.item-link {
                                small {
                                    font-size: 0.8rem;
                                }
                            }
                        }
                    }
                }
            }
        }

        .header-bot {
            .container {
                .bot-left {
                    .bot-logo {
                        width: 150px;
                    }
                }
            }

            .header-bot-menu {
                .container {
                    .bot-fixed-logo {
                        width: 130px;
                    }
                    nav.nav-menu {
                        ul.menu {
                            li.menu-item {
                                a.item {
                                    padding: 0 0.8rem;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

@media (max-width: 992px) {
    .web-header {
        .header-top {
            .container {
                .top-right.top-social {
                    ul.social-list {
                        li.social-item {
                            a.item-link {
                                small {
                                    display: none;
                                    font-size: 0.8rem;
                                }
                            }
                        }
                    }
                }
            }
        }

        .header-bot {
            height: 80px;
            .container {
                height: 80px;

                .bot-left {
                    .bot-logo {
                        width: 130px;
                    }
                }

                .bot-right {
                    display: none;
                }
            }

            .header-bot-menu {
                height: 80px;
                transform: translateY(-80px);
                width: 100%;
                position: relative;
                bottom: 0;
                right: 0;

                &.fixed-small {
                    position: fixed;
                    top: 0;
                    transform: translateY(0px);
                    background-color: aliceblue;

                    .container {
                        justify-content: space-between;
                        .bot-fixed-logo {
                            width: 120px;
                            visibility: visible;
                            opacity: 1;
                        }
                    }
                }

                &::before {
                    clip-path: polygon(40px 0%, 100% 0%, 100% 100%, 0% 100%);
                }
            }
        }
    }
}

.btn-floating {
    position: fixed;
    bottom: 1rem;
    right: 1rem;
    z-index: 10;
    border-radius: 50%;
    background-color: #25d366;
    height: 3.5em;
    width: 3.5em;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: all 0.3s ease-in;
    i {
        font-size: 2rem;
    }

    &:hover {
        background-color: rgba($color: #000000, $alpha: 0.8);
    }
}
</style>
