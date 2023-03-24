<template>
    <div class="card-small">
        <Link class="card-wrapper shadow" :href="'/servicios/' + item.id">
            <span class="card-icon"> <i :class="item.figura"></i> </span>
            <span class="card-title"> {{ item.titulo }} </span>

            <div class="shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
            </div>
        </Link>
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    item: Object,
});
</script>
<style lang="scss">
.card-small {
    padding: 15px 15px 0px 15px;
    position: relative;
    margin-bottom: 30px;
    height: 100%;

    a.card-wrapper {
        overflow: hidden;
        background-color: white;

        .shapes {
            .shape {
                position: absolute;
                content: "";
                left: 0;
                top: -100px;
                background-color: rgba($app-color1, 0.04);
                border-radius: 5px;
                -webkit-transform: rotate(45deg);
                transform: rotate(45deg);
                transition: all 0.3s ease-out;
            }
            .shape-1 {
                width: 150px;
                height: 150px;
                left: calc(50% - 75px);
            }
            .shape-2 {
                width: 170px;
                height: 170px;
                left: calc(50% - 85px);
            }
            .shape-3 {
                width: 190px;
                height: 190px;
                left: 10px;
            }
            .shape-4 {
                width: 210px;
                height: 210px;
                left: 0px;
            }
        }
        text-decoration: none;
        padding: 40px 30px 35px;
        display: block;
        position: relative;
        border-radius: 10px;
        color: inherit;
        text-align: center;
        transition: all ease-in-out 0.5s;

        span {
            -webkit-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            display: flex;
            justify-content: center;
            align-items: center;
            i {
                -webkit-transition: all 0.3s ease 0s;
                -o-transition: all 0.3s ease 0s;
                transition: all 0.3s ease 0s;
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
            font-weight: 600;
            margin: 0 auto;
            text-align: center;
            transition: all 0.3s ease 0s;
            margin-bottom: 10px;
            font-family: $font-teko;
            letter-spacing: 0.8px;
            font-size: 1.5rem;
            &::after {
                content: "";
                width: 50%;
                height: 5px;
                background-color: $app-color1;
                position: absolute;
                bottom: 0;
            }
        }
    }

    &:hover {
        a {
            .shapes {
                .shape {
                    background-color: rgba(255, 255, 255, 0.08);
                }
            }
            background-color: $app-color1;

            .card-title {
                color: white;
            }
        }
    }
}
</style>
