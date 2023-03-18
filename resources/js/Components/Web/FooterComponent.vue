<template>
    <footer class="footer">
        <div class="container py-5">
            <div class="row">
                <div
                    class="col-6 col-lg-4 d-flex justify-content-start align-items-center"
                >
                    <img width="150" :src="logo" alt="" />
                </div>
                <div class="col-6 col-lg-4">
                    <h6 class="text-white mb-3 title-footer">Menu</h6>
                    <ul class="list-style-none">
                        <li v-for="(item, index) in menu_items" :key="index">
                            <Link :href="item.href">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                >
                                </i>
                                {{ item.name }}
                            </Link>
                        </li>
                    </ul>
                </div>
                <div class="col-6 col-lg-4">
                    <h6 class="text-white mb-3 title-footer">Servicios</h6>
                    <ul>
                        <li>
                            <Link href="/">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Corporativo
                            </Link>
                        </li>
                        <li>
                            <Link href="/">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Particular</Link
                            >
                        </li>
                        <li>
                            <Link href="/">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Serv. Aeropuerto</Link
                            >
                        </li>
                        <li>
                            <Link href="/">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Por ubicaion</Link
                            >
                        </li>
                        <li>
                            <Link href="/">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Servicio de chofer</Link
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copy w-100 bg-white">
            <div class="container text-center py-3 text-muted">
                <small
                    >© Copyright
                    <span class="text-color1 fw-bold">GrupoDrews</span> . All
                    Rights Reserved</small
                >
            </div>
        </div>
    </footer>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const logo =
    "https://www.grupodrews.com.pe/wp-content/uploads/2019/06/logo.png";

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
.footer {
    background-color: rgb(20, 20, 20);

    .title-footer{
        font-family: $font-teko;
        letter-spacing: 1px;
        font-size: 1.3rem;
    }
    a {
        font-family: $font-raj;
        text-decoration: none;
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        color: #aaa;

        i {
            font-size: 0.8rem;
            margin-right: 8px;
            transition: transform 0.3s ease-in;
        }
        &:hover {
            color: white;
            i {
                transform: translateX(5px);
            }
        }
    }
    ul {
        list-style: none;
        padding: 0;
    }
}
</style>
