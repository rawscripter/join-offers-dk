<template>
    <div class="product_view_main ">
        <!-- Primary carousel image -->

        <div class="show">
            <img :src="displayProductImage" id="mainImage">

        </div>
        <!-- Secondary carousel image thumbnail gallery -->
        <div v-if="hasImages" class="small-img">
            <div class="image-container">
                <img v-for="(image,index) in product.productImages"
                     :src="image.thumbImage"
                     @click="changeMainImage(index)"
                     :class="{active : active_img === index}"
                     class="show-small-img" alt="">
            </div>
        </div>

        <div class="timer text-center mt-2 mb-2">
            <vac v-if="isOfferTimeStarted" :end-time="new Date(product.expire_date)">
                <div
                    class="timer-area d-flex justify-content-center mt-3 mb-3"
                    slot="process"
                    slot-scope="{ timeObj }">
                    <div class="clock">
                        <div class="well top-pane">
                            <div id="days-text" class="text">Dage</div>
                        </div>
                        <div class="well bottom-pane">
                            <div id="days" class="num">{{timeObj.d}}</div>
                        </div>
                    </div>

                    <div class="clock">
                        <div class="well top-pane">
                            <div id="hours-text" class="text">Timer</div>
                        </div>
                        <div class="well bottom-pane">
                            <div id="hours" class="num">{{timeObj.h}}</div>
                        </div>
                    </div>
                    <div class="clock">
                        <div class="well top-pane">
                            <div id="mins-text" class="text">Min.</div>

                        </div>
                        <div class="well bottom-pane">
                            <div id="mins" class="num">{{timeObj.m}}</div>
                        </div>
                    </div>

                    <div class="clock">
                        <div class="well top-pane">
                            <div id="secs-text" class="text">Sek</div>
                        </div>
                        <div class="well bottom-pane">
                            <div id="secs" class="num">{{timeObj.s}}</div>
                        </div>
                    </div>
                </div>
                <span slot="finish" class="expired">Tilbuddet er udløbet</span>
            </vac>
            <span v-else class="expired">
                Kommer snart
            </span>
        </div>

        <h3 class="title mt-2 text-center">
            {{product.name}}
        </h3>
        <!-- discription div  -->
        <div class="discription" v-html="product.full_des">
        </div>
        <br>
        <h5 class="mt-2"><strong>Ordrenotat:</strong></h5>
        <div class="orderNote" v-html="product.order_note">
        </div>
    </div>
</template>

<script>

    export default {
        name: "SingleProductDetailsLayout",
        props: ['product'],

        data() {
            return {
                displayProductImage: this.product.featureImage,
                active_img: null
            }
        },
        methods: {
            changeMainImage(index) {
                this.active_img = index;
                this.displayProductImage = this.product.productImages[index].featureImage;
            },
        },
        computed: {
            hasImages() {
                return this.product.productImages.length > 0;
            },
            isOfferTimeStarted() {
                let startDate = new Date(this.product.offer_start_date);
                let current_date = Date.now();
                return current_date > startDate;
            }
        }
    }
</script>

<style scoped>
    img#mainImage {
        max-width: 100%;
    }

    .clock {
        width: 65px;
    }

    .bottom-pane {
        background-color: rgb(255, 124, 59) !important;
        border-color: rgb(255, 175, 128) !important;
        background-image: linear-gradient(to right, #ff3e00, #ffa74d);
        color: #fff !important;
    }

    .num {
        font-size: 25px;
        color: #fff;
        font-weight: bold;
    }

    span.expired {
        font-weight: bold;
        font-size: 30px;
        text-align: center;
        margin: 50px !important;
        color: #ff2525;
    }

    .image-container img {
        max-width: 65px;
        margin-right: 10px;
        cursor: pointer;
    }

    .image-container {
        display: flex;
        justify-content: center;
    }

    .discription {
        white-space: pre-wrap;
    }

    img.show-small-img.active {
        border: 2px solid #ff500d;
    }

</style>
