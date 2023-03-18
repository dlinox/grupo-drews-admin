<template>
    <header class="web-header">
        <div class="header-top">
            <div class="container d-flex justyfy-content-between">
                <div class="top-left">
                    <!-- Button trigger modal -->
                    <button
                        type="button"
                        class="btn btn-color1 rounded-0"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal"
                    >
                        Cotizacion
                    </button>
                </div>

                <div class="top-right top-social">
                    <ul class="social-list">
                        <li
                            class="social-item"
                            v-for="(item, index) in web.social"
                            :key="index"
                        >
                            <a v class="item-link" :href="item" target="_blank">
                                <i :class="'fa-brands fa-square-' + index"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-bot">
            <div class="container">
                <div class="bot-left">
                    <div class="bot-logo">
                        <img :src="logo" alt="" />
                    </div>
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
                class="header-bot-menu"
                :class="targetIsVisible ? '' : 'fixed shadow'"
            >
                <div class="container">
                    <div class="bot-fixed-logo">
                        <img :src="logo" alt="" />
                    </div>

                    <nav class="nav-menu">
                        <ul class="menu">
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
                    </nav>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

import { useElementVisibility } from "@vueuse/core";
const header = ref(null);
const targetIsVisible = useElementVisibility(header);

const logo = computed(() => usePage().props.web.logo);
const web = computed(() => usePage().props.web_data);

const menu_items = [
    {
        name: "Inicio",
        href: "/",
    },
    {
        name: "Servicios",
        href: "/servicios",
    },
    {
        name: "Vehiculos",
        href: "/vehiculos",
    },
    {
        name: "Contactanos",
        href: "/contactanos",
    },
    {
        name: "Nosotros",
        href: "/nosotros",
    },
];
</script>

<style lang="scss">
$h-header-top: 50px;

.web-header {
    position: relative;
    z-index: 10;
    .header-top {
        background-color: black;
        .container {
            display: flex;
            justify-content: space-between;
            //.top-left{}
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
                        }
                    }
                }
            }
        }
    }
    .header-bot {
        position: relative;
        background-color: aliceblue;
        .container {
            height: 120px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            .bot-left {
                height: 100%;
                .bot-logo {
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
                background-color: aliceblue;

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
                background-color: $app-color1;
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
                        background-color: $app-color1;
                        clip-path: polygon(
                            40px 0%,
                            100% 0%,
                            100% 100%,
                            0% 100%
                        );
                        padding-left: 40px;
                        li.menu-item {
                            a.item {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                color: white;
                                height: 100%;
                                padding: 0 1.2rem;
                                font-family: $font-raj;
                                font-weight: 600;
                                font-size: 1.2rem;
                            }
                        }
                    }
                }
            }
        }
    }
}
</style>
