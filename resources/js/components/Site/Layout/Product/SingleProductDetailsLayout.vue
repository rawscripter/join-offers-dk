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
        <div class="timer-area d-flex justify-content-center mt-3 mb-3">
            <div class="clock">
                <div class="well top-pane">
                    <div id="days-text" class="text">Dage</div>
                </div>
                <div class="well bottom-pane">
                    <div id="days" class="num">{{timer.days}}</div>
                </div>
            </div>
            <div class="clock">
                <div class="well top-pane">
                    <div id="hours-text" class="text">Timer</div>
                </div>
                <div class="well bottom-pane">
                    <div id="hours" class="num">{{timer.hours}}</div>
                </div>
            </div>
            <div class="clock">
                <div class="well top-pane">
                    <div id="mins-text" class="text">Min.</div>

                </div>
                <div class="well bottom-pane">
                    <div id="mins" class="num">{{timer.minutes}}</div>
                </div>
            </div>

            <div class="clock">
                <div class="well top-pane">
                    <div id="secs-text" class="text">Sek</div>
                </div>
                <div class="well bottom-pane">
                    <div id="secs" class="num">{{timer.seconds}}</div>
                </div>
            </div>
            <!-- <div id="info" class="small"></div> -->
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
        data() {
            return {
                timer: {
                    days: 0,
                    hours: 0,
                    minutes: 0,
                    seconds: 0,
                }
            }
        },
        created() {
            this.setProductTimer()
        },
        methods: {
            setProductTimer() {
                let dateFuture = new Date(this.product.expire_date);
                let dateNow = new Date();

                let seconds = Math.floor((dateFuture - (dateNow)) / 1000);
                let minutes = Math.floor(seconds / 60);
                let hours = Math.floor(minutes / 60);
                let days = Math.floor(hours / 24);

                this.timer.days = days;
                this.timer.hours = hours - (days * 24);
                this.timer.minutes = minutes - (days * 24 * 60) - (hours * 60);
                this.timer.seconds = seconds - (days * 24 * 60 * 60) - (hours * 60 * 60) - (minutes * 60);

            }
        }
    }


</script>

<style scoped>
    img#show-img {
        max-width: 100%;
    }
</style>
