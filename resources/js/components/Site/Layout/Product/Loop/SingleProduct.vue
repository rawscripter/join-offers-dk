<template>
    <div class="prodcut-signle p-2">
        <div class="product_image">
            <router-link :to="{name: 'product-details', params:{slug:product.slug}}">
                <img :src="product.featureImage" alt="" style="width:100%">
            </router-link>
        </div>
        <div class="p_category_and_love d-flex justify-content-between">
            <div class="category">
                <router-link :to="{name:'category-product',params:{category:product.categoryData.slug}}">
                    {{product.categoryData.name}}
                </router-link>
            </div>
            <div class="icons d-flex">
                <div class="share mr-2" @click="showModal = true">
                    <i class="fas fa-share theme-color"></i>
                </div>
                <div class="love" v-if="isLiked" >
                    <i class="fas fa-heart"
                       style="color:red;"></i>
                    <span> {{totalLiked}}</span>
                </div>
                <div class="love" v-else @click="addProductToFavouriteList(product.slug)">
                    <i class="far fa-heart"
                       style="color:red;"></i>
                    <span> {{totalLiked}}</span>
                </div>
            </div>

        </div>
        <hr class="m-0 p-0">
        <h5 class="product_title text-center pt-2 pb-2">
            <router-link :to="{name: 'product-details', params:{slug:product.slug}}">
                {{product.name}}
                <br>
            </router-link>
        </h5>

        <div class="timer text-center mt-2 mb-2">
            <vac v-if="isOfferTimeStarted" :end-time="new Date(product.expire_date)">
                <div
                    class="timer-area d-flex justify-content-center mt-3 mb-3"
                    slot="process"
                    slot-scope="{ timeObj }">
                    <div class="clock">
                        <div class="well bottom-pane">
                            <div id="days" class="num">{{timeObj.d}}</div>
                        </div>
                        <div class="well top-pane">
                            <div class="text"><strong>Day</strong></div>
                        </div>

                    </div>

                    <div class="clock">
                        <div class="well bottom-pane">
                            <div id="hours" class="num">{{timeObj.h}}</div>
                        </div>
                        <div class="well top-pane">
                            <div class="text"><strong>Hour</strong></div>
                        </div>

                    </div>
                    <div class="clock">
                        <div class="well bottom-pane">
                            <div id="mins" class="num">{{timeObj.m}}</div>
                        </div>
                        <div class="well top-pane">
                            <div class="text"><strong>Min</strong></div>
                        </div>

                    </div>

                    <div class="clock">
                        <div class="well bottom-pane">
                            <div id="secs" class="num">{{timeObj.s}}</div>
                        </div>
                        <div class="well top-pane">
                            <div id="days-text" class="text"><strong>Sec</strong></div>
                        </div>

                    </div>
                </div>
                <span slot="finish" class="expired">Offer Expired!</span>
            </vac>
            <span v-else class="expired">
                Coming Soon
            </span>
        </div>


        <div class="short-description">
            <p class="text-center">{{product.short_des}} </p>
        </div>
        <div class="pricing-section d-flex justify-content-start">
            <div class="pricing-left">
                <h6><small>Gennemsnitlig markedsprice</small></h6>
                <h5>
                    <del>{{product.market_price}} dkk,-</del>
                </h5>
                <h6>Strtpris </h6>
                <h5>
                    <del>{{product.offer_price}} dkk,-</del>
                </h5>
                <h6>Du sprarer </h6>
                <button class="btn btn-success btn-sm">{{product.saving_percentage}}%</button>
            </div>
            <div class="pricing-right">
                <h6><small>Deltagend</small></h6>
                <h5>{{product.totalOrders}}</h5>
                <h6><small>Din Pris</small></h6>
                <h5>{{product.current_price}} dkk</h5>
            </div>
        </div>
        <router-link class="btn btn-success btn-block mt-3" tag="button"
                     :to="{name: 'product-details', params:{slug:product.slug}}">
            Laes mere
        </router-link>

    </div>
</template>

<script>
    export default {
        name: "SingleProduct",
        props: ['product'],
        data() {
            return {
                showModal: false
            }
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
            isLiked() {
                return this.product.isLikedByCurrentUser;
            },
            totalLiked() {
                return this.product.total_favourites;
            },
            isOfferTimeStarted() {
                let startDate = new Date(this.product.offer_start_date);
                let current_date = Date.now();
                return current_date > startDate;
            },
        },
    }
</script>

<style scoped>
    .love {
        cursor: pointer;
    }

    .share {
        cursor: pointer;
    }

    .bottom-pane {
        margin-top: 0px;
        border-radius: 5px;
        background-color: #eaeaea;
        padding: 5px;
        border: 0px;
        text-align: center;
        width: 35px;
    }

    .num {
        font-size: 16px;
        color: #000;
        font-weight: bold;
    }

    span.expired {
        font-weight: bold;
        color: red;
        font-size: 18px;
    }

    h5 {
        font-weight: 700;
        font-size: 17px;
    }

    .category a {
        text-decoration: none;
        color: unset;
    }

    .active {
        display: block;
    }
</style>
