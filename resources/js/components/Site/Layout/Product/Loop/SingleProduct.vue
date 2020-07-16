<template>
    <div class="prodcut-signle p-2">
        <div class="product_image">
            <router-link :to="{name: 'product-details', params:{slug:product.slug}}">
                <img :src="product.featureImage" alt="" style="width:100%">
            </router-link>
            <span class="favourite-badge" @click="removeProductToFavouriteList(product.slug)" v-if="isUserFavourite">
                Favourite
            </span>
        </div>
        <div class="p_category_and_love d-flex justify-content-between">
            <div class="category">
                <router-link :to="{name:'category-product',params:{category:product.categoryData.slug}}">
                    {{product.categoryData.name}}
                </router-link>
            </div>
            <div class="icons d-flex">
                <div class="share mr-2" @click="showModal = true">
                    <img src="/images/icons/share.png" height="16" width="16" alt="">
                </div>

                <div class="share mr-2" @click="addProductToFavouriteList(product.slug)" v-if="!isUserFavourite">
                    <img src="/images/icons/favorite.png" height="16" alt="">
                </div>
                <div class="love" v-if="isUserLiked">
                    <i class="fas fa-heart"
                       style="color:red;"></i>
                    <span> {{totalLikes}}</span>
                </div>

                <div class="love" v-else @click="addProductToLikeList(product.slug)">
                    <i class="far fa-heart"
                       style="color:red;"></i>
                    <span> {{totalLikes}}</span>
                </div>

                <div class="eye ml-2">
                    <i class="fas fa-eye" style="color: #7e7b7a"></i>
                    <span> {{product.total_clicks}}</span>
                </div>
            </div>

        </div>
        <hr class="m-0 p-0">
        <h5 class="product_title text-center pt-2 pb-2 product_name_hight">
            <router-link :to="{name: 'product-details', params:{slug:product.slug}}">
                {{product.name}}
                <br>
            </router-link>
        </h5>

        <div class="timer text-center mt-2 mb-2 product_timer_hight">
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
                            <div class="text"><strong>Dage</strong></div>
                        </div>

                    </div>

                    <div class="clock">
                        <div class="well bottom-pane">
                            <div id="hours" class="num">{{timeObj.h}}</div>
                        </div>
                        <div class="well top-pane">
                            <div class="text"><strong>Timer</strong></div>
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
                            <div id="days-text" class="text"><strong>Sek</strong></div>
                        </div>

                    </div>
                </div>
                <span slot="finish" class="expired">Begivenheden er endt</span>
            </vac>
            <span v-else class="expired">
                Kommer snart

                 <vac :end-time="new Date(product.offer_start_date)">
                <div
                    class="timer-area d-flex justify-content-center mt-3 mb-3 text-red"
                    slot="process"
                    slot-scope="{ timeObj }">
                    <div class="clock">
                        <div class="well bottom-pane bg-info">
                            <div id="days" class="num">{{timeObj.d}}</div>
                        </div>
                        <div class="well top-pane">
                            <div class="text"><strong>Dage</strong></div>
                        </div>

                    </div>

                    <div class="clock">
                        <div class="well bottom-pane bg-info">
                            <div id="hours" class="num">{{timeObj.h}}</div>
                        </div>
                        <div class="well top-pane">
                            <div class="text"><strong>Timer</strong></div>
                        </div>

                    </div>
                    <div class="clock">
                        <div class="well bottom-pane bg-info">
                            <div id="mins" class="num">{{timeObj.m}}</div>
                        </div>
                        <div class="well top-pane">
                            <div class="text"><strong>Min</strong></div>
                        </div>

                    </div>

                    <div class="clock">
                        <div class="well bottom-pane bg-info">
                            <div id="secs" class="num">{{timeObj.s}}</div>
                        </div>
                        <div class="well top-pane">
                            <div id="days-text" class="text"><strong>Sek</strong></div>
                        </div>

                    </div>
                </div>
                <span slot="finish" class="expired">Begivenheden er endt</span>
            </vac>

            </span>
        </div>


        <div class="short-description">
            <p class="text-center">{{product.short_des}} </p>
        </div>
        <div class="pricing-section d-flex justify-content-start">
            <div class="pricing-left">
                <h6><small>Gennemsnitlig markedspris</small></h6>
                <h5>
                    <del>{{product.market_price}} Kr</del>
                </h5>
                <h6>Startpris </h6>
                <h5>
                    <span v-if="product.current_price != product.offer_price"> <del>{{product.offer_price}} Kr-</del></span>
                    <span v-else><h5>{{product.offer_price}} Kr</h5></span>

                </h5>
                <h6>Du sparer </h6>
                <button class="btn btn-success btn-sm">{{product.saving_percentage}}%</button>
            </div>
            <div class="pricing-right">
                <h6><small>Deltagere</small></h6>
                <h6>{{product.totalOrders}}</h6>
                <h6><small>Den nuværende pris</small></h6>
                <h5>{{product.current_price}} Kr</h5>
            </div>
        </div>
        <router-link class="btn btn-success btn-block mt-3" tag="button"
                     :to="{name: 'product-details', params:{slug:product.slug}}">
            Læs mere
        </router-link>


        <div v-if="showModal" class="modal fade bd-example-modal-sm show"
             tabindex="-1" role="dialog"
             aria-labelledby="mySmallModalLabel"
             :class="showModal?'active':''"
             style="padding-right: 17px; padding-top:5rem;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mySmallModalLabel">Del begivenhed</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span @click="showModal=false" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <social-sharing
                            :url="getProductUrl"
                            :title="product.name"
                            :description="product.short_des"
                            :quote="product.short_des"
                            inline-template>
                            <div id="social-share">
                                <network class="social" network="email">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Email.png" alt=""> Email
                                </network>
                                <network class="social" network="facebook">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Facebook.png" alt="">
                                    Facebook
                                </network>
                                <network class="social" network="googleplus">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Google+.png" alt=""> Google +
                                </network>
                                <network class="social" network="line">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Line.png" alt=""> Line
                                </network>
                                <network class="social" network="linkedin">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---LinkedIn.png" alt="">
                                    LinkedIn
                                </network>
                                <network class="social" network="pinterest">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Pinterest.png" alt="">
                                    Pinterest
                                </network>
                                <network class="social" network="reddit">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Reddit.png" alt=""> Reddit
                                </network>
                                <network class="social" network="skype">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Skype.png" alt=""> Skype
                                </network>
                                <network class="social" network="sms">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---SMS.png" alt=""> SMS
                                </network>
                                <network class="social" network="telegram">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Telegram.png" alt="">
                                    Telegram
                                </network>
                                <network class="social" network="twitter">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Twitter.png" alt=""> Twitter
                                </network>
                                <network class="social" network="vk">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Vkontakte.png" alt="">
                                    VKontakte
                                </network>
                                <network class="social" network="weibo">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Weibo.png" alt=""> Weibo
                                </network>
                                <network class="social" network="whatsapp">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Whatsapp.png" alt="">
                                    Whatsapp
                                </network>
                            </div>
                        </social-sharing>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SingleProduct",
        props: ['product'],
        data() {
            return {
                showModal: false,
                isUserLiked: false,
                isUserFavourite: false,
                isUserLogin: User.loggedIn(),
                totalLikes: 0,
            }
        },
        methods: {

            addProductToLikeList(slug) {
                axios.get(`/api/product/${slug}/like/add`)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.isUserLiked = res.data.product.isLikedByCurrentUser;
                            this.totalLikes++;
                        }
                    }).catch(err => console.log(err));
            },
            addProductToFavouriteList(slug) {

                if (!this.isUserLogin) {
                    this.$root.$emit('callProductRequestModal', this.product);
                    return;
                }

                axios.get(`/api/product/${slug}/favourite/add`)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.isUserFavourite = res.data.product.isFavouriteByCurrentUser;
                            Alert.showSuccessAlert('Begivenhed føjet til favoritlisten.');
                            this.$root.$emit('updateFavouriteProductList', true);

                        } else {
                            alert(res.data.message);
                        }
                    }).catch(err => console.log(err));
            },
            removeProductToFavouriteList(slug) {
                axios.get(`/api/product/${slug}/favourite/remove`)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.isUserFavourite = res.data.product.isFavouriteByCurrentUser;
                            Alert.showSuccessAlert('Begivenhed fjernet fra favoritlisten.');
                            this.$root.$emit('updateFavouriteProductList', true);

                        } else {
                            alert(res.data.message);
                        }
                    }).catch(err => console.log(err));
            }
        },
        computed: {
            getProductUrl() {
                return `${APP_URL}/product/${this.product.slug}`;
            },
            isOfferTimeStarted() {
                let startDate = new Date(this.product.offer_start_date);
                let current_date = Date.now();
                return current_date > startDate;
            },
        },
        mounted() {
            this.isUserLiked = this.product.isLikedByCurrentUser;
            this.isUserFavourite = this.product.isFavouriteByCurrentUser;
            this.totalLikes = this.product.total_likes;
        },
        watch: {
            isFavourite(val) {
                console.log(val);
            }
        }
    }
</script>

<style scoped>
    .active {
        display: block;
    }

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

    span.favourite-badge {
        position: absolute;
        right: 13px;
        background: #ff7231;
        cursor: pointer;
        padding: 1px 10px;
        font-weight: bold;
        color: #fff;
        letter-spacing: 1px;
        font-size: 12px;
    }

    .modal-dialog {
        margin-top: 150px;
    }

    .modal-dialog .modal-body span {
        flex: none;
        color: #FFFFFF;
        background-color: #333;
        border-radius: 3px;
        overflow: hidden;
        display: flex;
        flex-direction: row;
        align-content: center;
        align-items: center;
        cursor: pointer;
        margin: 0 10px 10px 0;
    }

    .modal-dialog .modal-body .fab {
        background-color: rgba(0, 0, 0, 0.2);
        padding: 10px;
        flex: 0 1 auto;
    }

    .modal-dialog .modal-body span {
        padding: 0 10px;
        flex: 1 1;
        font-weight: 500;
    }

    .product_name_hight {
        height: 2.5rem;
    }

</style>
