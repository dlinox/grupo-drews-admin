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
                    <h6 class="text-white mb-3">Menu</h6>
                    <ul class="list-style-none">
                        <li>
                            <a href="/">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Inicio
                            </a>
                        </li>
                        <li>
                            <a href="/vehiculos"
                                ><i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Automoviles</a
                            >
                        </li>
                        <li>
                            <a href="/servicios">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Servicios</a
                            >
                        </li>
                        <li>
                            <a href="/nosotros">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Nosotros</a
                            >
                        </li>
                        <li>
                            <a href="/contactanos">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Contacto</a
                            >
                        </li>
                    </ul>
                </div>
                <div class="col-6 col-lg-4">
                    <h6 class="text-white mb-3">Servicios</h6>
                    <ul>
                        <li>
                            <a href="/">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Corporativo
                            </a>
                        </li>
                        <li>
                            <a href="/">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Particular</a
                            >
                        </li>
                        <li>
                            <a href="/">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Serv. Aeropuerto</a
                            >
                        </li>
                        <li>
                            <a href="/">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Por ubicaion</a
                            >
                        </li>
                        <li>
                            <a href="/">
                                <i
                                    class="fa-solid fa-circle-arrow-right text-color1"
                                ></i>
                                Servicio de chofer</a
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
const logo =
    "https://www.grupodrews.com.pe/wp-content/uploads/2019/06/logo.png";
</script>

<style lang="scss">
.footer {
    background-color: rgb(20, 20, 20);
    a {
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
