<template>
    <div id="header_video">
        <div class="p-2 text-center pointer-cursor" @click="showVideo = !showVideo">
            <img src="/images/JoinOffers-video-title.png" height="100" alt="">
            <img src="/images/JoinOffers---ikon---Play-video-knap.png" class="ml-2" height="60" alt="">
        </div>
        <div class="show-video text-center" v-if="showVideo">
            <iframe style="width: 100%" height="480" src="https://www.youtube.com/embed/rrT6v5sOwJg"
                    frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        </div>
    </div>
</template>

<script>
    export default {
        name: "HeaderVideoSection",
        data() {
            return {
                showVideo: false
            }
        },


    }
</script>


<style scoped>
    .pointer-cursor {
        cursor: pointer !important;
    }

    .p-2.text-center.pointer-cursor {
        max-width: 450px !important;
        margin: 0 auto;
    }

    #header_video {
        margin-bottom: 20px;
    }
</style>
