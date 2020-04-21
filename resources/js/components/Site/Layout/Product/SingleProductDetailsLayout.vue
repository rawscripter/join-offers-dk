<template>
    <div class="product_view_main ">
        <!-- Primary carousel image -->

        <div class="show" href="1.jpg">
            <img :src="product.featureImage" id="show-img">
        </div>

        <!-- Secondary carousel image thumbnail gallery -->

        <div class="small-img">
            <img src="frontend/assets/img/product/next-icon.png" class="icon-left" alt="" id="prev-img">
            <div class="small-container">
                <div id="small-img-roll">
                    <img src="frontend/assets/img/product/1.png" class="show-small-img" alt="">
                    <img src="frontend/assets/img/product/2.png" class="show-small-img" alt="">
                    <img src="frontend/assets/img/product/3.png" class="show-small-img" alt="">
                    <img src="frontend/assets/img/product/4.png" class="show-small-img" alt="">
                </div>
            </div>
            <img src="frontend/assets/img/product/next-icon.png" class="icon-right" alt="" id="next-img">
        </div>

        <div class="timer text-center mt-2 mb-2">
            <vac :end-time="new Date(product.expire_date)">
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
                <span slot="finish" class="expired">Offer Expired!</span>
            </vac>
        </div>

        <h3 class="title mt-2 text-center">
            {{product.name}}
        </h3>
        <!-- discription div  -->
        <div class="discription">
            <p>{{product.full_des}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SingleProductDetailsLayout",
        props: ['product'],
    }
</script>

<style scoped>
    img#show-img {
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
</style>
