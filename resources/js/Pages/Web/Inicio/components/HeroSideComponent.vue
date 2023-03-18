<template>
    <section class="hero-side">
        <div class="side-wrapper">
            <video
                class="video"
                muted
                autoplay
                loop
                poster="@/assets/static/img/preview_vide.png"
            >
                <source
                    src="@/assets/static/video/main-video.mp4"
                    type="video/mp4"
                />
                Your browser does not support the video tag.
            </video>

            <div class="slide-content">
                <div class="container">
                    <span class="slide-title">
                        Más de 10 años de experiencia
                    </span>
                    <span class="slide-subtitle">
                        Ofresiendote las mejores soluciones
                    </span>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup></script>
<style lang="scss">
.hero-side {
    position: relative;

    .side-wrapper {
        width: 100%;
        height: 600px;
        overflow: hidden;
        position: relative;

        video.video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        .slide-content {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgb(12, 127, 64);
            background: linear-gradient(
                54deg,
                rgba(12, 127, 64, 1) 0%,
                rgba(4, 183, 190, .2) 59%,
                rgba(0, 212, 255, .1) 100%
            );
            .container {
                .slide-title {
                    color: white;
                    display: block;
                    font-size: 3.5rem;
                    font-family: $font-teko;
                    font-weight: 800;
                }
                .slide-subtitle {
                    color: #eee;
                    display: block;
                    font-size: 2rem;
                    font-family: $font-teko;
                    letter-spacing: 1.5px;
                }
            }
        }
    }
}
</style>
