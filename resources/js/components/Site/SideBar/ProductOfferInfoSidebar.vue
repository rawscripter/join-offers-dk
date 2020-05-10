<template>
    <div class="product_view_sidebar shadow">
        <div class="pricing-left">
            <h6>Gennemsnitlig markedsprice</h6>
            <h5>
                <del>{{product.market_price}},-</del>
            </h5>
            <h6>Strtpris </h6>
            <h5>
                <del>{{product.offer_price}},-</del>
            </h5>
            <h6>Deltagend</h6>
            <h5>{{product.totalOrders}}</h5>
            <h6>Din Pris</h6>
            <h5>{{product.current_price}}</h5>
            <!--            total save-->
            <br>
            <div class="love-section">
                <button v-if="product.isLikedByCurrentUser" @click="removeProductToFavouriteList(product.slug)"
                        class="btn btn-success"> {{product.total_favourites}} <i class="fas fa-heart"
                                                                                 style="color:red"></i></button>
                <button v-else @click="addProductToFavouriteList(product.slug)" class="btn btn-success">
                    {{product.total_favourites}} <i class="far fa-heart"></i></button>
            </div>
            <button class="btn mt-1 btn-success">Du sprarer {{product.saving_percentage}}%</button>
        </div>
        <div class="checkout mt-3 mb-3">
            <router-link v-if="!isExpired" class="btn btn-theme btn-block" tag="div"
                         :to="{name: 'checkout', params:{slug:product.slug}}">
                Order Now
            </router-link>
        </div>

        <div class="sidebar-action">
            <p><i class="far fa-heart"></i> Gem till favouriter</p>
            <p><i class="fas fa-sync"></i> Pamind mig</p>
            <p><i class="fas fa-sync"></i> Del pa</p>
            <div class="sidebar-social mt-2 d-flex justify-content-around">
                <a href="#"><i class="fab fa-facebook-square"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ProductOfferInfoSidebar",
        props: ['product'],
        data() {
            return {}
        },
        methods: {
            addProductToFavouriteList(slug) {
                axios.get(`/api/product/${slug}/favourite/add`)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.product.isLikedByCurrentUser = true;
                            this.product.total_favourites++;
                        }
                    }).catch(err => console.log(err));
            },
            removeProductToFavouriteList(slug) {
                axios.get(`/api/product/${slug}/favourite/remove`)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.product.isLikedByCurrentUser = false;
                            this.product.total_favourites--;
                        }
                    }).catch(err => console.log(err));
            }
        },
        computed: {
            isExpired() {
                let now = new Date();
                let expire = new Date(this.product.expire_date);
                return now > expire;
            },
            isLiked() {
                return this.product.isLikedByCurrentUser;
            },
            totalLiked() {
                return this.product.total_favourites;
            },
        }
    }
</script>

<style scoped>
    small {
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    h5 {
        font-weight: 700;
        font-size: 17px;
    }
</style>
