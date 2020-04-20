<template>
    <div class="product_view_sidebar shadow">
        <div class="pricing-left">
            <h6><small>Gennemsnitlig markedsprice</small></h6>
            <h6>
                <del>{{product.market_price}},-</del>
            </h6>
            <h6>Strtpris </h6>
            <h6>
                <del>{{product.offer_price}},-</del>
            </h6>

            <h6><small>Deltagend</small></h6>
            <h6>{{product.total_offer_spots}}</h6>
            <h6><small>Din Pris</small></h6>
            <h6>{{product.last_price}}</h6>
            <!--            total save-->
            <button class="btn btn-success">Du sprarer 20%</button>
            <div class="love-section mt-2">
                <!--                total favourites-->
                <button class="btn btn-success">deltag</button>
                <button class="btn btn-success"> {{product.total_favourites}} <i class="far fa-heart"></i></button>
                <br>
            </div>
        </div>
        <div class="sidebar-action">
            <p><i class="far fa-heart"></i> Gem till favouriter</p>
            <p><i class="fas fa-sync"></i> Pamind mig</p>
            <p><i class="fas fa-sync"></i> Del pa</p>
        </div>
        <div class="sidebar-social">
            <a href="#"><i class="fab fa-facebook-square"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductOfferInfoSidebar",
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
    small {
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 1px;
    }
</style>
