<template>
    <section class="hero-side">
        <div class="side-wrapper">
            <video class="video" muted autoplay loop>
                <source
                    src="@/assets/static/video/main-video.mp4"
                    type="video/mp4"
                />
                Your browser does not support the video tag.
            </video>

            <div class="slide-content">
                <div class="container">
                    <h1>sdfasfa</h1>
                    <h4>asdasd</h4>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup></script>
<style lang="scss">
.hero-side {
    background-color: aqua;
    .side-wrapper {
        width: 100%;
        height: 600px;
        overflow: hidden;
        background-color: #eee;
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
            .container {
                background-color: aqua;
            }
        }
    }
}
</style>
